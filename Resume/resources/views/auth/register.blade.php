<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ResumeApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        form { 
            background: #fff; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            width: 340px; 
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
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { 
            background: #5a6fdc; 
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: -8px;
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
<form method="POST" action="{{ route('register') }}">
    @csrf
    <h2>📝 Register</h2>
    
    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
    @error('username') <div class="error">{{ $message }}</div> @enderror
    
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    @error('email') <div class="error">{{ $message }}</div> @enderror
    
    <input type="password" name="password" placeholder="Password (min 4 chars)" required>
    @error('password') <div class="error">{{ $message }}</div> @enderror
    
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    
    <button type="submit">Register</button>
    
    <p>
        Already have an account? <a href="{{ route('login') }}">Login here</a>
    </p>
</form>
</body>
</html>