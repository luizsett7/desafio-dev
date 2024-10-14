# <h1>Instruções para o deploy do CNAB - Parse</h1>

<h2>Realize o download do projeto da branch master</h2>
baixe o zip do projeto no github, extraia, e entre na pasta do projeto

<h2>Execute os containers</h2>
docker-compose up --build -d

<h2>Entre no bash shell</h2>
docker exec -it laravel_app bash

<h2>Copie os arquivos para o container</h2>
cp -R * /desafio-dev/src

<h2>Copie o arquivo .env</h2>
cp env-example .env

<h2>Instale as dependências do Node</h2>
npm install

<h2>Instale as dependências do PHP</h2>
composer install

<h2>atribua permissões para as pastas</h2>
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache<br>
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

<h2>Gere a chave da aplicação</h2>
php artisan key:generate

<h2>Realize a migração do banco de dados</h2>
php artisan migrate

<h2>Inicie o servidor de desenvolvimento Javascript</h2>
npm run dev
