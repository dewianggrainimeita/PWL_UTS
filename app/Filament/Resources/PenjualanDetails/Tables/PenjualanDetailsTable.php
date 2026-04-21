<?php

namespace App\Filament\Resources\PenjualanDetails\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenjualanDetailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan.penjualan_id')
                    ->searchable(),
                TextColumn::make('barang.barang_id')
                    ->searchable(),
                TextColumn::make('barang.barang_nama')
                ->label('Nama Barang')
                ->sortable()
                ->searchable(),
                TextColumn::make('harga')
                ->label('Harga')
                ->numeric(0, ',', '.')
                ->prefix('Rp ')        
                ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subtotal')
                ->label('Subtotal')
                ->state(function ($record) {
                return $record->harga * $record->jumlah;
                })
                ->numeric(0, ',', '.')
                ->prefix('Rp ')
                ->color('success')
                ->weight('bold'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
