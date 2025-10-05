<?php
include 'config/database.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

// Hitung total motivasi
$motivation_count = 0;
$count_sql = "SELECT COUNT(*) as total FROM motivations WHERE user_id = '$user_id'";
$count_result = $conn->query($count_sql);
if ($count_result) {
    $count_data = $count_result->fetch_assoc();
    $motivation_count = $count_data['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - VIGENESIA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>👤 Profile Saya</h1>
            <p>Kelola informasi akun Vigenesia Anda</p>
        </header>

        <nav class="navbar">
            <a href="index.php" class="nav-link">Home</a>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="motivations.php" class="nav-link">Motivasi</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </nav>

        <main class="main-content">
            <div class="profile-card">
                <div class="profile-info">
                    <div class="info-item">
                        <label>Nama Lengkap:</label>
                        <span><?php echo $user_name; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <label>Email:</label>
                        <span><?php echo $user_email; ?></span>
                    </div>
                    
                    <div class="info-item">
                        <label>Total Motivasi:</label>
                        <span class="highlight"><?php echo $motivation_count; ?> tulisan</span>
                    </div>
                    
                    <div class="info-item">
                        <label>Status:</label>
                        <span class="status-active">✅ Aktif</span>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <h3>Quick Actions</h3>
                <div class="action-buttons">
                    <a href="motivations.php" class="action-btn">✏️ Tulis Motivasi</a>
                    <a href="motivations.php" class="action-btn">📖 Lihat Motivasi</a>
                    <a href="logout.php" class="action-btn logout">🚪 Logout</a>
                </div>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2024 Vigenesia. Login sebagai: <?php echo $user_name; ?></p>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>