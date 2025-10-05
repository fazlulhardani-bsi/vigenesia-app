<?php
include 'config/database.php';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$error = "";

// Proses login
if ($_POST) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        
        header("Location: profile.php");
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VIGENESIA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>🔐 Login Vigenesia</h2>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert success">
                    ✅ Pendaftaran berhasil! Silakan login.
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required placeholder="email@example.com">
                </div>
                
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required placeholder="Masukkan password">
                </div>
                
                <button type="submit" class="btn">Login</button>
            </form>
            
            <div class="form-links">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                <p><a href="index.php">← Kembali ke Home</a></p>
            </div>
        </div>
    </div>
</body>
</html>