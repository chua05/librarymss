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
            background: #0f172a;
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #521e5f 0%, #270f2a 60%, #2f1035 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56,189,248,0.08) 0%, transparent 70%);
            top: -100px;
            left: -100px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139,92,246,0.07) 0%, transparent 70%);
            bottom: -80px;
            right: -80px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 60px;
            position: relative;
            z-index: 1;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 600;
            color: white;
            letter-spacing: -0.3px;
        }

        .hero-text {
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            color: white;
            line-height: 1.1;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
        }

        .hero-text h1 span {
            background: linear-gradient(90deg, #d538f8, #f881f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-text p {
            font-size: 15px;
            color: #b394b8;
            line-height: 1.7;
            max-width: 340px;
        }

        .dots {
            display: flex;
            gap: 8px;
            margin-top: 50px;
            position: relative;
            z-index: 1;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #533355;
        }

        .dot.active { background: #df38f8; width: 24px; border-radius: 4px; }

        .right-panel {
            width: 480px;
            background: #fff8fe;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
        }

        .form-header { margin-bottom: 36px; }
        .form-header h2 { font-size: 28px; font-weight: 700; color: #0f172a; letter-spacing: -0.5px; margin-bottom: 8px; }
        .form-header p { font-size: 14px; color: #89648b; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #4c3751; margin-bottom: 8px; letter-spacing: 0.3px; }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Sora', sans-serif;
            color: #260f2a;
            background: #f8fafc;
            transition: all 0.2s;
            outline: none;
        }

        .form-group input:focus {
            border-color: #db38f8;
            background: white;
            box-shadow: 0 0 0 3px rgba(56,189,248,0.1);
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
            color: #677383;
            cursor: pointer;
        }

        .remember input { width: auto; margin: 0; }

        .forgot { font-size: 13px; color: #d538f8; text-decoration: none; font-weight: 500; }
        .forgot:hover { text-decoration: underline; }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #e20ee9, #e363f1);
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
            color: #86648b;
        }

        .register-link a { color: #ef63f1; font-weight: 600; text-decoration: none; }
        .register-link a:hover { text-decoration: underline; }

        .error-msg {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="brand">
            <span class="brand-name">Library Management System</span>
        </div>
        <div class="hero-text">
            <h1>LIBRARY <span>MS</span></h1>
        </div>
        <div class="dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

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