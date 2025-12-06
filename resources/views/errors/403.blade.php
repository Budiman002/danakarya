<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied | DanaKarya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-[#B8E6D5] to-[#7DD3C0]">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/LogoDanaKarya.png') }}" alt="DanaKarya" class="h-16 mx-auto mb-6">
            </div>

            <!-- Error Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
                <!-- Lock Icon -->
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>

                <!-- Error Code -->
                <h1 class="text-6xl font-bold text-gray-900 mb-2">403</h1>
                
                <!-- Error Title -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Access Denied</h2>
                
                <!-- Error Message -->
                <p class="text-gray-600 mb-8">
                    You don't have permission to access this page. Please contact your administrator if you believe this is a mistake.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="javascript:history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
                        Go Back
                    </a>
                    
                    <a href="/" class="px-6 py-3 bg-[#5AB9A0] hover:bg-[#4A9A88] text-white font-semibold rounded-lg transition">
                        Home
                    </a>
                </div>
            </div>

            <!-- Help Text -->
            <p class="text-center text-white text-sm mt-6">
                Need help? Contact us at 
                <a href="mailto:support@danakarya.com" class="font-semibold hover:underline">support@danakarya.com</a>
            </p>
        </div>
    </div>
</body>
</html>