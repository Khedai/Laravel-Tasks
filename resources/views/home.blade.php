<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Task Manager - Organize Your Work</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Organize Your Work</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .floating { animation: float 6s ease-in-out infinite; }
        .task-icon { transition: all 0.3s ease; }
        .task-icon:hover { transform: scale(1.1) rotate(5deg); }
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .btn-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen font-['Poppins']">
    <div class="container mx-auto px-4 py-16 flex flex-col items-center justify-center">
        <!-- Animated header -->
        <div class="text-center mb-12 animate__animated animate__fadeIn">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 gradient-text">
                Task<span class="text-blue-600">Flow</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Streamline your productivity with our intuitive task management system
            </p>
        </div>

        <!-- Floating task icons -->
        <div class="flex justify-center space-x-8 mb-16">
            <div class="task-icon floating animate__animated animate__fadeInUp animate__delay-1s">
                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="task-icon floating animate__animated animate__fadeInUp animate__delay-1-5s">
                <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div class="task-icon floating animate__animated animate__fadeInUp animate__delay-2s">
                <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <!-- Feature cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 w-full max-w-6xl">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__fadeInLeft">
                <div class="text-blue-500 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lightning Fast</h3>
                <p class="text-gray-600">Manage tasks with unparalleled speed and efficiency.</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__fadeInUp">
                <div class="text-purple-500 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Secure</h3>
                <p class="text-gray-600">Your data is protected with enterprise-grade security.</p>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__fadeInRight">
                <div class="text-indigo-500 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Cloud Sync</h3>
                <p class="text-gray-600">Access your tasks from anywhere, anytime.</p>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row gap-4 animate__animated animate__fadeInUp animate__delay-1s">
            <a href="{{ route('login') }}" class="btn-hover bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg text-center transition-colors duration-300">
                Get Started - Login
            </a>
            <a href="{{ route('register') }}" class="btn-hover bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 font-medium py-3 px-8 rounded-lg text-center transition-colors duration-300">
                Create Account
            </a>
        </div>

        <!-- Animated wave divider -->
        <div class="w-full mt-24 overflow-hidden">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-blue-100">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </div>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-blue-100 text-center py-8 text-gray-600">
        <p>© 2023 TaskFlow. All rights reserved.</p>
    </footer>

    <!-- Animation script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation class to elements when they come into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.feature-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
    
</body>

</html>