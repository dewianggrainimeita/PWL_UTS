<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'kategori_nama')
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('barang_kode')
                    ->label('Kode barang')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),
                TextInput::make('barang_nama')
                    ->label('Nama barang')
                    ->required()
                    ->maxLength(100),
                TextInput::make('harga_beli')
                    ->label('Harga beli')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(0),
                TextInput::make('harga_jual')
                    ->label('Harga jual')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(0),
            ]);
    }
}
