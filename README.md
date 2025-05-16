# Após clonar o repositório
Executar os comandos na raiz do projeto
composer install
composer update


# Docker
[Como iniciar - Linux]
-- url
Projeto público
Entrar no diretório da pasta onde foi baixado todo o conteúdo do projeto no git
Executar o comando: docker-compose up --build

OBS : Caso tenha alguma problema no @vite, executar o comando abaixo na raiz do projeto:
npm run dev

[Utilização das imagens nginx, MailHog e mysql]
- nginx - servidor web, necessário para rodar o framework Laravel;
    - Redirecionamento da porta 9000 para 80 #Interface Web

- MailHog - servidor de e-mail, necessário para realizar teste de envio de e-mail.
    - Redirecionamento da porta 8025 para 8025 #Interface Web
    - Redirecionamento da porta 1025 para 1025 #SMTP

- mysql - servidor de banco de dados
    - Redirecionamento de porta 3306 para 3306
    - Banco de dados : tray
    - Usuário : root
    - Senha : root

# Envio dos e-mails
Para enviar os e-mails pode seguir até a página "Vendedores" e clicar em "Reenviar e-mail", dessa forma o e-mail parece aquele seller será enviado.
Para enviar todos os e-mails - admin e sellers, executar o comando abaixo na raiz do projeto:
docker-compose exec app php artisan app:email-console

# Testes
Na raiz do projeto, execute o comando:
php artisan test

# Acesso
Através do navegador

Laravel: http://localhost:9000
MailHog: http://localhost:8025

# Rotas
[Acesso as rotas]
Para as rotas de API foi implementado o Sanctum para tokenizar o acesso

Para acessar:

POST http://localhost:9000/api/gettoken

Payload
{
    "email" : :email,
    "password" : :senha
}

*RETORNO ESPERADO*
{
    "user": {
        "id": :user_id,
        "name": :name,
        "email": :email,
        "email_verified_at": :email_verified_at,
        "created_at": :created_at,
        "updated_at": :updated_at
    },
    "token": :token
}

[ ROTAS DE SELLERS ]

Criar um novo seller
Endpoint : POST /api/sellers

Payload
{
    "nome" : :nome,
    "email" : :email
}

Listar todos os sellers
Endpoint : GET /api/sellers

[ ROTAS DE SALES ]

Criar uma nova venda
Endpoint : POST /api/sales

Payload
{
    "seller_id" : :seller_id, // Seller existente
    "amount" : :amount, // Float, ex: 100.05
    "sale_date" : :sale_date // Formato YYYY-mm-dd
}

Listar todas as vendas
Endpoint : GET /api/sales

Listar todas as vendas por seller
Endpoint : GET /api/sales/:seller_id
