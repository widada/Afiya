<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afiya - Daftar Vaksin Umroh & e-ICV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#FBF7F0]">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="afiya_logo.png" class="h-12" alt="Afiya Logo">
                </div>
                <a href="#status" class="text-[#2BAE66] hover:text-[#229955] font-medium">
                    Cek Status
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="container mx-auto px-4 py-12 md:py-20">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Daftar Vaksin Umroh & e-ICV dengan Mudah
                </h1>

                <p class="text-lg text-gray-600 mb-3">
                    Sehat dan afiyat sebelum menuju Tanah Suci.
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Reservasi vaksin resmi, tanpa repot.
                </p>

                <a href="{{ route('booking.index') }}" class="inline-block bg-[#2BAE66] hover:bg-[#229955] text-white font-semibold px-8 py-4 rounded-full text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                    Daftar Vaksin Sekarang
                </a>

                <div class="mt-4 text-sm text-gray-600">
                    Sudah daftar? <a href="#" class="text-[#2BAE66] hover:text-[#229955] font-medium">Cek Status</a>
                </div>
            </div>
        </section>

        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
                    Tiga Langkah Menuju Kesehatan Ibadah
                </h2>

                <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="flex items-center justify-center mx-auto mb-4">
                            <img src="form.png" alt="Isi data dan pilih jadwal" class="h-16 w-16 object-contain">
                        </div>
                        <div class="bg-[#2BAE66] text-white w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3 text-lg font-bold">
                            1
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">
                            Isi Data & Pilih Jadwal
                        </h3>
                        <p class="text-gray-600">
                            Cukup isi data paspor dan pilih tanggal vaksin yang sesuai
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center mx-auto mb-4">
                            <img src="payment.png" alt="Pembayaran dengan aman" class="h-16 w-16 object-contain">
                        </div>
                        <div class="bg-[#2BAE66] text-white w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3 text-lg font-bold">
                            2
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">
                            Bayar dengan Aman
                        </h3>
                        <p class="text-gray-600">
                            Pembayaran via QRIS atau transfer. Tidak perlu antre di lokasi
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="flex items-center justify-center mx-auto mb-4">
                            <img src="lucide-heart.png" alt="Datang dan terima sertifikat" class="h-16 w-16 object-contain">
                        </div>
                        <div class="bg-[#2BAE66] text-white w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3 text-lg font-bold">
                            3
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">
                            Datang & Terima Sertifikat
                        </h3>
                        <p class="text-gray-600">
                            Vaksinasi di lokasi. Sertifikat e-ICV siap diunduh setelahnya
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-[#FBF7F0] py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-4">
                    Paket Vaksin Umroh di Afiya
                </h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                    Semua paket sudah termasuk administrasi & sertifikat e-ICV resmi
                </p>
        
                <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-6">
                    <div class="relative bg-white rounded-2xl p-8 shadow-md transition-all duration-300 border-2 border-transparent hover:shadow-xl hover:-translate-y-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center">
                            {{ $product1->name }}
                        </h3>
                        <div class="text-center mb-6">
                            <span class="text-3xl font-bold text-gray-900">Rp. {{ number_format($product1->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <div class="text-center text-gray-600 flex flex-col gap-1">
                                <span>{{ $product1->description }}</span>
                            </div>
                        </div>
                        <a href="{{ route('booking.index') }}?product_id={{ $product1->id }}" class="block w-full text-center font-semibold px-6 py-3 rounded-full transition-all duration-300 border-2 border-[#2BAE66] text-[#2BAE66] hover:bg-[#2BAE66] hover:text-white">
                            Pilih Paket Ini
                        </a>
                    </div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-md transition-all duration-300 border-2 border-transparent hover:shadow-xl hover:-translate-y-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center">
                            {{ $product2->name }}
                        </h3>
                        <div class="text-center mb-6">
                            <span class="text-3xl font-bold text-gray-900">Rp. {{ number_format($product2->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <div class="text-center text-gray-600 flex flex-col gap-1">
                                <span>{{ $product2->description }}</span>
                            </div>
                        </div>
                        <a href="{{ route('booking.index') }}?product_id={{ $product2->id }}" class="block w-full text-center font-semibold px-6 py-3 rounded-full transition-all duration-300 border-2 border-[#2BAE66] text-[#2BAE66] hover:bg-[#2BAE66] hover:text-white">
                            Pilih Paket Ini
                        </a>
                    </div>

                    <div class="relative bg-white rounded-2xl p-8 shadow-md transition-all duration-300 border-2 border-[#2BAE66] shadow-xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center">
                            {{ $product3->name }}
                        </h3>
                        <div class="text-center mb-6">
                            <span class="text-3xl font-bold text-gray-900">Rp. {{ number_format($product3->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <div class="text-center text-gray-600 flex flex-col gap-1">
                                <span>{{ $product3->description }}</span>
                            </div>
                        </div>
                        <a href="{{ route('booking.index') }}?product_id={{ $product3->id }}" class="block w-full text-center font-semibold px-6 py-3 rounded-full transition-all duration-300 bg-[#2BAE66] hover:bg-[#229955] text-white shadow-md">
                            Paket Terpilih
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Siapkan vaksin umroh dengan aman dan resmi
                </h2>
                <a href="{{ route('booking.index') }}" class="inline-block bg-[#2BAE66] hover:bg-[#229955] text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 mt-4">
                    Mulai Pendaftaran
                </a>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <img src="afiya_logo.png" class="h-12" alt="Afiya Logo">
                </div>
                <p class="text-gray-400 mb-4">
                    Layanan vaksinasi umroh terpercaya
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center text-sm text-gray-400">
                    <div>Email : info@afiya.id</div>
                    <div class="hidden md:block">|</div>
                    <div>Telepon : +62 812 3456 7890</div>
                    <div class="hidden md:block">|</div>
                    <div>WhatsApp : +62 812 3456 7890</div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>