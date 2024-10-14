<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CnabTransaction;

class CnabController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-cnab');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt',
        ]);

        $filePath = $request->file('file')->store('cnab_files');

        return $this->parse($filePath);
    }

    public function parse($filePath)
    {
        $file = Storage::get($filePath);
        $lines = explode(PHP_EOL, $file);
        $parsedData = [];
        $lojas = [];

        $tipoTransacao = [
            '1' => ['natureza' => 'entrada', 'sinal' => 1],
            '2' => ['natureza' => 'saída', 'sinal' => -1],
            '3' => ['natureza' => 'saída', 'sinal' => -1],
            '4' => ['natureza' => 'entrada', 'sinal' => 1],
            '5' => ['natureza' => 'entrada', 'sinal' => 1],
            '6' => ['natureza' => 'entrada', 'sinal' => 1],
            '7' => ['natureza' => 'entrada', 'sinal' => 1],
            '8' => ['natureza' => 'entrada', 'sinal' => 1],
            '9' => ['natureza' => 'saída', 'sinal' => -1],
        ];

        foreach ($lines as $line) {        

            if (!empty($line)) {
                $tipo = substr($line, 0, 1);
                $valor = number_format(substr($line, 9, 10) / 100, 2, '.', '');
                $hora = substr($line, 42, 6);
                $donoLoja = trim(substr($line, 48, 14));
                $nomeLoja = trim(substr($line, 62, 19));                
                                
                $hora_formatada = str_pad(substr($hora,0,2),2,'0');
                $minuto_formatado = str_pad(substr($hora,2,2),2,'0');
                $segundo_formatado = str_pad(substr($hora,4,2),2,'0');
                $horaFormatada = $hora_formatada . ':' . $minuto_formatado . ':' . $segundo_formatado;

                $sinal = $tipoTransacao[$tipo]['sinal'];
                $valorFinal = $sinal * $valor;

                if (!isset($lojas[$nomeLoja])) {
                    $lojas[$nomeLoja] = [
                        'dono_loja' => $donoLoja,
                        'nome_loja' => $nomeLoja,
                        'transacoes' => [],
                        'saldo' => 0,
                    ];
                }

                $lojas[$nomeLoja]['transacoes'][] = [
                    'tipo' => $tipo,
                    'data' => substr($line, 1, 8),
                    'valor' => $valor,
                    'cpf' => substr($line, 19, 11),
                    'cartao' => substr($line, 30, 12),
                    'hora' => $horaFormatada,
                    'dono_loja' => $donoLoja,
                    'nome_loja' => $nomeLoja,
                    'sinal' => $sinal,
                    'valor_final' => $valorFinal,
                ];

                $lojas[$nomeLoja]['saldo'] += $valorFinal;
               
                CnabTransaction::create([
                    'tipo' => $tipo,
                    'data' => substr($line, 1, 8),
                    'valor' => $valorFinal,
                    'cpf' => substr($line, 19, 11),
                    'cartao' => substr($line, 30, 12),
                    'hora' => $horaFormatada,
                    'dono_loja' => $donoLoja,
                    'nome_loja' => $nomeLoja,
                ]);
            }
        }

        return $this->list();
    }

    public function listTransactions()
    {
        $transactions = CnabTransaction::all();
        return response()->json($transactions);
    }

    public function list()
    {
        $lojas = CnabTransaction::select('nome_loja', 'dono_loja', 'tipo', 'data', 'valor', 'cpf', 'cartao', 'hora')
                    ->get()
                    ->groupBy('nome_loja');

        $saldoPorLoja = [];

        foreach ($lojas as $nomeLoja => $transacoes) {
            $saldo = $transacoes->sum('valor');
            $saldoPorLoja[$nomeLoja] = [
                'dono_loja' => $transacoes->first()->dono_loja,
                'transacoes' => $transacoes,
                'saldo' => $saldo,
            ];
        }

        return view('list', compact('saldoPorLoja'));
    }
}