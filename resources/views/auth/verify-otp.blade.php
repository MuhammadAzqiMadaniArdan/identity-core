@extends('layout.template')

@section('title','Verify OTP')
@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-center">Verify OTP</h1>

    <form method="POST" action="{{ route('auth.otp.verify') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="email" value="{{ old('email',$email ?? '') }}">

        <div class="flex flex-col gap-1">
            <label for="otp" class="font-medium">OTP Code</label>
            <input type="text" name="code" maxlength="6" required
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
            Verify
        </button>
    </form>
</div>
@endsection
