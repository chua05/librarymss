<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Library Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Sora', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f8f3ed;
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background:
                linear-gradient(rgba(71, 42, 20, 0.45), rgba(71, 42, 20, 0.45)),
                url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 214, 171, 0.2) 0%, transparent 70%);
            top: -100px;
            left: -100px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 115, 51, 0.18) 0%, transparent 70%);
            bottom: -80px;
            right: -80px;
        }

        .right-panel {
            width: 480px;
            background: #fffdf9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            border-left: 1px solid #e7d8c8;
        }

        .form-header { margin-bottom: 36px; }
        .form-header h2 { font-size: 28px; font-weight: 700; color: #3c2a1e; letter-spacing: -0.5px; margin-bottom: 8px; }
        .form-header p { font-size: 14px; color: #8b6b4f; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #5e422d; margin-bottom: 8px; letter-spacing: 0.3px; }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e7d8c8;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Sora', sans-serif;
            color: #3c2a1e;
            background: #fdf8f3;
            transition: all 0.2s;
            outline: none;
        }

        .form-group input:focus {
            border-color: #b87333;
            background: white;
            box-shadow: 0 0 0 3px rgba(184, 115, 51, 0.16);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #8b6b4f;
            cursor: pointer;
        }

        .remember input { width: auto; margin: 0; }

        .forgot { font-size: 13px; color: #b87333; text-decoration: none; font-weight: 500; }
        .forgot:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #b87333, #cc8c4d);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover { opacity: 0.92; }
        .btn-login:active { transform: scale(0.99); }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #8b6b4f;
        }

        .register-link a { color: #b87333; font-weight: 600; text-decoration: none; }
        .register-link a:hover { text-decoration: underline; }

        .error-msg {
            background: #fff1e8;
            border: 1px solid #f6c8aa;
            color: #a24b1d;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="left-panel"></div>

    <div class="right-panel">
        <div class="form-header">
            <h2>Welcome back 👋</h2>
            <p>Sign in to your account to continue</p>
        </div>

        @if ($errors->any())
            <div class="error-msg">These credentials do not match our records.</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••" />
            </div>
            <div class="form-row">
                <label class="remember">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                @endif
            </div>
            <button type="submit" class="btn-login">Log In</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
</body>
</html>