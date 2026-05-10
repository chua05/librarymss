<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sora', sans-serif;
            background: #fffaff;
            margin: 0;
        }

        /* NAVBAR */
        .navbar {
            background: #740074;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-size: 13px;
        }

        .navbar a:hover {
            color: #f881f8;
        }

        .navbar a.active {
            color: #f881f8;
            font-weight: 600;
        }

        .main-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* PROFILE DROPDOWN */
        .profile-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgb(205, 73, 223);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 14px;
        }

        .menu-btn {
            cursor: pointer;
            font-size: 18px;
            padding: 4px 8px;
        }

        .dropdown {
            position: absolute;
            right: 0;
            top: 40px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            width: 150px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 999;
        }

        .dropdown a {
            padding: 10px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
            color: #0f172a;
            text-decoration: none;
        }

        .dropdown a:hover {
            background: #f8fafc;
            color: black;
        }

        .show {
            display: flex;
        }

        .btn-logout {
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            padding: 10px;
            font-size: 13px;
            cursor: pointer;
            color: #ef4444;
        }

        .btn-logout:hover {
            background: #fee2e2;
        }

        .admindashboard-btn {
            padding:10px 16px;
            background:white;
            border:1px solid #e2e8f0;
            color:rgb(205,73,223);
            border-radius:10px;
            text-decoration:none;
            font-size:13px;
            transition: 0.2s ease;
        }

        .admindashboard-btn:hover {
            background: rgb(205,73,223);
            color: white;
            border-color: rgb(205,73,223);
        }
    </style>
</head>
<body>

<nav class="navbar">

    <div>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.books.index') }}">Books</a>
        <a href="{{ route('admin.users.index') }}">Users</a>
    </div>

    <div class="profile-wrapper">

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="menu-btn" onclick="toggleMenu()">⋮</div>

        <div class="dropdown" id="dropdownMenu">

            <a href="{{ route('profile.edit') }}" style="color:black;">
                My Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    Logout
                </button>
            </form>

        </div>
    </div>

</nav>

<div class="main-wrapper">
    @yield('content')
</div>

<script>
function toggleMenu() {
    document.getElementById('dropdownMenu').classList.toggle('show');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.profile-wrapper')) {
        document.getElementById('dropdownMenu').classList.remove('show');
    }
});

</script>

{{-- GLOBAL TOAST ALERT --}}
@if (session('success') || session('error'))
    <div id="top-toast"
        style="
            position: fixed;
            top: 70px; /* below navbar */
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;

            font-size: 14px;
            font-weight: 500;
            color:rgb(41, 190, 88);
            background: transparent;

            padding: 6px 12px;
            border-line: 2px solidrgb(166, 232, 147);

            opacity: 1;
            transition: opacity 1s ease;
        ">
        {{ session('success') ?? session('error') }}
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('top-toast');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }
        }, 2000);
    </script>
@endif

</body>
</html>