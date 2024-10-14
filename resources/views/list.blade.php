<div class="container">
    <h1 class="mb-4">Lista de Transações por Loja</h1>

    @foreach ($saldoPorLoja as $nomeLoja => $loja)
        <div class="card mb-4">
            <div class="card-header">
                <h3>{{ $nomeLoja }}</h3>
                <p><strong>Dono da Loja:</strong> {{ $loja['dono_loja'] }}</p>
                <p><strong>Saldo Total:</strong> R$ {{ number_format($loja['saldo'], 2, ',', '.') }}</p>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>CPF</th>
                            <th>Cartão</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loja['transacoes'] as $transacao)
                            <tr>
                                <td>{{ $transacao->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($transacao->data)->format('d/m/Y') }}</td>
                                <td>R$ {{ number_format($transacao->valor, 2, ',', '.') }}</td>
                                <td>{{ $transacao->cpf }}</td>
                                <td>{{ $transacao->cartao }}</td>
                                <td>{{ $transacao->hora }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>