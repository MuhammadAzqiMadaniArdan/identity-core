@extends('layout.template')

@section('title', 'Login')
@section('content')
<p id="message"></p>
    <form id="email-form">
        @csrf
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" aria-label="email-input" placeholder="Enter your email" required>
            <button type="submit">Sign up</button>
        </div>
    </form>
@endsection
@section('script')

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    let email = '';

    document.getElementById('email-form').addEventListener('submit',async e => {
        e.preventDefault();
        
        email = document.getElementById('email').value;

        const res = await fetch('/auth/request-otp',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({email})
        });

        const data = await res.json();
        document.getElementById('message').innerText = data.message;
        document.getElementById('email-form').style.display = 'none';
        document.getElementById('otp-form').style.display = 'block';
        document.getElementById('title').innerText = 'Masukkan OTP';
    });

    document.getElementById('otp-form').addEventListener('submit',async e => {
        e.preventDefault();

        const code = document.getElementById('otp').value;

        const res = await fetch('/auth/verify-otp',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({email,code})
        });

        const data = await res.json();

        if(!res.ok)
        {
            document.getElementById('message').innerText = data.message;
            return;
        }

        window.location.href = data.redirect;
    })
</script>
@endsection