<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PertemuanResource\Pages;
use App\Filament\Resources\PertemuanResource\RelationManagers;
use App\Models\Pertemuan;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PertemuanResource extends Resource
{
    protected static ?string $model = Pertemuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Kesiswaan';

    protected static ?string $title = 'Pertemuan';

    protected static ?string $pluralModelLabel = 'Jadwal Pertemuan';

    protected static ?string $navigationLabel = 'Pertemuan';

    protected static ?string $slug = "pertemuan";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Select::make("siswa_id")->options(Auth::user()->Siswa->pluck('nama','id'))->searchable()->label('Nama Siswa'),
                TextInput::make("keterangan")->required()->label("Keterangan Pertemuan"),
                FileUpload::make("image")->required()->label("Test")->directory("pertemuan"),
              
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
                TextColumn::make('nis')->searchable()->sortable()->label('Nomor Induk Siswa'),
                TextColumn::make('nama_siswa')->label("Nama Siswa")->sortable()->searchable(),
                TextColumn::make("kelas_siswa")->label("Kelas"),
                TextColumn::make("keterangan")->label("Keterangan")->searchable(),
                ImageColumn::make("image")->label("Bukti Pertemuan"),
                CheckboxColumn::make('done')->label('Pertemuan Selesai')
            ])
            ->filters([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPertemuans::route('/'),
            'create' => Pages\CreatePertemuan::route('/create'),
            'edit' => Pages\EditPertemuan::route('/{record}/edit'),
        ];
    }
}
