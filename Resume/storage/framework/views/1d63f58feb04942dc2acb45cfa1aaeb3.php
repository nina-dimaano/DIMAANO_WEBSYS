<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ResumeApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh;
            margin: 0;
        }
        form { 
            background: #fff; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            width: 320px; 
        }
        h2 { 
            text-align: center; 
            color: #4a3e7c;
            margin-bottom: 30px;
        }
        input { 
            width: 100%; 
            padding: 12px; 
            margin: 10px 0; 
            border: 1px solid #ccc; 
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button { 
            width: 100%; 
            padding: 12px; 
            background: #667eea; 
            border: none; 
            border-radius: 8px; 
            color: #fff; 
            font-weight: 600; 
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }
        button:hover { 
            background: #5a6fdc; 
        }
        .error { 
            color: red; 
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <h2>🔐 Login</h2>
    
    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
        <div class="error"><?php echo e($message); ?></div> 
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    <input type="text" name="username" placeholder="Username" value="<?php echo e(old('username')); ?>" required autofocus>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    
    <p>
        Don't have an account? <a href="<?php echo e(route('register')); ?>">Register here</a>
    </p>
</form>
</body>
</html><?php /**PATH C:\Users\Nina Rica\OneDrive\Desktop\resume-system\resources\views/auth/login.blade.php ENDPATH**/ ?>