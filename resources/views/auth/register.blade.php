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
        background: #f8f3ed;
        overflow: hidden;
    }

    .left-panel {
        flex: 1;
        background:
            linear-gradient(rgba(71, 42, 20, 0.45), rgba(71, 42, 20, 0.45)),
            url('https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=1600&q=80');
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
        width: 500px;
        background: #fffdf9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 50px;
        overflow-y: auto;
        border-left: 1px solid #e7d8c8;
    }

    .form-header { margin-bottom: 28px; }

    .form-header h2 {
        font-size: 26px;
        font-weight: 700;
        color: #3c2a1e;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }

    .form-header p {
        font-size: 14px;
        color: #8b6b4f;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #5e422d;
        margin-bottom: 7px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .form-group input {
        width: 100%;
        padding: 11px 14px;
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
        box-shadow: 0 0 0 3px rgba(184,115,51,0.16);
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
        margin-top: 8px;
    }

    .btn-register:hover { opacity: 0.92; }
    .btn-register:active { transform: scale(0.99); }

    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: #8b6b4f;
    }

    .login-link a {
        color: #b87333;
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
        scrollbar-color: #b87333 #fdf8f3;
    }

    .right-panel::-webkit-scrollbar {
        width: 6px;
    }

    .right-panel::-webkit-scrollbar-thumb {
        background: #b87333;
        border-radius: 10px;
    }

    .right-panel::-webkit-scrollbar-track {
        background: #fdf8f3;
    }

    .form-group select {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e7d8c8;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Sora', sans-serif;
        color: #3c2a1e;
        background: #fdf8f3;
        outline: none;
        transition: all 0.2s;
    }

    .form-group select:focus {
        border-color: #b87333;
        background: white;
        box-shadow: 0 0 0 3px rgba(184,115,51,0.16);
    }

    .form-group {
        margin-bottom: 14px;
    }

    .btn-register {
        box-shadow: 0 8px 20px rgba(184, 115, 51, 0.24);
    }

    .hero-text h1 {
        word-spacing: 2px;
    }
</style>
</head>

<body>

<!-- LEFT PANEL -->
<div class="left-panel"></div>

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
        <div style="margin-top:12px;font-size:12px;color:#8b6b4f;line-height:1.5;">
    <label style="display:flex;align-items:flex-start;gap:8px;margin-bottom:10px;">
        <input type="checkbox"
               name="agree_terms"
               required
               style="margin-top:3px;accent-color:#b87333;">
        <span>
            I agree to the Terms and Conditions.
        </span>
    </label>

    <div style="margin-top:12px;font-size:12px;color:#8b6b4f;line-height:1.5;">
    <label style="display:flex;align-items:flex-start;gap:8px;">
        <input type="checkbox"
               name="email_notification"
               required
               style="margin-top:3px;accent-color:#b87333;">
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