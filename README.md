# Projeto Laravel - Gerenciamento de Funcionários - DESAFIO 01

Este é um projeto Laravel que considerei um grande desafio para mim. Consiste em um gerenciamento de funcionários, incluindo o cadastro, edição, visualização e exclusão de funcionários, bem como a criação e atualização de perfis de funcionários.

## Requisitos

- Docker
- Docker Compose
- Composer

## Instalação

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/V-Magalhaes948/desafio-01.git
    cd desafio-01
    ```

2. **Configure o ambiente Docker:**

    Certifique-se de que o Docker e o Docker Compose estão instalados no seu sistema.

3. **Crie e inicie os contêineres Docker:**

    ```bash
    docker-compose up -d
    ```

4. **Instale as dependências do Laravel:**

    Acesse o contêiner do PHP e instale as dependências usando o Composer:

    ```bash
    docker-compose exec php bash
    cd /var/www/html
    composer install
    ```

5. **Configuração do Laravel:**

    Copie o arquivo `.env.example` para `.env`:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Em seguida, edite o arquivo `.env` para configurar as variáveis de ambiente, especialmente a conexão com o banco de dados:

    ```dotenv
    DB_HOST=mysql
    DB_DATABASE=desafio-appstorm
    DB_USERNAME=root2
    DB_PASSWORD=root_password2
    ```

6. **Configuração da chave de aplicação:**

    Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

7. **Execute as migrações do banco de dados:**

    ```bash
    php artisan migrate
    ```