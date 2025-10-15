<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('booking_code'),
                IconEntry::make('is_vaccinated')->boolean(),
                TextEntry::make('vaccine_certificate_file')
                    ->label('Vaccine Certificate')
                    ->formatStateUsing(fn ($state) => $state ? '📄 vaccine_certificate_file' : '-')
                    ->url(fn ($record) => $record->vaccine_certificate_file 
                        ? asset('storage/' . $record->vaccine_certificate_file)
                        : null)
                    ->openUrlInNewTab(),
                TextEntry::make('product_name'),
                TextEntry::make('product_price')->numeric(),
                TextEntry::make('schedule_date'),
                TextEntry::make('schedule_place'),
                TextEntry::make('status')->badge(),
                TextEntry::make('full_name'),
                TextEntry::make('nik'),
                TextEntry::make('passport_number'),
                TextEntry::make('passport_file')
                    ->label('Passport File')
                    ->formatStateUsing(fn ($state) => $state ? '📄 passport_file' : '-')
                    ->url(fn ($record) => $record->passport_file 
                        ? asset('storage/' . $record->passport_file)
                        : null)
                    ->openUrlInNewTab(),
                TextEntry::make('dob')->date(),
                TextEntry::make('gender')->badge(),
                TextEntry::make('phone'),
                TextEntry::make('email')->label('Email address'),
                TextEntry::make('created_at')->dateTime()->placeholder('-'),
                TextEntry::make('updated_at')->dateTime()->placeholder('-'),
            ]);
    }
}
