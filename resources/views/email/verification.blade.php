<x-mail::message>
# Introduction

Halo, Kepada user yang baru saja register.

<x-mail::button :url="$url">
Verifikasi Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
