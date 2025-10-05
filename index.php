<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIGENESIA - Aplikasi Motivasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <header class="header">
            <h1>🎯 VIGENESIA</h1>
            <p>Aplikasi Motivasi Indonesia untuk Semua Orang</p>
        </header>

        <!-- NAVIGATION -->
        <nav class="navbar">
            <a href="index.php" class="nav-link">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="nav-link">Profile</a>
                <a href="motivations.php" class="nav-link">Motivasi</a>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">Login</a>
                <a href="register.php" class="nav-link">Register</a>
            <?php endif; ?>
        </nav>

        <!-- CONTENT -->
        <main class="main-content">
            <div class="welcome-box">
                <h2>Selamat Datang di Vigenesia! 🌟</h2>
                <p>Aplikasi yang bisa diakses via website dan mobile untuk menulis dan menyimpan kata-kata motivasi.</p>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-welcome">
                        <p>Halo <strong><?php echo $_SESSION['user_name']; ?></strong>! Selamat datang kembali.</p>
                        <a href="motivations.php" class="btn">📝 Tulis Motivasi</a>
                    </div>
                <?php else: ?>
                    <div class="guest-welcome">
                        <p>Bergabunglah dengan kami untuk mulai menulis motivasi!</p>
                        <div class="action-buttons">
                            <a href="register.php" class="btn">Daftar Sekarang</a>
                            <a href="login.php" class="btn secondary">Login</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- FEATURES -->
            <div class="features">
                <h2>✨ Fitur Vigenesia</h2>
                <div class="feature-grid">
                    <div class="feature-card">
                        <h3>👤 User Management</h3>
                        <p>Daftar dan login dengan akun pribadi</p>
                    </div>
                    <div class="feature-card">
                        <h3>💫 Motivasi</h3>
                        <p>Tulis dan kelola kata-kata motivasi</p>
                    </div>
                    <div class="feature-card">
                        <h3>📱 Responsive</h3>
                        <p>Akses dari HP atau komputer</p>
                    </div>
                    <div class="feature-card">
                        <h3>🌍 Global Access</h3>
                        <p>Bisa diakses dari mana saja</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <p>&copy; 2024 Vigenesia. Aplikasi Motivasi Indonesia.</p>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>