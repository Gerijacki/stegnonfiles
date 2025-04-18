<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UploadResource\Pages;
use App\Models\Upload;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class UploadResource extends Resource
{
    protected static ?string $model = Upload::class;

    protected static ?string $navigationIcon = 'heroicon-m-document-arrow-up';
    protected static ?string $navigationLabel = 'Archivos subidos';
    protected static ?string $navigationGroup = 'Gestión de archivos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('original_filename')
                ->label('Nombre original')
                ->disabled(),
            Forms\Components\TextInput::make('mime_type')
                ->label('Tipo de archivo')
                ->disabled(),
            Forms\Components\TextInput::make('uuid')
                ->label('UUID')
                ->disabled(),
            Forms\Components\TextInput::make('path')
                ->label('Ruta del archivo')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('original_filename')->label('Nombre original'),
                Tables\Columns\TextColumn::make('mime_type')->label('Tipo de archivo'),
                Tables\Columns\TextColumn::make('uuid')->label('UUID'),
                Tables\Columns\TextColumn::make('path')->label('Ruta'),
                Tables\Columns\TextColumn::make('created_at')->label('Creado en')->dateTime(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar archivo')
                    ->action(fn (Upload $record) => $record->forceDelete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('delete')
                    ->label('Eliminar seleccionados')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->forceDelete();
                        }
                    })
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUploads::route('/'),
            'create' => Pages\CreateUpload::route('/create'),
            'edit' => Pages\EditUpload::route('/{record}/edit'),
        ];
    }
}
