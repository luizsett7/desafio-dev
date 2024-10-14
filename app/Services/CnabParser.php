<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CnabParser
{
    public function parse($filePath)
    {
        $file = Storage::get($filePath);
        $lines = explode(PHP_EOL, $file);
        $parsedData = [];

        foreach ($lines as $line) {
            if (!empty($line)) {
                $parsedData[] = [
                    'tipo' => substr($line, 0, 1),
                    'data' => substr($line, 1, 8),
                    'valor' => number_format(substr($line, 9, 10) / 100, 2, '.', ''),
                    'cpf' => substr($line, 19, 11),
                    'cartao' => substr($line, 30, 12),
                    'hora' => substr($line, 42, 6),
                    'dono_loja' => trim(substr($line, 48, 14)),
                    'nome_loja' => trim(substr($line, 62, 19)),
                ];
            }
        }

        return $parsedData;
    }
}
