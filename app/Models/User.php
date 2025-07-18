<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function Siswa() : HasMany
    {
        return $this->hasMany(Siswa::class);
    }
    public function Kelas() : HasMany
    {
        return $this->hasMany(Kelas::class);
    }
    public function Pembayaran() : HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
    public function Pengeluaran() : HasMany
    {
        return $this->hasMany(Pengeluaran::class);
    }
    public static function HitungSemuaPendapatans($user)
    {
        $target = User::find($user);
        $data_keuangan = $target->Pembayaran->where('dibayar','Lunas');
        $total = 0;
        foreach($data_keuangan as $data_single)
        {
            $total += $data_single->harga;
        }
        return "Rp." . number_format($total,0,',','.');
    }
    public static function HitungSemuaPengeluaran($user)
    {
        $target = User::find($user);
        $data_keuangan = $target->Pengeluaran;
        $total = 0;
        foreach($data_keuangan as $data_single)
        {
            $total += $data_single->harga;
        }
        return "Rp." . number_format($total,0,',','.');
    }
    public function MataPelajaran() : HasMany
    {
        return $this->hasMany(Nilai::class);
    }
    public function NilaiHarian() : HasMany
    {
        return $this->hasMany(NilaiHarian::class);
    }
    public function NilaiSemester() : HasMany
    {
        return $this->hasMany(NilaiSemester::class);
    }
    
}
