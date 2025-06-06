<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 CRUD - Techsolutionstuff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Check if theme preference exists in localStorage
        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        // Check if system prefers dark mode
        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        // Update theme icon
        const updateThemeIcon = theme => {
            const icon = document.querySelector('.theme-icon')
            if (icon) {
                icon.className = `theme-icon bi ${theme === 'dark' ? 'bi-moon-stars-fill' : 'bi-sun-fill'}`
            }
        }

        // Set theme
        const setTheme = theme => {
            document.documentElement.setAttribute('data-bs-theme', theme)
            setStoredTheme(theme)
            updateThemeIcon(theme)
        }

        // Initialize theme
        document.addEventListener('DOMContentLoaded', () => {
            // Set initial theme
            const initialTheme = getPreferredTheme()
            setTheme(initialTheme)

            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (!storedTheme) {
                    setTheme(getPreferredTheme())
                }
            })
        })
    </script>
</head>
<body class="font-sans antialiased">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">COUP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Public Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('game') }}">Play Game</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partner-stores.index') }}">Partner Stores</a>
                    </li>

                    <!-- Protected Links -->
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cards.index') }}">Manage Cards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reviews.index') }}">Manage Reviews</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    <li class="nav-item ms-2">
                        <button class="btn btn-link nav-link" onclick="setTheme(getStoredTheme() === 'dark' ? 'light' : 'dark')">
                            <i class="theme-icon bi bi-sun-fill"></i>
                            <span class="visually-hidden">Toggle theme</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <div class="container mt-5">
            @yield('content')
        </div>
    </main>
    
</body>
</html>