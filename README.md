# Identity Core – User Authentication & Management System
<img width="1920" height="1162" alt="Login-IC" src="https://github.com/user-attachments/assets/3778e3a8-0377-4ea6-ac6c-3923647eb989" />

Identity Core adalah sistem autentikasi dan manajemen user berbasis Laravel yang mendukung OAuth 2.0 dengan PKCE dan login sosial melalui Laravel Socialite, serta manajemen token API menggunakan Laravel Passport. Sistem ini dirancang untuk memberikan autentikasi yang aman dan fleksibel bagi aplikasi web maupun mobile.

Fitur Utama:
- Login & registrasi user dengan OAuth 2.0 + PKCE
- Social login (Google, GitHub, Facebook) menggunakan Laravel Socialite
- API authentication dengan token menggunakan Laravel Passport
- Endpoint REST API untuk manajemen user
- Proteksi route untuk user terautentikasi

Teknologi:
- Backend: Laravel 11
- Auth & API: Laravel Passport, OAuth 2.0, PKCE
- Social Login: Laravel Socialite
- Database: PostgreSQL

Setup & Instalasi:
1. Clone repository:
git clone <repository-url>
cd identity-core

2. Install dependencies:
composer install


3. Setup environment:
cp .env.example .env
- Atur konfigurasi database dan Socialite di `.env`

4. Generate app key:
php artisan key:generate


5. Migrate database:
php artisan migrate


6. Install Passport:
php artisan passport:install


7. Serve application:
php artisan serve


OAuth 2.0 + PKCE:
- Mendukung alur Authorization Code + PKCE untuk SPA dan mobile apps
- Frontend harus generate code_verifier & code_challenge, redirect ke `/oauth/authorize`, lalu tukar code menjadi access token

Social Login:
- Redirect ke provider: `GET /auth/{provider}`
- Callback endpoint: `GET /auth/{provider}/callback`
- Supported providers: Google, GitHub, Facebook (sesuai `.env`)

API Endpoints:

User Auth:
- `POST /api/register` → registrasi user
- `POST /api/login` → login user
- `POST /api/logout` → logout user
- `GET /api/user` → ambil profile user

User Management:
- `GET /api/users` → daftar user
- `GET /api/users/{id}` → detail user
- `PUT /api/users/{id}` → update user
- `DELETE /api/users/{id}` → hapus user

Semua endpoint dilindungi token Passport (`Authorization: Bearer <access_token>`)

Referensi:
- Laravel Passport: https://laravel.com/docs/11.x/passport
- Laravel Socialite: https://laravel.com/docs/11.x/socialite
- OAuth 2.0 PKCE RFC: https://www.rfc-editor.org/rfc/rfc7636
