<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Modal Overlay */
        .login-overlay {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .login-overlay.active {
            display: flex;
            opacity: 1;
        }

        /* Modal */
        .login-modal {
            transform: scale(0.7);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .login-overlay.active .login-modal {
            transform: scale(1);
            opacity: 1;
        }

        /* Pop-up Animation */
        .pop-up-enter {
            animation: popUpEnter 0.3s ease-out;
        }

        .pop-up-exit {
            animation: popUpExit 0.3s ease-in;
        }

        @keyframes popUpEnter {
            0% {
                transform: scale(0.7);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes popUpExit {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0;
            }

            100% {
                transform: scale(0.7);
                opacity: 0;
            }
        }

        /* Hover Effect for h4 */
        .transition-color {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        .transition-color:hover {
            background-color: #3b82f6;
            /* Blue color on hover */
            color: white;
            /* Text color on hover */
        }

        /* Hover Effect for Button */
        .transition-bg {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .transition-bg:hover {
            background-color: #3b82f6;
            /* Darker blue color */
            transform: scale(1.05);
            /* Slightly enlarge button on hover */
        }

        .fade-in-down {
            animation: fadeInDown 0.5s ease-out forwards;
        }

        .fade-out-up {
            animation: fadeOutUp 0.5s ease-in forwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        /* Transisi untuk modal konfirmasi */
        .confirmation-overlay {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .confirmation-overlay.flex {
            display: flex;
            opacity: 1;
        }

        .confirmation-modal {
            transform: translateY(-30px);
            transition: transform 0.3s ease;
        }

        .confirmation-modal.pop-up-enter {
            transform: translateY(0);
        }

        .confirmation-modal.pop-up-exit {
            transform: translateY(-30px);
        }
    </style>
</head>

<body class="bg-gradient-to-r text-white font-sans">
    <!-- Page Content -->
    <div class="flex flex-col min-h-screen">
        <header class="bg-blue-500 shadow-lg py-4 fixed w-full z-50 top-0">
            <div class="container mx-auto flex justify-between items-center px-4">
                <img src="data:image/jpeg;base64,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"
                    alt="Gambar Pelatihan" class="w-15 h-10 rounded-lg transition-all duration-300">
                <div class="flex space-x-4">
                    <a href="{{ route('register') }}"
                        class="bg-blue-400 text-white font-bold py-2 px-4 rounded-md transition duration-200 hover:bg-blue-500">
                        Daftar
                    </a>
                    <button id="loginBtn"
                        class="bg-blue-400 text-white font-bold py-2 px-4 rounded-md transition duration-200 hover:bg-blue-500">
                        Masuk
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-grow bg-white text-blue-500 mt-16">
            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div id="errorAlert"
                    class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-sm font-bold p-3 rounded-lg z-50">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mt-10 max-w-3xl mx-auto px-6">
                <div class="relative rounded-lg overflow-hidden">
                    <div class="flex justify-center">
                        <div class="flex items-center bg-blue-500 p-2 rounded-3xl shadow-lg">
                            <img src="data:image/jpeg;base64,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"
                                alt="Gambar Pelatihan" class="w-full h-auto rounded-3xl transition-all duration-300">
                        </div>
                    </div>
                    <h2 class="text-4xl font-bold text-blue-500 text-center relative p-10">
                        Direktori Pelatihan dan Pengembangan
                    </h2>
                </div>
                <p class="mb-6 text-gray-700 dark:text-gray-700 text-justify">
                    Value Consult adalah lembaga pelatihan yang telah berdiri sejak tahun 1999. Kami menawarkan
                    pelatihan baik secara publik maupun in-house dengan materi yang langsung bisa diaplikasikan dalam
                    dunia kerja.
                </p>
                <p class="text-gray-700 dark:text-gray-700 text-justify">
                    Kami menyediakan pelatihan dan konsultasi berkualitas tinggi untuk membantu Anda mencapai kesuksesan
                    dalam dunia kerja.
                </p>

                <div class="container mx-auto p-6">
                    <div class="flex items-center bg-blue-500 p-4 rounded-lg shadow-lg mb-4">
                        <img src="https://valueconsulttraining.com/wp-content/uploads/2022/12/mpd-logo.jpg"
                            alt="Deskripsi Gambar" class="w-full h-50 object-cover rounded-lg mr-4">
                    </div>
                    <div class="flex items-center bg-blue-500 p-4 rounded-lg shadow-lg mt-4">
                        <img src="https://valueconsulttraining.com/wp-content/uploads/2023/11/logo-the-lean-six-sigma.jpg"
                            alt="Deskripsi Gambar" class="w-full h-50 object-cover rounded-lg mr-4">
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg shadow-lg mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-blue-800">Visi dan Misi</h2>
                    <p class="text-lg mb-4 text-blue-800">
                        <strong>Visi:</strong> Menjadi mitra strategis dalam pengembangan sumber daya manusia di
                        Indonesia.
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        <strong>Misi:</strong> Menyediakan solusi pelatihan yang berkualitas dan inovatif untuk
                        meningkatkan kinerja individu dan organisasi.
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        Value Consult menjunjung tinggi nilai-nilai profesionalisme, inovasi, dan dedikasi terhadap
                        peningkatan kompetensi. Perusahaan ini berkomitmen untuk terus beradaptasi dengan perubahan
                        industri dan kebutuhan pasar.
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        Menyelenggarakan berbagai jenis pelatihan, mulai dari soft skills (komunikasi, kepemimpinan,
                        negosiasi) hingga technical skills (manajemen proyek, analisis data).
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        Memberikan layanan konsultasi terkait pengembangan sumber daya manusia, seperti assessment
                        center, career development, dan organizational development.
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        Selain pelatihan umum, Value Consult juga menawarkan program pelatihan khusus yang disesuaikan
                        dengan kebutuhan industri tertentu, seperti teknologi, kesehatan, dan keuangan.
                    </p>
                    <p class="text-lg mb-4 text-blue-800">
                        <strong>Sejarah Perusahaan:</strong> Value Consult didirikan dengan misi untuk memberikan solusi
                        pelatihan berkualitas tinggi. Sejak awal, perusahaan ini telah berkomitmen untuk mengembangkan
                        sumber daya manusia melalui pelatihan yang relevan dan efektif. Dalam perjalanan lebih dari dua
                        dekade, Value Consult telah mencapai berbagai pencapaian signifikan, termasuk kerjasama dengan
                        berbagai perusahaan besar dan lembaga pemerintah.
                    </p>
                    <a href="#latest-posts"
                        class="inline-block mt-8 px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                        Mulai Sekarang
                    </a>
                </div>
                <h3 class="text-2xl font-semibold mb-4 text-blue-500">
                    Siapa Value Consult?
                </h3>
                <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6">
                    Didirikan pada tahun 1999, Value Consult memiliki niat yang kuat untuk menjadi mitra Anda, pelanggan
                    berharga kami, dalam pengembangan masyarakat yang menciptakan nilai tambah di setiap layanan yang
                    kami tawarkan.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6">
                    Kami memiliki lebih dari 500 topik pelatihan umum yang ditawarkan secara berkala. Topik yang kami
                    sampaikan didasarkan pada niat untuk memenuhi kebutuhan industri. Mulai dari pengadaan hingga
                    layanan pelanggan, dari kepemimpinan hingga pembinaan dan konseling, topik kami adalah campuran
                    pengembangan topik berdasarkan penelitian dengan pengalaman dan keahlian pelatih kami.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6">
                    Layanan kami kepada Anda sebagai klien kami disampaikan oleh lebih dari 100 praktisi - rekrutmen
                    pelatih dengan berbagai kemampuan dan pengalaman mendalam yang akan menciptakan nilai tambah dalam
                    pelatihan dan proses konsultasi Anda. Pelatih kami adalah praktisi namun mereka juga memiliki latar
                    belakang akademis yang kuat. Dengan pengalaman kerja mulai dari 10 hingga 30 tahun, keahlian
                    manajemen, wawasan, pengetahuan, pemahaman, sumber daya, pengetahuan yang dibagikan oleh pelatih
                    kami harus dapat memenuhi kebutuhan para peserta. Ini telah menjadikan Value Consult sebagai salah
                    satu penyedia pelatihan yang paling dapat diandalkan di Indonesia.
                </p>

                <div class="container mx-auto p-6">
                    <h3 class="text-3xl font-semibold mb-4 text-blue-500 text-center">
                        Pelatihan Apa Saja yang Value Consult Sediakan?
                    </h3>
                    <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6">
                        <b class="text-blue-500">Value Consult</b> menawarkan berbagai topik pelatihan yang dirancang
                        untuk memenuhi kebutuhan profesional Anda. Berikut adalah beberapa topik pelatihan yang kami
                        tawarkan:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 text-lg mb-6 space-y-2">
                        @if ($categories->isEmpty())
                            <li class="text-gray-500">Tidak ada kategori yang tersedia.</li>
                        @else
                            @foreach ($categories as $category)
                                <li>{{ $category->category_name }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <p class="text-lg text-gray-700 leading-relaxed text-justify mb-6">
                        Selain itu, <b class="text-blue-500">Value Consult</b> juga menyediakan pelatihan secara publik
                        maupun in-house, sehingga Anda dapat memilih format yang paling sesuai untuk kebutuhan
                        organisasi Anda.
                    </p>
                </div>
                <div class="container mx-auto p-6">
                    <h3 class="text-3xl font-semibold mb-4 text-blue-600 text-center">
                        Dimana Lokasi Pelatihan?
                    </h3>
                    <p class="text-lg text-gray-800 leading-relaxed text-justify mb-6">
                        Value Consult menyediakan pelatihan di beberapa hotel di Jakarta. Berikut adalah lokasi-lokasi
                        yang tersedia:
                    </p>
                    <ul class="list-disc list-inside text-gray-800 text-lg mb-6">
                        @if ($hotels->isEmpty())
                            <li class="text-gray-500">Tidak ada hotel yang tersedia.</li>
                        @else
                            @foreach ($hotels as $hotel)
                                <li class="mb-2">{{ $hotel->name }} - {{ $hotel->location }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row items-start bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
                        <div class="text-gray-700">
                            <h3 class="text-xl font-semibold text-blue-600">Berapa Lama Durasi Pelatihan?</h3>
                            <p class="mt-2">
                                Value Consult menyediakan pelatihan yang berdurasi antara 1-4 hari. Waktu durasi
                                pelatihan dimulai dari 09.00-17.00 WIB.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-start bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
                        <div class="text-gray-700">
                            <h3 class="text-xl font-semibold text-blue-600">Berapa Rate Harga Pelatihan?</h3>
                            <p class="mt-2">
                                Rate harga pelatihan di Value Consult berkisar antara Rp 2.250.000-9.045.000 tergantung
                                dari durasi hari pelatihannya.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-start bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
                        <div class="text-gray-700">
                            <h3 class="text-xl font-semibold text-blue-600">Bagaimana Jika Ingin Mengikuti Pelatihan Di
                                Value Consult?</h3>
                            <p class="mt-2">
                                Anda bisa mengikuti pelatihan kami dengan cara:
                            <ul class="list-disc ml-5 mt-2">
                                <li>Langsung klik tombol <a href="{{ route('register') }}"
                                        class="text-blue-500 font-bold">Daftar</a>.</li>
                                <li>Mengemail kami di <a href="mailto:cs@valueconsulttraining.com"
                                        class="text-blue-500">cs@valueconsulttraining.com</a>.</li>
                                <li>Menghubungi CS kami di <a href="tel:02179198730" class="text-blue-500">021 7919
                                        8730</a> atau WhatsApp CS kami di <a href="https://wa.me/6285210715280"
                                        class="text-blue-500">0852-1071-5280</a>.</li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-10">
                    <h3 class="text-2xl font-semibold mb-4 text-blue-500">
                        About Us
                    </h3>
                    <p class="text-lg mb-6 text-gray-700 text-justify">
                        Didirikan pada tahun 1999, Value Consult memiliki niat yang kuat untuk menjadi mitra Anda,
                        pelanggan berharga kami, dalam pengembangan masyarakat yang menciptakan nilai tambah di setiap
                        layanan yang kami tawarkan.
                    </p>
                    <p class="text-lg mb-6 text-gray-700 text-justify">
                        Kami memiliki lebih dari 500 topik pelatihan umum yang ditawarkan secara berkala. Topik yang
                        kami sampaikan didasarkan pada niat untuk memenuhi kebutuhan industri. Mulai dari pengadaan
                        hingga layanan pelanggan, dari kepemimpinan hingga pembinaan dan konseling, topik kami adalah
                        campuran pengembangan topik berdasarkan penelitian dengan pengalaman dan keahlian pelatih kami.
                    </p>
                    <p class="text-lg mb-6 text-gray-700 text-justify">
                        Layanan kami kepada Anda sebagai klien kami disampaikan oleh lebih dari 100 praktisi – rekrutmen
                        pelatih dengan berbagai kemampuan dan pengalaman mendalam yang akan menciptakan nilai tambah
                        dalam pelatihan dan proses konsultasi Anda. Pelatih kami adalah praktisi namun mereka juga
                        memiliki latar belakang akademis yang kuat. Dengan pengalaman kerja mulai dari 10 hingga 30
                        tahun, keahlian manajemen, wawasan, pengetahuan, pemahaman, sumber daya, pengetahuan yang
                        dibagikan oleh pelatih kami harus dapat memenuhi kebutuhan para peserta. Ini telah menjadikan
                        Value Consult sebagai salah satu penyedia pelatihan yang paling dapat diandalkan di Indonesia.
                    </p>
                    <div class="container mx-auto p-6">
                        <h2 class="text-3xl font-bold mb-4 text-center">Kompetensi</h2>
                        <div class="flex flex-col md:flex-row items-center bg-gray-100 p-4 rounded-lg shadow-lg">
                            <div class="md:mr-6 mb-4 md:mb-0 text-gray-700">
                                <p class="text-lg">
                                    Sejak awal berdirinya, VC mengedepankan materi-materi pelatihan yang sifatnya
                                    aplikatif.
                                    Sehingga kebanyakan trainer kami mempunyai pengalaman sebagai praktisi selain,
                                    tentunya,
                                    latar belakang akademis yang memadai.
                                </p>
                            </div>
                            <img src="https://valueconsulttraining.com/wp-content/uploads/2019/05/kompetensi-300x266.png.webp"
                                alt="Timeline Perusahaan" class="w-full md:w-48 h-auto object-contain rounded-lg">
                        </div>
                    </div>
                    <div class="container mx-auto p-6">
                        <h2 class="text-3xl font-bold mb-4 text-center">Tahapan Pelatihan</h2>
                        <div class="flex flex-col md:flex-row items-center bg-gray-100 p-4 rounded-lg shadow-lg">
                            <img src="https://valueconsulttraining.com/wp-content/uploads/2019/05/Picture1-264x300.png.webp"
                                alt="Timeline Perusahaan"
                                class="w-48 h-auto object-contain rounded-lg md:mr-6 mb-4 md:mb-0">
                            <div class="text-gray-700">
                                <h3 class="text-xl font-semibold mb-2">1. PRA TRAINING</h3>
                                <p class="mb-4">
                                    Penyebaran kuesionair, pelaksanaan FGD dengan calon peserta, atasan peserta dan
                                    pihak SDM.
                                    Taylor made materi sesuai dengan kebutuhan yang ada.
                                </p>
                                <h3 class="text-xl font-semibold mb-2">2. TRAINING</h3>
                                <p class="mb-4">
                                    Pelaksanaan Pelatihan.
                                </p>
                                <h3 class="text-xl font-semibold mb-2">3. PASKA TRAINING</h3>
                                <p>
                                    Follow up Program.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="container mx-auto p-6">
                        <h2 class="text-3xl font-bold mb-6 text-center">Klien Kami</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-14 bg-gray-100 p-4 rounded-lg shadow-lg">
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">BANKING</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Bank Indonesia, Bank BNI, Bank Mandiri, Bank Danamon, BSM, Bank BTN, Bank Artha
                                    Graha,
                                    Bank BNP, Bank UOB, Bank BTPN.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">GOVERNMENT & BUMN</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Bapepam LK, Kementerian Keuangan RI, BKKBN, BLK Makassar, Lembaga Sandi Negara,
                                    LKPP, P3ED Makassar, SEAMEO, Pertamina Learning Center, Thames PAM Jaya, Bappenas,
                                    BPD Sumsel, Garuda Maintenance Facility, KPK, BBLKI Surakarta.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">INSURANCE & FINANCIAL INSTITUTION
                                </h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    AIG/Lippo Life, Asuransi Jiwasraya, ORIX Finance Indonesia, Jakarta Stock Exchange
                                    (BEJ),
                                    Tugu Pratama, PT. Astra Credit Companies, PT. Arthaasia Finance, PT Dipo Star
                                    Finance,
                                    Asuransi MSIG.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">AUTOMOTIVE</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Daimler Chrysler, Indomobil Suzuki International, Opel/General Motors Indonesia,
                                    Tunas Ridean, Tunas Rental, Toyota, Yamaha Motor.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">OIL & MINING</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Berau Coal, British Petroleum, Kaltim Prima Coal, PT. Transportasi Gas Indonesia,
                                    PT Saptaindra Sejati (SIS), Elnusa.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">MANUFACTURING</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    ADIDAS, Asia Pulp & Paper, Jawamanis Rafinasi, YKK Zipper, Hitachi, LG Electronics
                                    Indonesia, Akzo Nobel, Impact Pratama, Panarub Industry, 3M, Tetra Pack, BHP Steel
                                    Indonesia, TEAC, Koito Indonesia.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">NGO</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    ICRAF, MICRA, Plan Indonesia, The Nature Conservancy, Dompet Dhuafa, Yayasan Wakaf
                                    Al Azhar, Kemitraan, Putera Sampoerna Foundation, SEAMEO.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">DISTRIBUTION & LOGISTICS</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Wicaksana Overseas International, DHL, HAVI Logistic, Ceva Logistic, QDC
                                    Technologies,
                                    Pro Logistic, Tiga Raksa, Berca Hardaya Perkasa, Luxindo.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">MEDIA</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    MRA, MNC Group, Blitz Megaplex, Astro, LKBN Antara, Republika, Media Indonesia.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">PROPERTY</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Bogor Lake Side, KSO Summarecon, Ciputra.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">CONSUMER GOODS & RETAIL</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    AQUA - Danone, Greenfields, Coca Cola Bottling, Hoka Hoka Bento, Alfamart.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">PHARMACY</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Dankos, OtsukA, Sanofi Aventis, PT Medquest, Medion.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">TELECOMMUNICATION</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Mobile 8, Indosat, Telkom, Telkomsel.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-center">PUBLISHING</h3>
                                <p class="text-gray-700 text-sm text-justify">
                                    Gramedia, Penerbit Erlangga, Gelora Aksara Pratama.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Postingan Acak -->
            <div id="latest-posts" class="container mx-auto p-6">
                <h2 class="text-3xl font-bold mb-6 text-center">Pelatihan Terbaru Kami</h2>

                @if (isset($posts) && $posts->isNotEmpty())
                    <!-- Grid Responsif -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center">
                        @foreach ($posts as $post)
                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $post->dataPrice->training_title }}"
                                        class="w-full rounded-lg h-40 object-cover">
                                @else
                                    <img src="https://via.placeholder.com/400x200?text=No+Image" alt="No Image"
                                        class="w-full h-40 object-cover">
                                @endif

                                <div class="p-4 text-center">
                                    <h2 class="text-xl font-bold mb-2">
                                        {{ $post->dataPrice->training_title }}</h2>
                                    <p class="text-blue-600 text-sm mb-2">
                                        {{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}
                                    </p>
                                    <div class="text-blue-600 text-xs mb-2">
                                        <p>Trainer: <span class="font-bold">{{ $post->trainer->name }}</span></p>
                                        <p>Price: <span
                                                class="font-bold">Rp{{ number_format($post->dataPrice->price, 2) }}</span>
                                        </p>
                                        <p>Category: <span
                                                class="italic">{{ $post->categoriesPost->category_name }}</span></p>
                                    </div>
                                    <div class="">
                                        <button
                                            class="learnMoreBtn inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg transition duration-300 ease-in-out hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                                            Detail Training
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Pesan jika tidak ada postingan -->
                    <p class="text-gray-500 text-center">Tidak ada postingan yang tersedia saat ini.</p>
                @endif
            </div>
            <div class="container mx-auto p-6">
                <div class="flex flex-col md:flex-row items-center bg-blue-50 p-4 rounded-lg shadow-lg">
                    <div class="md:mr-6 mb-4 md:mb-0 text-gray-800 text-justify">
                        <h2 class="text-2xl font-semibold text-blue-600 mb-2">Terima Kasih Telah Mengunjungi Kami!</h2>
                        <p class="text-lg mb-4">
                            Jika Anda ingin mendapatkan informasi lebih lengkap tentang pelatihan dan kategori yang kami
                            tawarkan,
                            kami sangat menyarankan Anda untuk
                            <a href="#" class="text-blue-500 font-bold transition duration-300 hover:underline"
                                onclick="smoothScroll(event)">Daftar</a>
                            atau
                            <a href="#" class="text-blue-500 font-bold transition duration-300 hover:underline"
                                onclick="smoothScroll(event)">Login</a>
                            ke akun Anda.
                        </p>
                        <p class="text-lg">
                            Dengan begitu, Anda akan mendapatkan akses penuh ke berbagai materi dan penawaran eksklusif
                            dari
                            Value Consult. Kami berharap dapat segera membantu Anda dalam pengembangan keterampilan
                            Anda!
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-blue-600 py-8 text-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Informasi Kontak -->
                    <div>
                        <h3 class="text-lg font-bold mb-2">Kontak</h3>
                        <p class="flex items-center mb-2 text-lg">
                            <i class="fas fa-phone mr-2 text-xl"></i>
                            021-7919 8730
                        </p>
                        <p class="flex items-center mb-2 text-lg">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i>
                            +62 813 8834 2078 (WhatsApp)
                        </p>
                        <p class="flex items-center mb-2 text-lg">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i>
                            +62 812 1268 7727 (WhatsApp)
                        </p>
                        <p class="text-sm">(Untuk topik non-legal & non-managerial)</p>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <h3 class="text-lg font-bold mb-2">Kantor Pusat</h3>
                        <p class="text-lg">
                            PT Kreasi Nilai Grup<br>
                            Gedung ILP Lantai 2, Ruang 219,<br>
                            Jalan Raya Pasar Minggu No.39A,<br>
                            Kota Jakarta Selatan,<br>
                            Daerah Khusus Ibukota Jakarta 12780
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-bold mb-2">Quick Links</h3>
                        <ul class="space-y-1">
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">Home</a></li>
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">About Us</a>
                            </li>
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">Six Sigma</a>
                            </li>
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">Public
                                    Inclass</a></li>
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">Public
                                    Inhouse</a></li>
                            <li><a href="#" class="hover:underline hover:text-blue-300 transition">Articles</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-lg font-bold mb-2">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-blue-300 transition" aria-label="Facebook">
                                <i class="fab fa-facebook-f text-2xl"></i>
                            </a>
                            <a href="#" class="hover:text-blue-300 transition" aria-label="YouTube">
                                <i class="fab fa-youtube text-2xl"></i>
                            </a>
                            <a href="#" class="hover:text-blue-300 transition" aria-label="Instagram">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <a href="#" class="hover:text-blue-300 transition" aria-label="LinkedIn">
                                <i class="fab fa-linkedin text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-sm">&copy; <?php echo date('Y'); ?> Semua hak dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="login-overlay fixed inset-0 bg-black bg-opacity-50 justify-center items-center">
        <div id="loginModalContent"
            class="login-modal bg-gray-200 text-gray-800 rounded-lg shadow-lg p-8  m-4 w-full max-w-md pop-up-enter">
            <h4 class="text-center text-2xl font-semibold mb-4 bg-white text-blue-500 rounded-lg p-2 transition-color">
                Masuk
            </h4>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-lg font-medium mb-1 text-gray-700">Nama Pengguna</label>
                    <input type="text"
                        class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-150 ease-in-out"
                        id="username" name="username" value="{{ old('username') }}" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-lg font-medium mb-1 text-gray-700">Kata Sandi</label>
                    <input type="password"
                        class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-150 ease-in-out"
                        id="password" name="password" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-md shadow-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                    Masuk
                </button>
                <button type="button" id="closeLogin"
                    class="mt-4 w-full text-blue-500 hover:text-blue-600 font-bold py-2 px-4 rounded-md">
                    Tutup
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Login -->
    <div id="confirmationModal"
        class="confirmation-overlay fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div id="confirmationModalContent"
            class="confirmation-modal bg-gray-200 text-gray-800 rounded-lg shadow-lg p-8 w-full max-w-md pop-up-enter">
            <h4 class="text-center text-2xl font-semibold mb-4 bg-white text-blue-500 rounded-lg p-2 transition-color">
                Perlu Login
            </h4>
            <p class="text-center text-lg mb-4">Anda harus login terlebih dahulu untuk melihat detail ini.</p>
            <div class="text-center">
                <button id="closeConfirmation"
                    class="mt-2 w-full bg-blue-400 text-white font-bold py-2 px-4 rounded-md transition duration-200 hover:bg-blue-500">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function smoothScroll(event) {
            event.preventDefault(); // Mencegah default action
            window.scrollTo({
                top: 0, // Scroll ke atas halaman
                behavior: 'smooth', // Efek smooth
            });
        }

        document.getElementById('loginBtn').addEventListener('click', function() {
            const modal = document.getElementById('loginModal');
            const modalContent = document.getElementById('loginModalContent');
            modal.classList.add('active');
            modalContent.classList.add('pop-up-enter');
        });

        document.getElementById('closeLogin').addEventListener('click', function() {
            const modal = document.getElementById('loginModal');
            const modalContent = document.getElementById('loginModalContent');
            modalContent.classList.remove('pop-up-enter');
            modalContent.classList.add('pop-up-exit');
            setTimeout(() => {
                modal.classList.remove('active');
                modalContent.classList.remove('pop-up-exit');
            }, 300); // Sesuaikan dengan durasi animasi
        });

        document.addEventListener('DOMContentLoaded', function() {
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('fade-in-down');
                    errorAlert.classList.add('fade-out-up');
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 500); // Durasi animasi fade-out (0.5 detik)
                }, 5000); // 5 detik sebelum mulai menghilang
            }
        });


        // modal konfirmasi
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk tombol "Detail Training"
            const learnMoreButtons = document.querySelectorAll('.learnMoreBtn');

            learnMoreButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah link default behavior
                    const modal = document.getElementById('confirmationModal');
                    const modalContent = document.getElementById('confirmationModalContent');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modalContent.classList.add('pop-up-enter');
                });
            });

            // Event listener untuk tombol "Tutup" di modal konfirmasi
            document.getElementById('closeConfirmation').addEventListener('click', function() {
                const modal = document.getElementById('confirmationModal');
                const modalContent = document.getElementById('confirmationModalContent');
                modalContent.classList.remove('pop-up-enter');
                modalContent.classList.add('pop-up-exit');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modalContent.classList.remove('pop-up-exit');
                }, 300); // Sesuaikan dengan durasi animasi
            });

            // Event listener untuk tombol "Login Sekarang"
            document.getElementById('loginNowBtn').addEventListener('click', function() {
                // Redirect ke halaman login
                window.location.href = "{{ route('login.post') }}"; // Sesuaikan dengan route login Anda
            });

            // Menghilangkan notifikasi error setelah beberapa waktu
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.classList.remove('fade-in-down');
                    errorAlert.classList.add('fade-out-up');
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 500); // Durasi animasi fade-out (0.5 detik)
                }, 5000); // 5 detik sebelum mulai menghilang
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');

            for (const link of links) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>
