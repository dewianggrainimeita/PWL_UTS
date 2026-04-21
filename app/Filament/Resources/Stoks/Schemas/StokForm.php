<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplier_id')
                    ->label('Supplier')
                    ->relationship('supplier', 'supplier_nama')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('barang_id')
                    ->label('Barang')
                    ->relationship('barang', 'barang_nama')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->label('Petugas')
                    ->relationship('user', 'name')
                    ->default(fn () => auth()->id())
                    ->preload()
                    ->searchable()
                    ->required(),
                DateTimePicker::make('stok_tanggal')
                    ->label('Tanggal')
                    ->default(now())
                    ->required(),
                TextInput::make('stok_jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->integer()
                    ->required(),
            ]);
    }
}
