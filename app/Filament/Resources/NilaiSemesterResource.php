<?php

namespace App\Filament\Resources;

use App\Filament\Exports\NilaiHarianExporter;
use App\Filament\Exports\NilaiSemesterExporter;
use App\Filament\Resources\NilaiSemesterResource\Pages;
use App\Filament\Resources\NilaiSemesterResource\RelationManagers;
use App\Models\NilaiSemester;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NilaiSemesterResource extends Resource
{
    protected static ?string $model = NilaiSemester::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $slug = 'nilai-semester';

    protected static ?string $pluralModelLabel = 'Nilai Semester';

    protected static ?string $navigationGroup = 'Nilai Siswa';


    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()->where('user_id',Auth::id());
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->label('Nomor Induk Siswa'),
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable(),
                TextColumn::make('kelas_siswa')->label('Kelas Siswa')->searchable(),
                TextColumn::make('absen_siswa')->label('Absen Siswa')->searchable(),
                TextColumn::make('mata_pelajaran')->label('Mata Pelajaran'),
                TextColumn::make('nilai')->label('nilai')->formatStateUsing(fn( $state) => number_format($state,2)),
            ])
            ->filters([
                //
            ])
            ->actions([
                
            ])
            ->headerActions([
                \Filament\Tables\Actions\ExportAction::make()->exporter(NilaiSemesterExporter::class),
                \Filament\Tables\Actions\ImportAction::make()->importer(NilaiHarianExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\ExportBulkAction::make()->exporter(NilaiSemesterExporter::class)
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
            'index' => Pages\ListNilaiSemesters::route('/'),
            'create' => Pages\CreateNilaiSemester::route('/create'),
            'edit' => Pages\EditNilaiSemester::route('/{record}/edit'),
        ];
    }
}
