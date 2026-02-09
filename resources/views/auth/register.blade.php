@extends('layout.template')

@section('title', 'Register')
@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <section>
            <div>
                <label for="first_name">First name :</label>
                <input type="text" name="first_name" id="first_name" autofocus aria-label="first_name-input"
                    placeholder="First name">
            </div>
            <div>
                <label for="last_name">Last name :</label>
                <input type="text" name="last_name" id="last_name" aria-label="last_name-input"
                    placeholder="Last name (optional)">
            </div>
        </section>
        <section>
            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" aria-label="email-input"
                    placeholder="email@example.com">
            </div>
            <div>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" aria-label="password-input"
                    placeholder="Password">
            </div>
            <div>
                <label for="password_confirmation">Confirm Password :</label>
                <input type="password" name="password_confirmation" id="password_confirmation" aria-label="password_confirmation-input"
                    placeholder="Password Confirmation">
            </div>
        </section>
    </form>
@endsection
