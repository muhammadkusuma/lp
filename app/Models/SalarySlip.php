<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SalarySlip extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'employee_id',
        'slip_number',
        'period_month',
        'period_year',
        'salary',
        'bonus',
        'deduction',
        'net_salary',
        'status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'salary' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Convert number to Indonesian words (Terbilang)
     */
    public static function terbilang($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = self::terbilang($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = self::terbilang($nilai/10)." puluh". self::terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::terbilang($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::terbilang($nilai/100) . " ratus" . self::terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . self::terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::terbilang($nilai/1000) . " ribu" . self::terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::terbilang($nilai/1000000) . " juta" . self::terbilang($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::terbilang($nilai/1000000000) . " milyar" . self::terbilang(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::terbilang($nilai/1000000000000) . " trilyun" . self::terbilang(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
}
