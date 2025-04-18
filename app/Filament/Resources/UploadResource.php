<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UploadResource\Pages;
use App\Models\Upload;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\Storage;

class UploadResource extends Resource
{
    protected static ?string $model = Upload::class;

    protected static ?string $navigationIcon = '';

    protected static ?string $navigationLabel = 'Archivos subidos';

    protected static ?string $navigationGroup = 'Gestión de archivos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->filters([])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->action(function (Upload $record) {
                        if (Storage::exists($record->path)) {
                            Storage::delete($record->path);
                        }

                        $record->delete();
                    })
                    ->label('Eliminar archivo')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
