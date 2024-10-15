# <h1>Instruções para o deploy do CNAB - Parse</h1>

<h2>Realize o download do projeto da branch master</h2>
baixe o zip do projeto no github, extraia, e entre na pasta do projeto

<h2>Execute os containers</h2>
docker-compose up --build -d

<h2>Copie todos os arquivos para a pasta do container (src)</h2>
find . -maxdepth 1 -not -name src -not -name . -exec cp -r {} src/ \;

<h2>Entre no bash shell</h2>
docker exec -it laravel_app bash

<h2>Copie o arquivo .env</h2>
cp env-example .env

<h2>Instale as dependências do PHP</h2>
composer install

<h2>atribua permissões para as pastas</h2>
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache<br>
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

<h2>Gere a chave da aplicação</h2>
php artisan key:generate

<h2>Realize a migração do banco de dados</h2>
php artisan migrate

<h2>Instale as dependências do Node</h2>
npm install

<h2>Inicie o servidor de desenvolvimento Javascript</h2>
npm run dev

<h2>Realize testes</h2>
Entre na pasta do projeto<br>
docker exec -it laravel_app bash<br>
php artisan test

<h1>API CNAB</h1>
A API CNAB é responsável por fazer o upload de arquivos CNAB, processar/parsing dos arquivos e listar as transações extraídas do arquivo. Abaixo estão os endpoints disponíveis:

<h2>1. Upload do Arquivo CNAB</h2><br>
Descrição:<br>
Este endpoint permite o upload de um arquivo CNAB, que será armazenado no servidor.<br>
<br>
URL: /cnab/upload<br>
Método: POST<br>
Nome da Rota: upload<br>
Parâmetros de Entrada:<br>
Arquivo CNAB no formato .txt, enviado como multipart/form-data.<br>
<br>
<h2>2. Parsing do Arquivo CNAB</h2><br>
Descrição:<br>
Este endpoint processa o arquivo CNAB enviado anteriormente e extrai as informações de transações contidas nele.<br>
<br>
URL: /cnab/parse/{filePath}<br>
Método: GET<br>
Parâmetros de URL:<br>
{filePath}: Caminho do arquivo CNAB que foi enviado, obtido da resposta do endpoint de upload.<br>
<br>
<h2>3. Listagem de Transações</h2><br>
Descrição:<br>
Este endpoint lista todas as transações processadas a partir de arquivos CNAB.<br>
<br>
URL: /cnab/transactions<br>
Método: GET

