<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratPeringatanResource\Pages;
use App\Filament\Resources\SuratPeringatanResource\RelationManagers;
use App\Models\SuratPeringatan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SuratPeringatanResource extends Resource
{
    protected static ?string $model = SuratPeringatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $slug = 'Surat Peringatan';

    protected static ?string $pluralModelLabel = 'Surat Peringatan';

    protected static ?string $navigationGroup = 'Kesiswaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('keterangan')->label('Keterangan Surat'),
                Select::make('siswa_id')->options(Auth::user()->Siswa->pluck('nama','id'))->searchable()->label('Nama Siswa'),
                FileUpload::make('image')->label('Foto Kejadian / Surat')->directory('surat-peringatan'),
            ]);
    }
    public function getEquolentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id',Auth::id());
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->label('Nomor Induk Siswa')->searchable()->sortable(),
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable()->sortable(),
                TextColumn::make('keterangan')->label('Alasan')->searchable()->sortable(),
                TextColumn::make('surat')->label('Surat ke berapa')->sortable(),
                ImageColumn::make('image')->label('Bukti Fisik')->sortable(),
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
            'index' => Pages\ListSuratPeringatans::route('/'),
            'create' => Pages\CreateSuratPeringatan::route('/create'),
            'edit' => Pages\EditSuratPeringatan::route('/{record}/edit'),
        ];
    }
}
