@extends('admin.layouts.app-admin-website')

@section('title', 'informasi admin')

@section('content')
    <div class="container mx-auto p-8">
        <!-- Data Admin (readonly) -->
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 space-y-6">
            <!-- Nama Admin -->
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                    <!-- Placeholder for profile picture, you can replace with actual image -->
                    <span class="text-gray-500 text-2xl font-semibold">A</span>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-800">{{ $admin->username }}</p>
                    <p class="text-sm text-gray-600">Admin</p>
                </div>
            </div>

            <!-- Email Admin -->
            <div>
                <p class="text-lg font-medium text-gray-700">Email:</p>
                <p class="mt-1 text-gray-800">
                    {{ substr($admin->email, 0, 3) . '***' . substr($admin->email, strpos($admin->email, '@')) }}
                </p>

                <!-- Tombol dengan desain lebih bagus -->
                <a class="block py-3 px-6 mt-4 bg-blue-600 text-white text-lg text-center font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1"
                    href="{{ url('logs') }}">
                    Cek Aktivitas Log
                </a>
            </div>
        </div>

        <!-- Tugas dan Tanggung Jawab Admin -->
        <div class="bg-gray-50 shadow-lg rounded-lg mt-8 p-6 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Tugas dan Tanggung Jawab Admin</h2>

            <!-- 1. Pengelolaan Data dan Sistem -->
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">1. Pengelolaan Data dan Sistem</h3>
                <p class="text-gray-600 leading-relaxed">
                    Admin bertanggung jawab untuk melakukan pengelolaan sistem informasi perusahaan. Ini termasuk:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                    <li>Pengelolaan data sensitif seperti informasi pengguna, klien, dan internal. Data ini harus disimpan
                        dengan aman dan hanya dapat diakses oleh pihak yang memiliki otoritas. Pengelolaan ini mencakup
                        pencadangan berkala dan penggunaan enkripsi untuk menjaga integritas dan kerahasiaan data.</li>
                    <li>Pengelolaan akses pengguna. Admin harus memastikan bahwa akses ke sistem hanya diberikan kepada
                        pengguna yang sah dengan tingkat otorisasi yang tepat. Penggunaan otentikasi multifaktor (MFA) atau
                        mekanisme keamanan lain sangat penting.</li>
                    <li>Pemeliharaan server dan sistem jaringan. Admin harus memastikan server, perangkat keras, dan
                        jaringan berfungsi dengan baik, termasuk pembaruan rutin perangkat lunak dan keamanan.</li>
                </ul>
            </div>

            <!-- 2. Menjaga Keamanan Sistem -->
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">2. Menjaga Keamanan Sistem</h3>
                <p class="text-gray-600 leading-relaxed">
                    Admin juga memiliki tugas kritis untuk menjaga keamanan sistem dari ancaman luar seperti:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                    <li>Menjaga firewall dan perlindungan sistem terhadap malware. Admin harus terus-menerus memantau sistem
                        untuk mendeteksi potensi ancaman keamanan dan mengambil langkah pencegahan.</li>
                    <li>Menjaga log aktivitas yang mencatat setiap akses ke sistem atau perubahan data untuk keperluan audit
                        dan penelusuran jika terjadi insiden keamanan.</li>
                    <li>Menjaga kontrol versi software. Ini memastikan bahwa setiap perubahan yang dilakukan pada perangkat
                        lunak terdokumentasi dan dapat dikembalikan jika ada masalah.</li>
                    <li>Pemantauan serangan siber. Admin bertanggung jawab atas deteksi dini serangan (seperti brute force,
                        DDoS, atau injeksi SQL), dan harus memiliki rencana pemulihan untuk menangani insiden ini.</li>
                </ul>
            </div>

            <!-- 3. Membantu Operasional IT -->
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">3. Membantu Operasional IT</h3>
                <p class="text-gray-600 leading-relaxed">
                    Selain fungsi pengelolaan dan menjaga keamanan, admin juga membantu dalam kelancaran operasional IT
                    perusahaan. Tugas ini meliputi:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                    <li>Membantu divisi lain dalam pemanfaatan sistem IT. Ini termasuk dukungan teknis, pelatihan penggunaan
                        sistem bagi karyawan baru, serta troubleshooting ketika terjadi masalah teknis.</li>
                    <li>Membantu pengembangan sistem dengan memberikan masukan terkait infrastruktur IT yang dibutuhkan
                        untuk mendukung pertumbuhan perusahaan.</li>
                    <li>Membantu dalam audit internal terkait keamanan informasi, memastikan bahwa setiap aspek operasional
                        IT mematuhi standar keamanan yang ditetapkan oleh perusahaan dan peraturan eksternal yang relevan.
                    </li>
                </ul>
            </div>

            <!-- 4. Aturan Keamanan Berdasarkan Standar IT Kriminal -->
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">4. Aturan Keamanan Berdasarkan Standar IT Kriminal</h3>
                <p class="text-gray-600 leading-relaxed">
                    Admin harus mematuhi standar keamanan yang ketat untuk menghindari potensi pelanggaran hukum dan insiden
                    kriminal dalam dunia IT:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-gray-600">
                    <li><strong>Standar Privasi Data</strong>: Admin harus memastikan kepatuhan dengan standar privasi
                        seperti GDPR atau UU ITE di Indonesia, yang melindungi hak privasi individu dan mewajibkan
                        penggunaan informasi pribadi secara aman dan bertanggung jawab.</li>
                    <li><strong>Mencegah Tindakan Cybercrime</strong>: Admin harus melawan potensi tindak kriminal siber
                        dengan memitigasi risiko terhadap serangan hacking, penyusupan data, atau pencurian identitas.
                        Menjaga log akses yang ketat dan menerapkan enkripsi end-to-end untuk semua transmisi data penting.
                    </li>
                    <li><strong>Keamanan Berlapis</strong>: Menggunakan pendekatan <em>Defense in Depth</em> seperti
                        otentikasi ganda (2FA) untuk login admin, enkripsi kuat untuk penyimpanan data, dan patch serta
                        pembaruan perangkat lunak secara berkala untuk menghindari eksploitasi kerentanan yang ada di
                        sistem.</li>
                    <li><strong>Audit dan Monitoring</strong>: Lakukan audit rutin terhadap sistem IT untuk memeriksa adanya
                        kerentanan dan pastikan semua log aktivitas dicatat dengan baik. Admin juga bertanggung jawab untuk
                        melaporkan dan menindaklanjuti setiap aktivitas yang mencurigakan atau pelanggaran yang terdeteksi.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
