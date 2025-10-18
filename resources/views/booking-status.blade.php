<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <title>Afiya - Cek Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-b from-[#F5E6CC]/30 to-white">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    {{-- <button class="text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-6 h-6">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>
                    </button> --}}
                    <div class="flex items-center gap-2">
                        <a href="/">
                            <img src="afiya_logo.png" class="h-12">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="flex-grow container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2" style="font-family: Poppins, sans-serif;">Cek Status Booking</h1>
                <p class="text-gray-600 mb-6">Masukkan Kode Booking Anda untuk melihat status booking</p>
                <form class="flex gap-3" method="GET" action="{{ route('booking.status') }}">
                    <input type="text" name="order_id" placeholder="Contoh: AFY12345" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition" value="{{ old('order_id', request('order_id')) }}">
                    <button type="submit" class="bg-[#2BAE66] hover:bg-[#229955] text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        Cek Status
                    </button>
                </form>
                @if (!@empty($error))
                <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-700 text-sm">
                        {{ $error }}
                    </p>
                </div>
                @endif
            </div>

            @if(!empty($booking))
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <div class="bg-[#F5E6CC]/30 rounded-lg p-6 mb-8 border border-[#2BAE66]/20">
                    <h2 class="font-semibold text-gray-900 mb-4 text-lg">Informasi Booking</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Kode Booking</span>
                            <p class="font-semibold text-[#2BAE66] text-lg">{{ $booking->booking_code }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Nama</span>
                            <p class="font-medium text-gray-900">{{ $booking->full_name }}</p>
                        </div>

                        @php(\Carbon\Carbon::setLocale('id'))
                        <div>
                            <span class="text-sm text-gray-600">Jadwal</span>
                            <p class="font-medium text-gray-900">{{ $booking->schedule_place }} - {{ \Carbon\Carbon::parse($booking->schedule_date)->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Status</span>
                            <p class="font-medium text-gray-900 capitalize">{{ $booking->status }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">Jenis Vaksin</span>
                            <p class="font-medium text-lg">{{ $booking->product_name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Harga Vaksin</span>
                            <p class="font-medium text-gray-900">{{ number_format($booking->product_price, 0, ',', '.') }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">NIK</span>
                            <p class="font-medium text-lg">{{ $booking->nik }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Tanggal Lahir</span>
                            <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->dob)->translatedFormat('d F Y') }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">Nomor Passport</span>
                            <p class="font-medium text-gray-900">{{ $booking->passport_number }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">File Passport</span>
                            <p class="font-medium text-lg underline">
                                <a href="{{ asset('storage/'.$booking->passport_file) }}" target="_blank">🪪 Passport</a>
                            </p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">Email</span>
                            <p class="font-medium text-lg">{{ $booking->email }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">No. Handphone</span>
                            <p class="font-medium text-gray-900">{{ $booking->phone }}</p>
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">Status Vaksin</span>
                            @if($booking->is_vaccinated)
                                <p class="font-semibold text-[#2BAE66] text-lg">SUDAH VAKSIN</p>
                            @else
                                <p class="font-semibold text-[#ff0057] text-lg">BELUM VAKSIN</p>
                            @endif
                        </div>

                        <div>
                            <span class="text-sm text-gray-600">Sertifikat Vaksin</span>
                             <p class="font-medium text-lg underline">
                                @if(!empty($booking->vaccine_certificate_file))
                                    <a href="{{ asset('storage/'.$booking->vaccine_certificate_file) }}" target="_blank">🔖 Sertifikat</a>
                                @else
                                    BELUM TERSEDIA
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                {{-- <h3 class="font-semibold text-gray-900 mb-6 text-lg">Timeline Status</h3> --}}
                {{-- <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[#2BAE66]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle2 w-6 h-6 text-white">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="w-0.5 h-12 bg-[#2BAE66]"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold mb-1 text-gray-900">Booked</h4>
                            <p class="text-sm text-gray-600">Booking berhasil dibuat</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[#2BAE66]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle2 w-6 h-6 text-white">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="w-0.5 h-12 bg-[#2BAE66]"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold mb-1 text-gray-900">Paid</h4>
                            <p class="text-sm text-gray-600">Pembayaran berhasil</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-gray-400">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div class="w-0.5 h-12 bg-gray-200"></div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold mb-1 text-gray-400">Menunggu Vaksinasi</h4>
                            <p class="text-sm text-gray-400">Silakan datang sesuai jadwal</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-gray-400">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 pb-8">
                            <h4 class="font-semibold mb-1 text-gray-400">Sertifikat Tersedia</h4>
                            <p class="text-sm text-gray-400">Sertifikat siap diunduh</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="mt-8 bg-blue-50 rounded-lg p-6 border border-blue-200">
                    <p class="text-blue-800 text-sm"><strong>Informasi:</strong> Silakan datang ke lokasi vaksinasi sesuai jadwal yang telah dipilih. Jangan lupa membawa paspor dan KTP asli.</p>
                </div> --}}
            </div>
            @endif
        </div>
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