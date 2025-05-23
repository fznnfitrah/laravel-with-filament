<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveTypesResource\Pages;
use App\Filament\Resources\LeaveTypesResource\RelationManagers;
use App\Models\LeaveTypes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveTypesResource extends Resource
{
    protected static ?string $model = LeaveTypes::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Jenis Cuti';
    protected static ?string $breadcrumb = 'Jenis Cuti';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Jenis Cuti')
                    ->placeholder('Nama Jenis Cuti')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_days')
                    ->label('Jumlah Cuti')
                    ->placeholder('Masukkan Berapa Hari Cuti')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_days')
                    ->numeric()
                    ->label('Jumlah Cuti')
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListLeaveTypes::route('/'),
            'create' => Pages\CreateLeaveTypes::route('/create'),
            'edit' => Pages\EditLeaveTypes::route('/{record}/edit'),
        ];
    }
}
