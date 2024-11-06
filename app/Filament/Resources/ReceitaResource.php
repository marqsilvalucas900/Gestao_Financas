<?php

namespace App\Filament\Resources;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\ReceitaResource\Pages;
use App\Filament\Resources\ReceitaResource\RelationManagers;
use App\Models\Receita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReceitaResource extends Resource
{
    protected static ?string $model = Receita::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Receitas';

    protected static ?string $modelLabel = 'Receitas Cadastradas';

    


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descricao')
                    ->required(),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->prefix('R$')
                    ->default('0.00')
                    ->numeric(),
                Forms\Components\DatePicker::make('data_recebimento')
                    ->required(),
                Forms\Components\TextInput::make('metodo_pagamento')
                    ->required(),
                Forms\Components\TextInput::make('fatura_numero'),

                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'id')
                    ->required()->createOptionForm([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telefone')
                            ->label('Phone number')
                            ->tel()
                            ->required(),
                    ])
                    ->required(),

                Forms\Components\Select::make('status_pagamento')
                    ->options([
                        'concluido' => 'concluido',
                        'pendente' => 'pendente',
                        'atrasado' => 'atrasado',
                    ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descricao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_recebimento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('metodo_pagamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fatura_numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pagamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListReceitas::route('/'),
            'create' => Pages\CreateReceita::route('/create'),
            'view' => Pages\ViewReceita::route('/{record}'),
            'edit' => Pages\EditReceita::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
