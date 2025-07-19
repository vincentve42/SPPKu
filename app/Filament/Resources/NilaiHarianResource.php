<?php

namespace App\Filament\Resources;

use App\Filament\Exports\NilaiHarianExporter;
use App\Filament\Imports\NilaiHarianImporter;
use App\Filament\Resources\NilaiHarianResource\Pages;
use App\Filament\Resources\NilaiHarianResource\RelationManagers;
use App\Models\NilaiHarian;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NilaiHarianResource extends Resource
{
    protected static ?string $model = NilaiHarian::class;

    protected static ?string $slug = "nilai-harian";

    protected static ?string $pluralModelLabel = "Nilai Harian";

    protected static ?string $navigationGroup = "Nilai Siswa";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()->where('user_id',Auth::id());
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Select::make('siswa_id')->label('Nama Siswa')->options(Auth::user()->Siswa->pluck('nama','id'))->searchable()->required(),
                    Select::make('mata_id')->label('Mata Pelajaran')->options(Auth::user()->MataPelajaran->pluck('nama','id'))->searchable()->required(),
                    TextInput::make('nilai')->label('Nilai Siswa')->required()->integer()->required()
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->label('Nomor Induk Siswa')->searchable(),
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable(),
                TextColumn::make('kelas_siswa')->label('Kelas Siswa')->searchable(),
                TextColumn::make('absen_siswa')->label('Absen Siswa')->searchable(),
                TextColumn::make('mata_pelajaran')->label('Mata Pelajaran')->searchable(),
                TextColumn::make('nilai')->label('Nilai')
            ])
            ->filters([
                SelectFilter::make('nama_siswa')->options(Auth::user()->Siswa->pluck('nama','nama'))->searchable(),
                SelectFilter::make('kelas')->options(Auth::user()->Siswa->pluck('kelas','kelas')),
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
             ->headerActions([
                \Filament\Tables\Actions\ExportAction::make()->exporter(NilaiHarianExporter::class),
                \Filament\Tables\Actions\ImportAction::make()->importer(NilaiHarianImporter::class),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                ]),
                Tables\Actions\ExportBulkAction::make()->exporter(NilaiHarianExporter::class)
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
            'index' => Pages\ListNilaiHarians::route('/'),
            'create' => Pages\CreateNilaiHarian::route('/create'),
            'edit' => Pages\EditNilaiHarian::route('/{record}/edit'),
        ];
    }
}
