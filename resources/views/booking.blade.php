<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Vaksinasi Umroh - Afiya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-b from-[#F5E6CC]/30 to-white">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home.index') }}" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div class="flex items-center gap-2">
                        <img src="afiya_logo.png" class="h-12" alt="Afiya Logo">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 md:py-12">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Daftar Vaksinasi Umroh
                </h1>
                <p class="text-gray-600 mb-8">
                    Isi data diri Anda dengan lengkap dan benar
                </p>

                @if (session('error'))
                    <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-700 text-sm">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif

               <form id="bookingForm" class="space-y-6" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- JENIS VAKSIN (radio) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Vaksin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="product_id" value="{{ $product1->id }}"
                                    class="w-4 h-4 text-[#2BAE66] focus:ring-[#2BAE66]"
                                    {{ old('product_id') == $product1->id ? 'checked' : '' }} required>
                                <span class="text-gray-700">
                                    {{ $product1->name }} <br>
                                    <b>Rp. {{ number_format($product1->price, 0, ',', '.') }}</b>
                                </span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="product_id" value="{{ $product2->id }}"
                                    class="w-4 h-4 text-[#2BAE66] focus:ring-[#2BAE66]"
                                    {{ old('product_id') == $product2->id ? 'checked' : '' }}>
                                <span class="text-gray-700">
                                    {{ $product2->name }}<br> 
                                    <b>Rp. {{ number_format($product2->price, 0, ',', '.') }}</b>
                                </span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="product_id" value="{{ $product3->id }}"
                                    class="w-4 h-4 text-[#2BAE66] focus:ring-[#2BAE66]"
                                    {{ old('product_id') == $product3->id ? 'checked' : '' }}>
                                <span class="text-gray-700">
                                    {{ $product3->name }}<br> 
                                    <b>Rp. {{ number_format($product3->price, 0, ',', '.') }}</b>
                                </span>
                            </label>
                        </div>
                        @error('product_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAMA LENGKAP --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name"
                            value="{{ old('full_name') }}"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                    {{ $errors->has('full_name') ? 'border-red-500' : 'border-gray-300' }}"
                            placeholder="Sesuai paspor" required>
                        @error('full_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- PASSPORT NUMBER --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Paspor <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="passport_number"
                                value="{{ old('passport_number') }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                        {{ $errors->has('passport_number') ? 'border-red-500' : 'border-gray-300' }}"
                                placeholder="A1234567" minlength="5" required>
                            @error('passport_number')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nik"
                                value="{{ old('nik') }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                        {{ $errors->has('nik') ? 'border-red-500' : 'border-gray-300' }}"
                                placeholder="16 digit" maxlength="16" required>
                            @error('nik')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- PASSPORT FILE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            File Paspor <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col gap-2">
                            <input type="file" name="passport_file" accept="image/*,application/pdf"
                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#2BAE66]/10 file:text-[#2BAE66] hover:file:bg-[#2BAE66]/20
                                        {{ $errors->has('passport_file') ? 'border border-red-500 rounded-lg' : '' }}"
                                required>
                            <p class="text-xs text-gray-500">* Jika validasi gagal, file harus diunggah ulang (demi keamanan browser).</p>
                        </div>
                        @error('passport_file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- DOB --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="dob"
                                value="{{ old('dob') }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                        {{ $errors->has('dob') ? 'border-red-500' : 'border-gray-300' }}"
                                required>
                            @error('dob')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- GENDER (radio) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4 pt-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="M"
                                        class="w-4 h-4 text-[#2BAE66] focus:ring-[#2BAE66]"
                                        {{ old('gender') === 'M' ? 'checked' : '' }} required>
                                    <span class="text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="gender" value="F"
                                        class="w-4 h-4 text-[#2BAE66] focus:ring-[#2BAE66]"
                                        {{ old('gender') === 'F' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Perempuan</span>
                                </label>
                            </div>
                            @error('gender')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- PHONE --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                No. Handphone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                        {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}"
                                placeholder="08123456789" required>
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition
                                        {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                                placeholder="email@example.com" required>
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- SCHEDULE (select) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Jadwal <span class="text-red-500">*</span>
                        </label>
                        <select name="schedule_id"
                                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#2BAE66] focus:border-transparent outline-none transition bg-white
                                    {{ $errors->has('schedule_id') ? 'border-red-500' : 'border-gray-300' }}"
                                required>
                            <option value="">Pilih jadwal vaksinasi</option>
                            @php(\Carbon\Carbon::setLocale('id'))
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}"
                                        {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                    {{ $schedule->location }} - {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('l, d F Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('schedule_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <div class="bg-[#F5E6CC]/50 rounded-lg p-4 border border-[#2BAE66]/20">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium">Total Pembayaran:</span>
                            <span id="totalPrice" class="text-2xl font-bold text-[#2BAE66]">Rp 0</span>
                        </div>
                    </div> --}}

                    <button type="submit" class="w-full bg-[#2BAE66] hover:bg-[#229955] text-white font-semibold px-8 py-4 rounded-lg text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                        Lanjut ke Pembayaran
                    </button>
                </form>

            </div>
        </div>
    </main>

    <script>
        // const vaksinPrices = {
        //     '{{ $product1->id }}': {{ $product1->price }},
        //     '{{ $product2->id }}': {{ $product2->price }},
        //     '{{ $product3->id }}': {{ $product3->price }},
        // };

        const form = document.getElementById('bookingForm');
        const totalPriceElement = document.getElementById('totalPrice');
        const fileInput = document.querySelector('input[name="passportFile"]');
        const fileNameElement = document.getElementById('fileName');

        // document.querySelectorAll('input[name="product_id"]').forEach(radio => {
        //     radio.addEventListener('change', (e) => {
        //         const price = vaksinPrices[e.target.value] || 0;
        //         totalPriceElement.textContent = 'Rp ' + price.toLocaleString('id-ID');
        //     });
        // });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                fileNameElement.textContent = 'File terpilih: ' + e.target.files[0].name;
            } else {
                fileNameElement.textContent = '';
            }
        });
    </script>
</body>
</html>