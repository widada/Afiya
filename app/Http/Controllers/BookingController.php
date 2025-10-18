<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use View;
// use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $product1 = Product::find(1);
        $product2 = Product::find(2);
        $product3 = Product::find(3);

        $schedules = Schedule::all();

        return view('booking', compact('product1', 'product2', 'product3', 'schedules'));
    }

    public function status(Request $request)
    {
        $bookingCode = $request->query('order_id');

        if (!$bookingCode) {
            return view('booking-status');
        }

        $booking = Booking::where('booking_code', $bookingCode)->first();

        if (!$booking) {
            return view('booking-status', [
                'error' => 'Kode Booking tidak ditemukan!',
            ]);
        }

        return view('booking-status', compact('booking'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            // ID & relasi
            'product_id'  => ['required','integer','exists:products,id'],
            'schedule_id' => ['required','integer','exists:schedules,id'],

            // Identitas
            'full_name'        => ['required','string','min:3','max:200'],
            'passport_number'  => ['required','string','min:5','max:50'],
            'nik'              => ['required','digits:16'],
            'dob'              => ['required','date_format:Y-m-d','before_or_equal:today'],
            'gender'           => ['required','in:M,F'],

            // Kontak
            'phone'            => ['required','string','min:8','max:25'],
            'email'            => ['required','email:rfc,dns','max:255'],

            // File
            'passport_file'    => ['required','file','mimes:jpg,jpeg,png,pdf','max:5120'], // 5MB
        ]);

        $product  = Product::findOrFail($validated['product_id']);
        $schedule = Schedule::findOrFail($validated['schedule_id']);
        
        $validated['product_name'] = $product->name;
        $validated['product_price'] = $product->price;
        $validated['schedule_place'] = $schedule->location;
        $validated['schedule_date'] = $schedule->date;

        try {
            return DB::transaction(function () use ($request, $validated) {
                $dir  = 'bookings/passports/' . now()->format('Y/m');
                $ext  = $request->file('passport_file')->getClientOriginalExtension();
                $name = Str::uuid()->toString().'.'.$ext;

                $path = $request->file('passport_file')->storeAs($dir, $name, 'public');

                $payload = $validated;
                $payload['passport_file'] = $path;
                
                // hardcoded
                $payload['status'] = 'paid';

                $booking = Booking::create($payload);

                $payload['booking_code'] = $booking->booking_code;
                
                $paymentParams = $this->buildPaymentParams($payload);
                $payment = $this->paymentProcess($paymentParams);
                return redirect($payment);
            });

        } catch (\Throwable $th) {
            \Log::error('Booking creation failed', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'data'  => $validated,
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan booking. Silakan coba lagi.');   
        }
    }

    function splitFullName(string $fullName): array
    {
        $parts = preg_split('/\s+/', trim($fullName));

        if (count($parts) === 1) {
            return [
                'first_name' => $parts[0],
                'last_name'  => $parts[0],
            ];
        }

        return [
            'first_name' => array_shift($parts),
            'last_name'  => implode(' ', $parts),
        ];
    }

    private function buildPaymentParams($params)
    {
        $splitFullName = $this->splitFullName($params['full_name']);

        return [
            'transaction_details' => [
                'order_id' => $params['booking_code'],
                'gross_amount' => $params['product_price']
            ],
            'item_details' => [
                [
                    'id' => $params['product_id'],
                    'price' => $params['product_price'],
                    'quantity' => 1,
                    'name' => $params['product_name']
                ]
            ],
            'customer_details' => [
                'first_name' => $splitFullName['first_name'],
                'last_name' => $splitFullName['last_name'],
                'email' => $params['email'],
                'phone' => $params['phone']
            ],
            'enabled_payments' => [
                'bank_transfer'
            ]
        ];
    }

    private function paymentProcess($params)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction =  env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        return \Midtrans\Snap::createTransaction($params)->redirect_url;
    }
}
