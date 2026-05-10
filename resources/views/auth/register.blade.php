<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Student System</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Sora', sans-serif;
        min-height: 100vh;
        display: flex;
        background: #260f2a;
        overflow: hidden;
    }

    .left-panel {
        flex: 1;
        background: linear-gradient(135deg, #521e5f 0%, #280f2a 60%, #351034 100%);
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
        background: radial-gradient(circle, rgba(245, 56, 248, 0.08) 0%, transparent 70%);
        top: -100px;
        left: -100px;
    }

    .left-panel::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(236, 92, 246, 0.07) 0%, transparent 70%);
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
        background: linear-gradient(90deg, #eb38f8, #f881f8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-text p {
        font-size: 15px;
        color: #b494b8;
        line-height: 1.7;
        max-width: 340px;
    }

    .right-panel {
        width: 500px;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 50px;
        overflow-y: auto;
    }

    .form-header { margin-bottom: 28px; }

    .form-header h2 {
        font-size: 26px;
        font-weight: 700;
        color: #2a0f2a;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }

    .form-header p {
        font-size: 14px;
        color: #88648b;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #4c3751;
        margin-bottom: 7px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .form-group input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Sora', sans-serif;
        color: #270f2a;
        background: #f8fafc;
        transition: all 0.2s;
        outline: none;
    }

    .form-group input:focus {
        border-color: #f838f8;
        background: white;
        box-shadow: 0 0 0 3px rgba(56,189,248,0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .error-text {
        color: #dc2626;
        font-size: 12px;
        margin-top: 4px;
    }

    .btn-register {
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #e90ee2, #ec63f1);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        font-family: 'Sora', sans-serif;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
        letter-spacing: 0.3px;
        margin-top: 8px;
    }

    .btn-register:hover { opacity: 0.92; }
    .btn-register:active { transform: scale(0.99); }

    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: #8a648b;
    }

    .login-link a {
        color: #ec63f1;
        font-weight: 600;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* ===================== ADDED FIXES (DO NOT MODIFY ORIGINAL UI) ===================== */

    body {
        overflow-x: hidden;
    }

    .brand {
        justify-content: flex-start;
    }

    .right-panel {
        scrollbar-width: thin;
        scrollbar-color: #ec63f1 #f8fafc;
    }

    .right-panel::-webkit-scrollbar {
        width: 6px;
    }

    .right-panel::-webkit-scrollbar-thumb {
        background: #ec63f1;
        border-radius: 10px;
    }

    .right-panel::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    .form-group select {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Sora', sans-serif;
        color: #270f2a;
        background: #f8fafc;
        outline: none;
        transition: all 0.2s;
    }

    .form-group select:focus {
        border-color: #f838f8;
        background: white;
        box-shadow: 0 0 0 3px rgba(56,189,248,0.1);
    }

    .form-group {
        margin-bottom: 14px;
    }

    .btn-register {
        box-shadow: 0 8px 20px rgba(233, 14, 226, 0.25);
    }

    .hero-text h1 {
        word-spacing: 2px;
    }
</style>
</head>

<body>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="brand">
        <span class="brand-name">Library Management System</span>
    </div>

    <div class="hero-text">
        <h1>LIBRARY <span>MS</span></h1>
        <p>Create Your Account!</p>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">

    <div class="form-header">
        <h2>Create Account</h2>
        <p>Complete the form to register.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- FULL NAME -->
        <div class="form-group">
            <label>Full Name</label>
            <input type="text"
                   name="full_name"
                   value="{{ old('full_name') }}"
                   required
                   autofocus
                   placeholder="e.g. Juan dela Cruz">
            @error('full_name') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <!-- USERNAME -->
        <div class="form-group">
            <label>Username</label>
            <input type="text"
                   name="username"
                   value="{{ old('username') }}"
                   required
                   placeholder="e.g. juan123">
            @error('username') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label>Email Address</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   placeholder="you@example.com">
            @error('email') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <!-- CONTACT -->
        <div class="form-group">
            <label>Contact Number</label>
            <input type="text"
                   name="contact_number"
                   value="{{ old('contact_number') }}"
                   required
                   placeholder="09XXXXXXXXX">
            @error('contact_number') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <!-- ADDRESS -->
        <div class="form-group">
        <label>Address</label>
        <input type="text"
            name="address"
            value="{{ old('address') }}"
            required
            placeholder="Enter your address">
        @error('address') <div class="error-text">{{ $message }}</div> @enderror
    </div>

        <!-- PASSWORDS -->
        <div class="form-row">

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       required
                       placeholder="••••••••">
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       required
                       placeholder="••••••••">
            </div>

        </div>

        <!-- CONSENT -->
        <div style="margin-top:12px;font-size:12px;color:#8a648b;line-height:1.5;">
    <label style="display:flex;align-items:flex-start;gap:8px;margin-bottom:10px;">
        <input type="checkbox"
               name="agree_terms"
               required
               style="margin-top:3px;accent-color:#ec63f1;">
        <span>
            I agree to the Terms and Conditions.
        </span>
    </label>

    <div style="margin-top:12px;font-size:12px;color:#8a648b;line-height:1.5;">
    <label style="display:flex;align-items:flex-start;gap:8px;">
        <input type="checkbox"
               name="email_notification"
               required
               style="margin-top:3px;accent-color:#ec63f1;">
        <span>
        A verification email will be sent to your email address after registration. Please verify your account before logging in.
        </span>
    </label>

</div>  


        <button type="submit" class="btn-register">
            Create Account
        </button>

    </form>

    <!-- LOGIN LINK -->
    <div class="login-link">
        Already have an account?
        <a href="{{ route('login') }}">Log in here</a>
    </div>

</div>
</body>
</html>