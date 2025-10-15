<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hidehalo\Nanoid\Client;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        
        'product_id',
        'product_name',
        'product_price',

        'schedule_id',
        'schedule_date',
        'schedule_place',
        
        'status',
        'full_name',
        'nik',
        'passport_number',
        'passport_file',
        'dob',
        'gender',
        'phone',
        'email',
        'vaccine_certificate_file',
        'is_vaccinated'
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    /** Relationships **/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /** Accessors (optional, buat tampilan) **/
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'  => 'Menunggu Pembayaran',
            'paid'     => 'Sudah Dibayar',
            'done'     => 'Selesai',
            'cancelled'=> 'Dibatalkan',
            default    => ucfirst($this->status),
        };
    }

    protected static function booted(): void
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $client = new Client();
                $nanoid = $client->generateId(8);
                $booking->booking_code = strtoupper($nanoid);
            }
        });
    }
}
