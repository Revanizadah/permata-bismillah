<x-mail::message>
# Verifikasi Alamat Email Anda

Terima kasih telah mendaftar! Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.

<x-mail::button :url="$url">
Verifikasi Email
</x-mail::button>

Jika Anda tidak membuat akun ini, Anda tidak perlu melakukan tindakan lebih lanjut.

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>  