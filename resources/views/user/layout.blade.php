<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Library System</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f8f3ed;
            --surface: #fffdf9;
            --surface-muted: #f3e8dc;
            --border: #e7d8c8;
            --text: #3c2a1e;
            --primary: #b87333;
            --danger: #b45309;
            --danger-bg: #fff1e8;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
        }

        /* NAVBAR (SAME STYLE AS ADMIN) */
        .navbar {
            background: #6f4e37;
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
            color: #ffd7ab;
        }

        /* ACTIVE LINK STYLE */
        .navbar a.active {
            color: #ffd7ab;
            font-weight: 600;
        }

        .main-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* PROFILE */
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
            background: var(--primary);
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
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            width: 150px;
            display: none;
            flex-direction: column;
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
            color: var(--text);
            text-decoration: none;
        }

        .dropdown a:hover {
            background: var(--surface-muted);
            color: var(--text);
        }

        .show { display: flex; }

        .btn-logout {
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            padding: 10px;
            font-size: 13px;
            cursor: pointer;
            color: var(--danger);
        }

        .btn-logout:hover {
            background: var(--danger-bg);
        }

        /* reusable UI card (for future dashboard pages) */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 15px;
        }

        .dashboard-btn {
            padding:10px 16px;
            background:var(--surface);
            border:1px solid var(--border);
            color:var(--primary);
            border-radius:10px;
            text-decoration:none;
            font-size:13px;
            transition: 0.2s ease;
        }

        .dashboard-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

    </style>
</head>

<body>

<nav class="navbar">

    <div>
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
        <a href="{{ route('user.books.index') }}">Books</a>
        <a href="{{ route('user.borrows.my') }}">My Borrows</a>
        <a href="{{ route('user.reservations.my') }}">My Reservations</a>
    </div>

    <div class="profile-wrapper">

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="menu-btn" onclick="toggleMenu()">⋮</div>

        <div class="dropdown" id="dropdownMenu">

            <a href="{{ route('profile.edit') }}">
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


// ADDED: active nav highlight
document.querySelectorAll('.navbar a').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active');
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
            color:#965d2d;
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