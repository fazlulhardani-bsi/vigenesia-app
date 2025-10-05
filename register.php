<?php
include 'config/database.php';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$error = "";

// Proses pendaftaran
if ($_POST) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']);
    
    // Cek email sudah ada
    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VIGENESIA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>📝 Daftar Vigenesia</h2>
            
            <?php if ($error): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <input type="text" name="name" required placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="email@example.com">
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required placeholder="Buat password minimal 6 karakter">
                </div>
                
                <button type="submit" class="btn">Daftar Sekarang</button>
            </form>
            
            <div class="form-links">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
                <p><a href="index.php">← Kembali ke Home</a></p>
            </div>
        </div>
    </div>
</body>
</html>