<?php

namespace Tests\Unit;

use App\Services\CnabParser;
use Tests\TestCase;

class CnabParserTest extends TestCase
{
    public function test_parse_cnab_content()
    {
        $cnabContent = "3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO\n";
        
        \Illuminate\Support\Facades\Storage::fake('local');
        \Illuminate\Support\Facades\Storage::put('test_cnab.txt', $cnabContent);

        $parser = new CnabParser();
        $parsedData = $parser->parse('test_cnab.txt');

        $expectedData = [
            [
                'tipo' => '3',
                'data' => '20190301',
                'valor' => '142.00',
                'cpf' => '09620676017',
                'cartao' => '4753****3153',
                'hora' => '153453',
                'dono_loja' => 'JOÃO MACEDO',
                'nome_loja' => 'BAR DO JOÃO',
            ]
        ];

        $this->assertEquals($expectedData, $parsedData);
    }
}
