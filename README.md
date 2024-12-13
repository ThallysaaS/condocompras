# CONDOCOMPRAS

O CondoCompras é uma plataforma projetada para facilitar a comunicação entre síndicos, prestadores de serviços e fornecedores de produtos. A solução permite realizar cotações de serviços e produtos necessários para condomínios, promovendo agilidade e organização no processo.

Empresas e prestadores de serviços têm a oportunidade de oferecer suas soluções diretamente pela plataforma, ampliando sua visibilidade e alcançando novos clientes. O CondoCompras centraliza e simplifica as negociações, tornando o gerenciamento de cotações mais eficiente para todos os envolvidos.

---

## Requisitos do Sistema

Certifique-se de que sua máquina atende aos seguintes requisitos antes de iniciar:

- **PHP**: Versão 8.0 ou superior
- **Composer**: Gerenciador de dependências PHP
- **Node.js**: Versão 16 ou superior (para dependências do frontend)
- **Banco de Dados**: PostgreSQL
- **Git**: Para controle de versão
- **Laragon** (opcional): Ambiente de desenvolvimento local para Windows

---

## Instruções de Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```

2. **Instale as dependências do PHP**
   Execute o comando abaixo para instalar todas as dependências do backend:
   ```bash
   composer install
   ```

3. **Instale as dependências do Node.js**
   Rode o comando abaixo para instalar os pacotes do frontend:
   ```bash
   npm install
   ```

4. **Configure o arquivo `.env`**
   - Duplique o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env // copy .env.example .env
     ```
   - Configure as variáveis de ambiente no arquivo `.env`, como os dados do banco de dados e outros parâmetros necessários:
     ```env
     DB_CONNECTION=pgsql
     DB_HOST=seu-host
     DB_PORT=5432
     DB_DATABASE=nome-do-banco
     DB_USERNAME=seu-usuario
     DB_PASSWORD=sua-senha
     ```

5. **Gere a chave da aplicação**
   Execute o seguinte comando para gerar a chave:
   ```bash
   php artisan key:generate
   ```

6. **Execute as migrações do banco de dados**
   Este comando criará as tabelas necessárias no banco de dados:
   ```bash
   php artisan migrate 
   ```

7. **Opcional: Gerador de dados fictícios para o banco de dados**
   ```bash
   php artisan db:seed
   ```

8. **Compile os ativos do frontend**
   Para compilar os arquivos CSS e JavaScript:
   ```bash
   npm run dev
   ```
---

## Executando o Projeto

1. **Inicie o servidor local**
   Use o comando abaixo para rodar a aplicação localmente:
   ```bash
   php artisan serve
   ```
   A aplicação estará acessível em [http://localhost:8000](http://localhost:8000).

2. **Certifique-se de que o banco de dados está rodando**
   Verifique se o PostgreSQL está ativo e acessível na configuração definida no `.env`.

---