<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Http;

class SquareRootController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->get();
        $result = null; // Initialize $result
        $executionTime = null; // Initialize $executionTime

        // Pass the variables to the view
        return view('index', compact('history', 'result', 'executionTime'));
    }

    public function calculate(Request $request)
    {
        $inputNumber = $request->input('number');
        $method = $request->input('method');
        $maxLength = 6;
        $startTime = microtime(true);
        $result = null; // Inisialisasi $result
        $executionTime = null; // Inisialisasi $executionTime

        // Replace comma with dot to handle decimal input
        $inputNumber = str_replace(',', '.', $inputNumber);

        // Validasi input
        if (!is_numeric($inputNumber) || $inputNumber < 0) {
            return redirect()->route('square_root.index')->with('error', 'Input harus berupa bilangan positif yang lebih besar dari 0.');
        }

        // Validasi panjang input
        if (strlen($inputNumber) > $maxLength) {
            return redirect()->back()->with('error', 'Panjang input terlalu panjang. Harap masukkan input yang lebih pendek.');
        }

        if ($method === 'API Service') {
            $response = Http::get("https://api.mathjs.org/v4/?expr=sqrt($inputNumber)");
            $result = $response->body();
        } elseif ($method === 'PL/SQL') {
            $result = History::calculateSquareRoot($inputNumber);
        }

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);

        $history = new History([
            'input_number' => $inputNumber,
            'square_root' => $result,
            'method' => $method,
            'execution_time' => $executionTime,
        ]);

        $history->save();

        return redirect()->route('square_root.index', ['result' => $result, 'executionTime' => $executionTime])->with('result', $result)->with('success', 'Perhitungan berhasil disimpan.');
    }
}
