<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa - Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff9e6; /* Amarelo suave */
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            font-weight: bold;
        }
        .list-group-item {
            border: none;
            padding: 15px;
            background-color: #fff;
            transition: all 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card da Empresa -->
                <div class="card mb-4">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="mb-0">{{ $empresa->nome_fantasia }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <p><i class="bi bi-telephone"></i> <strong>Contato:</strong> {{ $empresa->telefone ?? 'Não informado' }}</p>
                        <p><i class="bi bi-envelope"></i> <strong>E-mail:</strong> {{ $empresa->email ?? 'Não informado' }}</p>
                        <p><i class="bi bi-geo-alt"></i> <strong>Endereço:</strong> {{ $empresa->endereco ?? 'Não informado' }}</p>
                        <p><strong>Bairro:</strong> {{ $empresa->bairro ?? 'Não informado' }}</p>
                        <p><strong>Cidade:</strong> {{ $empresa->cidade ?? 'Não informado' }}</p>
                    </div>
                </div>

                <!-- Card de Serviços Prestados -->
                <div class="card">
                    <div class="card-header text-center bg-warning text-dark">
                        <h4 class="mb-0">Serviços Prestados</h4>
                    </div>
                    <div class="card-body">
                        @if($servicos->isNotEmpty())
                            <div class="list-group">
                                @foreach($servicos as $servico)
                                    <div class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row">
                                        <div>
                                            <h5 class="mb-1 text-primary">{{ $servico->nome }}</h5>
                                            <p class="mb-0 text-muted"><strong>Descrição:</strong> {{ $servico->descricao ?? 'Não informado' }}</p>
                                        </div>
                                        <span class="badge bg-success fs-6">R$ {{ number_format($servico->custo, 2, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center">Nenhum serviço disponível.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
</body>
</html>
