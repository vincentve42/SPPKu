<?php

namespace App\Filament\Resources;

use App\Filament\Exports\NilaiExporter;
use App\Filament\Resources\NilaiResource\Pages;
use App\Filament\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $slug = 'mata-pelajaran';

    protected static ?string $title = 'Mata Pelajaran';

    protected static ?string $navigationGroup = 'Nilai Siswa';

    protected static ?string $pluralModelLabel = 'Mata Pelajaran';

    protected static ?string $singularLabel = 'Mapel';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required()
            ]);
    }
    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()->where('user_id',Auth::id());
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\ExportBulkAction::make()->exporter(NilaiExporter::class)
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
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }
}
