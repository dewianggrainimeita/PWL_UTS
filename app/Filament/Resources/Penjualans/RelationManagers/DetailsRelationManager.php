<?php

namespace App\Filament\Resources\Penjualans\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    protected static bool $shouldCheckPolicyExistence = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('barang_id')
                    ->label('Barang')
                    ->relationship('barang', 'barang_nama')
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('harga')
                    ->label('Harga satuan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(0),
                TextInput::make('jumlah')
                    ->label('Qty')
                    ->numeric()
                    ->integer()
                    ->required()
                    ->minValue(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barang.barang_kode')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('barang.barang_nama')
                    ->label('Barang')
                    ->searchable(),
                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR'),
                TextColumn::make('jumlah')
                    ->label('Qty')
                    ->numeric(),
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->getStateUsing(fn ($record): int => (int) $record->harga * (int) $record->jumlah),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
