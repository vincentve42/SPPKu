<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Kelas;
use App\Models\Siswa;
use Doctrine\DBAL\Schema\Column;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SiswaResource extends Resource
{
    protected static ?string $slug = 'Siswa';
protected static ?string $pluralModelLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Siswa';
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationLabel = 'Siswa';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('kelas'),
                TextInput::make('absen'),
                TextInput::make('nis')->label('Nomor Induk Siswa'),
                Select::make('kelas_id')->label("Kategori")->options(Auth::user()->Kelas()->pluck('nama','id'))->searchable(),
                
                
                
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->searchable()->sortable()->label('Nomor Induk Siswa'),
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('kelas')->searchable(),
                TextColumn::make('absen')->searchable(),
                TextColumn::make('kategori')->label('Kategori')->searchable(true),
                TextColumn::make('harga')->label('Harga')->formatStateUsing(fn($state) => "Rp.". number_format($state,0,".",".") .""),
            ])
            ->filters([
               SelectFilter::make('kategori')->options(Auth::user()->Kelas()->pluck('nama','nama')),
               SelectFilter::make('kelas')->options(Auth::user()->Siswa->pluck('kelas','kelas')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
