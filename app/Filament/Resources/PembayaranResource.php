<?php

namespace App\Filament\Resources;

use App\Filament\Exports\PembayaranExporter;
use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use Auth;
use Carbon\Carbon;
use Faker\Provider\Image;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use Schema;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;
protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $slug = 'pembayaran';
    protected static ?string $pluralModelLabel = "Pembayaran";
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where("user_id",Auth::id());
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('siswa_id')->label('Nama Siswa')->options(Auth::user()->Siswa->pluck('nama','id'))->searchable()->required(),
                Select::make('kelas_id')->label('Kategori SPP')->options(Auth::user()->Kelas()->pluck('nama','id'))->searchable()->required(),
                Select::make('dibayar')->options([
                    'Belum dibayar' => 'Belum dibayar',
                    'Tidak ditanggungkan' => 'Tidak ditanggungkan',
                    'Beasiswa' => 'Beasiswa',
                    'Lunas' => 'Lunas',
                ])->required(),
                FileUpload::make('image'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nis')->searchable()->sortable()->label('Nomor Induk Siswa'),
                TextColumn::make("nama_siswa")->label("Nama Siswa")->searchable()->sortable(),
                TextColumn::make("nama_kategori")->label("Kategori"),
                TextColumn::make("harga")->label("Harga")->formatStateUsing(fn($state) => "Rp.". number_format($state,0,".",".") .""),
                TextColumn::make("dibayar")->label("Status Pembayaran"),
                TextColumn::make("created_at")->label("Tanggal")->formatStateUsing(fn($state) => $state->format('d M Y')),
                ImageColumn::make('image')->label('Bukti')
            ])
            ->filters([
                SelectFilter::make('nama_kategori')->label('Kategori')->options(Auth::user()->Kelas->pluck('nama','nama')),
                SelectFilter::make('dibayar')->label('Status Pembayaran')->options(Auth::user()->Pembayaran->pluck('dibayar','dibayar')),
                SelectFilter::make('kelas')->options(Auth::user()->Siswa->pluck('kelas','kelas')),
                SelectFilter::make('nama_siswa')->options(Auth::user()->Siswa->pluck('nama','nama'))->searchable(),
                
            ])
            ->headerActions([
                \Filament\Tables\Actions\ExportAction::make()->exporter(PembayaranExporter::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\ExportBulkAction::make()->exporter(PembayaranExporter::class)
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
