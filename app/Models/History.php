<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    protected $fillable = ['input_number', 'square_root', 'method', 'execution_time'];

    public static function calculateSquareRoot($inputNumber)
    {
        // Menjalankan stored procedure CalculateSquareRoot
        $result = DB::select('CALL CalculateSquareRoot(?, @squareRoot)', [$inputNumber]);

        // Mengambil hasil dari variabel user-defined @squareRoot
        $squareRoot = DB::select('SELECT @squareRoot as squareRoot')[0]->squareRoot;

        return $squareRoot;
    }
}
