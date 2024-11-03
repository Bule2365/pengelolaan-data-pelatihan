@component('mail::message')
# Hai, {{ $trainer->name }}

Akun Anda telah berhasil dibuat! Berikut detail akun Anda:

- **Nama**: {{ $trainer->name }}
{{-- - **Email**: {{ $trainer->email }} --}}
- **Nomor Telepon**: {{ $trainer->phone }}
- **Biografi**: {{ $trainer->biography ? $trainer->biography : 'Belum diisi' }}
- **Pengalaman**: {{ $trainer->experience ? $trainer->experience . ' tahun' : 'Belum ada pengalaman' }}

Jangan kasih Tahu siapapun kata sandi akun anda.
- **Kata Sandi**: {{ $password }}

Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/homepage'])
Login Sekarang
@endcomponent

Terima kasih,<br>
{{-- {{ config('app.name') }} --}}
@endcomponent


{{-- Juga, berikut adalah jadwal pelatihan Anda:

- **Judul Pelatihan**: {{ $schedule->title }}
- **Tanggal**: {{ $schedule->date }}
- **Waktu**: {{ $schedule->time }}

Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.

@component('mail::button', ['url' => 'http://yourapp.com/login'])
Login Sekarang
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent --}}
