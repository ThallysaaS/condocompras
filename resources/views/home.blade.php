<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CondoCompras - Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #2b6cb0;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
        header img {
            max-width: 150px;
        }
        .banner {
            position: relative;
            height: 300px;
            background: url('https://via.placeholder.com/1200x300') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .banner h1 {
            font-size: 3rem;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .features {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        .feature {
            flex: 1;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .feature img {
            max-width: 100px;
            margin-bottom: 15px;
        }
        .feature h3 {
            color: #2b6cb0;
        }
        .cta {
            text-align: center;
            margin-top: 40px;
        }
        .cta a {
            padding: 15px 30px;
            font-size: 1rem;
            color: #fff;
            background-color: #2b6cb0;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .cta a:hover {
            background-color: #2c5282;
        }
        .cta .secondary {
            margin-top: 10px;
            display: inline-block;
            padding: 10px 20px;
            font-size: 0.9rem;
            color: #2b6cb0;
            background-color: #fff;
            border: 2px solid #2b6cb0;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        .cta .secondary:hover {
            background-color: #2b6cb0;
            color: #fff;
        }
        footer {
            margin-top: 50px;
            padding: 20px;
            background-color: #2b6cb0;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('imgs/logo-sem-fundo.png') }}" alt="CondoCompras Logo" />
        <h2>Bem-vindo ao CondoCompras</h2>
    </header>

    <div class="banner">
        <h1>Simplifique as Cotações do Seu Condomínio</h1>
    </div>

    <div class="container">
        <section class="features">
            <div class="feature">
                <img src="https://via.placeholder.com/100" alt="Conexão">
                <h3>Conexão</h3>
                <p>Conecte síndicos a empresas e prestadores de serviços confiáveis.</p>
            </div>
            <div class="feature">
                <img src="https://via.placeholder.com/100" alt="Economia">
                <h3>Economia</h3>
                <p>Garanta os melhores preços para seu condomínio com cotações personalizadas.</p>
            </div>
            <div class="feature">
                <img src="https://via.placeholder.com/100" alt="Facilidade">
                <h3>Facilidade</h3>
                <p>Uma plataforma intuitiva para gerenciar todas as suas cotações.</p>
            </div>
        </section>

        <section class="cta">
            <h2>Cadastre-se Agora!</h2>
            <p>Experimente o CondoCompras e veja como é fácil cotar produtos e serviços.</p>
            <a href="{{ route('cadastro') }}">Cadastre-se</a>
            <h4>Já possui cadastro?</h4>
            <a href="/admin" class="secondary">Faça Login</a>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 CondoCompras. Todos os direitos reservados.</p>
    </footer>
</body>
</html>