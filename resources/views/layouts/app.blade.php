<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Precise Diagnostics Imaging - Advanced Medical Imaging Services with Precision and Care">
    
    <title>@yield('title', 'Precise Diagnostics Imaging') | Medical Excellence</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        :root {
            --medical-blue: #0ea5e9;
            --medical-teal: #0d9488;
            --medical-light: #f0f9ff;
            --medical-dark: #0f172a;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-heading {
            font-family: 'Poppins', sans-serif;
        }
        
        .medical-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #0d9488 100%);
        }
        
        .medical-gradient-light {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }
        
        /* Navigation Styles */
        .nav-link {
            @apply px-5 py-2.5 rounded-lg font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center;
        }
        .nav-link-active {
            @apply text-blue-600 bg-blue-50;
        }
        .dropdown-item {
            @apply flex items-center p-3 rounded-lg hover:bg-gray-50 transition;
        }
        .mobile-nav-link {
            @apply block py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition mb-1 flex items-center;
        }
        
        /* Footer Styles */
        .footer-link {
            @apply text-gray-300 hover:text-white transition flex items-center hover:translate-x-1 duration-300;
        }
        
        .social-icon {
            @apply w-10 h-10 rounded-full flex items-center justify-center text-white transition transform hover:-translate-y-1 duration-300;
        }
        
        /* Emergency Banner Animation */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(220, 38, 38, 0.5); }
            50% { box-shadow: 0 0 30px rgba(220, 38, 38, 0.8); }
        }
        
        .emergency-banner {
            animation: pulse-glow 2s infinite;
        }
        
        /* Smooth transitions */
        * {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #0ea5e9, #0d9488);
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #0d9488, #0ea5e9);
        }
        
        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navigation -->
    @include('components.navigation')
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Alpine.js for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Initialize animations -->
    <script>
        // Simple fade-in animation for page elements
        document.addEventListener('DOMContentLoaded', function() {
            // Fade-in elements
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('opacity-100', 'translate-y-0');
                }, index * 100);
            });
            
            // Add pulsing animation to emergency banner
            const emergencyBanner = document.querySelector('.bg-gradient-to-r.from-red-900');
            if (emergencyBanner) {
                emergencyBanner.classList.add('emergency-banner');
            }
            
            // Add active class to current page nav link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('nav-link-active');
                }
            });
        });
    </script>
</body>
</html>