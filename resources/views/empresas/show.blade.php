<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - Serviços</title>
    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Card da Empresa -->
        <div class="card mb-4">
            <div class="card-header text-center bg-primary text-white">
                <h3>{{ $empresa->nome_fantasia }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Contato:</strong> {{ $empresa->telefone ?? 'Não informado' }}</p>
                <p><strong>E-mail:</strong> {{ $empresa->email ?? 'Não informado' }}</p>
                <p><strong>Endereço:</strong> {{ $empresa->endereco ?? 'Não informado' }}</p>
                <p><strong>Bairro:</strong> {{ $empresa->bairro ?? 'Não informado' }}</p>
                <p><strong>Cidade:</strong> {{ $empresa->cidade ?? 'Não informado' }}</p>
            </div>
        </div>

        <!-- Card de Serviços Prestados -->
        <div class="card">
            <div class="card-header text-center bg-warning">
                <h4 class="text-dark">Serviços Prestados</h4>
            </div>
            <div class="card-body">
                @if($servicos->isNotEmpty())
                    <div class="list-group">
                        @foreach($servicos as $servico)
                            <div class="list-group-item">
                                <h5 class="mb-1">{{ $servico->nome }}</h5>
                                <p><strong>Custo:</strong> R$ {{ number_format($servico->custo, 2, ',', '.') }}</p>
                                <p><strong>Descrição:</strong> {{ $servico->descricao ?? 'Não informado' }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Nenhum serviço disponível.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opcional, para funcionalidades como dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
