<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NigApotek+</title>
    <link rel="stylesheet" href="css/sss.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="logo-section">
                <img src="assets/apot.jpeg" alt="Logo UT" class="logo">
                <h1>NigApotek+</h1>
                <p>Apotek Gaul Solusi Makin Cool</p>
            </div>
            
            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn-primary">Masuk</button>
                
                <div class="register-section">
                    <p>Belum punya akun? <a href="#" class="link-btn">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>