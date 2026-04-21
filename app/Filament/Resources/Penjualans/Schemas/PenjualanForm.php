<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Kasir / petugas')
                    ->relationship('user', 'name')
                    ->default(fn () => auth()->id())
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('pembeli')
                    ->label('Nama pembeli')
                    ->required()
                    ->maxLength(50),
                TextInput::make('penjualan_kode')
                    ->label('Kode transaksi')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true)
                    ->default(fn () => 'PJ-'.Str::upper(Str::random(8))),
                DateTimePicker::make('penjualan_tanggal')
                    ->label('Tanggal penjualan')
                    ->default(now())
                    ->required(),
            ]);
    }
}
