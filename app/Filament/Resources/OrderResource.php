<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Delivery Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\Select::make('integration_id')
//                    ->relationship('integration', 'name')
//                    ->label('Integration')
//                    ->required(),
                Forms\Components\TextInput::make('external_order_id')
                    ->label('External Order ID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_name')
                    ->label('Customer Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_email')
                    ->label('Customer Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\DateTimePicker::make('placed_at')
                    ->label('Placed At')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('integration.name')
//                    ->label('Integration')
//                    ->sortable()
//                    ->searchable(),
                Tables\Columns\TextColumn::make('external_order_id')
                    ->label('External Order ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_email')
                    ->label('Customer Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('placed_at')
                    ->label('Placed At')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
