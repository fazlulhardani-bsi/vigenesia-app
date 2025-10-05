<?php
include 'config/database.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$success = "";
$error = "";

// Tambah motivasi baru
if (isset($_POST['add_motivation'])) {
    $content = trim($conn->real_escape_string($_POST['content']));
    
    if (!empty($content)) {
        $sql = "INSERT INTO motivations (user_id, content) VALUES ('$user_id', '$content')";
        if ($conn->query($sql) === TRUE) {
            $success = "Motivasi berhasil ditambahkan!";
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Tuliskan motivasi Anda terlebih dahulu!";
    }
}

// Hapus motivasi
if (isset($_GET['delete'])) {
    $motivation_id = $_GET['delete'];
    
    // Pastikan user hanya bisa hapus motivasi miliknya sendiri
    $sql = "DELETE FROM motivations WHERE id = '$motivation_id' AND user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        $success = "Motivasi berhasil dihapus!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Ambil semua motivasi user
$sql = "SELECT * FROM motivations WHERE user_id = '$user_id' ORDER BY created_at DESC";
$motivations = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivasi - VIGENESIA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>💫 Motivasi Saya</h1>
            <p>Halo <?php echo $user_name; ?>, tulis dan kelola kata-kata motivasi Anda</p>
        </header>

        <nav class="navbar">
            <a href="index.php" class="nav-link">Home</a>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="motivations.php" class="nav-link">Motivasi</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </nav>

        <main class="main-content">
            <!-- FORM TAMBAH MOTIVASI -->
            <div class="motivation-form">
                <h2>✏️ Tulis Motivasi Baru</h2>
                
                <?php if ($success): ?>
                    <div class="alert success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert error"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <textarea name="content" rows="4" placeholder="Tulis kata-kata motivasi Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" name="add_motivation" class="btn">💾 Simpan Motivasi</button>
                </form>
            </div>

            <!-- DAFTAR MOTIVASI -->
            <div class="motivations-list">
                <h2>📖 Daftar Motivasi Saya</h2>
                
                <?php if ($motivations && $motivations->num_rows > 0): ?>
                    <div class="motivation-items">
                        <?php while($motivation = $motivations->fetch_assoc()): ?>
                            <div class="motivation-item">
                                <div class="motivation-content">
                                    <p>"<?php echo htmlspecialchars($motivation['content']); ?>"</p>
                                    <small class="motivation-date">
                                        📅 <?php echo date('d F Y H:i', strtotime($motivation['created_at'])); ?>
                                    </small>
                                </div>
                                <div class="motivation-actions">
                                    <a href="motivations.php?delete=<?php echo $motivation['id']; ?>" 
                                       class="delete-btn" 
                                       onclick="return confirm('Yakin hapus motivasi ini?')">
                                        🗑️ Hapus
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <p>📝 Belum ada motivasi. Yuk tulis yang pertama!</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2024 Vigenesia. 
                Total motivasi: <?php echo $motivations ? $motivations->num_rows : 0; ?>
            </p>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>