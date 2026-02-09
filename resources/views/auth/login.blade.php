@extends('layout.template')

@section('title', 'Login')

@section('content')
<!-- Left: Login Form -->
<div class="w-full md:w-1/2 bg-white p-10 rounded-lg shadow-xl">
    <h2 class="text-3xl font-bold mb-1 text-gray-800">Login</h2>
    <p class="font-semibold mb-6 text-gray-600">Log in to continue</p>

    <!-- Email OTP Form -->
    <form method="POST" action="{{ route('auth.otp.request') }}" class="flex flex-col gap-5">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="email" class="font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required
                class="px-4 py-3 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="h-5 w-5 accent-blue-500">
            <label for="remember" class="text-gray-600 text-sm">Remember me</label>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-md transition">
            Continue
        </button>

        <div class="text-center my-3 text-gray-400 font-medium">or continue with</div>

        <a href="{{ route('auth.google') }}"
           class="flex items-center justify-center gap-3 border border-gray-300 rounded-md py-3 text-gray-800 hover:bg-gray-100 transition">
            <img src="/images/google-logo.svg" alt="Google" class="h-6">
            <span class="font-medium">Google</span>
        </a>

        <hr class="my-6 border-gray-300">

        <div class="flex items-center gap-3">
            <img src="/images/nav-icon.svg" alt="Nav Icon" class="h-6">
            <span class="text-gray-400 text-xs">One account for Avera, and many projects from Mazqi</span>
        </div>
    </form>
</div>

<!-- Right: Identity Core Info -->
<div class="w-full md:w-1/2 flex flex-col items-center justify-center gap-5">
    <img src="/images/logo-icon.png" alt="Identity Core" class="h-36">
    <h2 class="text-2xl font-bold text-white">Identity Core</h2>
<p class="text-center text-gray-200 text-lg">More Fast More Reliable</p>
</div>
@endsection
