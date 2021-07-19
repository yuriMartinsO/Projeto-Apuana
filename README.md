# Sobre o projeto Apuana:

O projeto tem como iniciativa criar um sistema simples de logs, bem também como a utilização do ElasticSearch.
Para mais informações sobre ElasticSearch: https://www.elastic.co/pt/what-is/elasticsearch

# Instalação

- Primeiro instale o Laravel: https://laravel.com/docs/8.x/installation
- Após isso, instale e configure o ElasticSearch em seu computador: https://www.elastic.co/guide/en/elasticsearch/reference/current/install-elasticsearch.html
- Execute o projeto rodando o comando: php artisan serve e também executando o ElasticSearch

# Documentação da API

Para facilitar, abaixo segue um exemplo simples das requisições de API:

### Retorna um array de logs
GET home/log

### Indexa todos os logs existentes
GET home/indexLogs

### Cria um novo Log
POST home/log
<br> {
<br>     "logType": 1,
<br>     "content": "descrição do log"
<br> }

### Retorna um array de logs
GET home/search?logType=1&content=temo(s) de pesquisa&initialDate=2021-01-20 22:10:10&finalDate=2021-12-20 22:10:10

#### Parâmetros
- logType = 1
- content = termo(s) de pesquisa
- initialDate = 2021-01-20 22:10:10
- finalDate = 2021-12-20 22:10:10

# License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
