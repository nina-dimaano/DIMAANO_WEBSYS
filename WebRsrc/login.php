<?php
session_start();

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $message = "All fields are required!";
        $messageClass = "error";
    } else {
        if ($username === "admin" && $password === "1234") {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            
            header("Location: resume.php");
            exit();
        } else {
            $message = "Invalid Username or Password";
            $messageClass = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SecurePortal - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔐</text></svg>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            margin: auto;
            overflow: hidden;
        }

        .logo-container {
            text-align: center;
            padding: 30px 20px 0;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(102, 126, 234, 0.1);
            border: 2px solid #667eea;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 12px;
        }

        .site-name {
            color: #667eea;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .main-title {
            font-size: 32px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 6px;
            margin-bottom: 5px; 
            color: #6a5aaeff;
        }

        .subtitle {
            font-size: 13px;
            font-weight: 400;
            color: #876fd6ff;
            letter-spacing: 1px;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .form-content {
            padding: 25px 30px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-container {
            position: relative;
            background: #f5f7fa;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .input-container:focus-within {
            border-color: #667eea;
            background: #fff;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8e9aaf;
            font-size: 18px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 16px 15px 16px 45px;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #2c3e50;
            outline: none;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin: 15px 0 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: #8e9aaf;
        }

        .remember-me input {
            margin-right: 6px;
            accent-color: #667eea;
        }

        .forgot-password {
            color: #8e9aaf;
            text-decoration: none;
            font-style: italic;
        }

        .forgot-password:hover {
            color: #667eea;
        }

        .login-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: #e2dcf5;
            color: #4a3e7c;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-btn:hover {
            background: #d6ccf0;
        }

        .message {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
        }

        .success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            text-align: center;
            margin-top: auto;
            padding: 15px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 480px) {
            .form-content {
                padding: 20px;
            }

            .main-title {
                font-size: 24px;
            }

            .login-btn {
                padding: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo-container">
            <div class="logo">🔐</div>
            <div class="site-name">SECUREPORTAL</div>
            <h1 class="main-title">User Login</h1>
            <p class="subtitle">Welcome to the website!</p>
        </div>

        <div class="form-content">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($message)): ?>
                <div class="message <?php echo $messageClass; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <div class="input-container">
                        <div class="input-icon">👤</div>
                        <input type="text" name="username" placeholder="Username"
                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-container">
                        <div class="input-icon">🔒</div>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> SecurePortal.com. All rights reserved.
    </footer>

</body>
</html>