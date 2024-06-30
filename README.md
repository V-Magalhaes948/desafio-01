## Instalação

1. **Clone o repositório:**

    ```bash
    git clone <URL-do-repositório>
    cd my_project
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

    Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente a conexão com o banco de dados:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

6. **Execute as migrações do banco de dados:**

    ```bash
    php artisan migrate
    ```