<div>
    <h2>Detalhes da Cotação</h2>
    <p><strong>Data da Cotação:</strong> {{ $cotacao->data_cotacao }}</p>
    <p><strong>Status:</strong> {{ $cotacao->status }}</p>
    <p><strong>Usuário:</strong> {{ $cotacao->user->name }}</p>
    <p><strong>Condomínio:</strong> {{ $cotacao->condominio->nome }}</p>
</div>
