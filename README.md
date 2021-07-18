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

### Cria um novo Log
POST home/log
{
    "logType": 1,
    "content": "descrição do log"
}

### Retorna um array de logs
GET home/search
http://127.0.0.1:8000/search?logType= 1&content=temo(s) de pesquisa&initialDate=2021-01-20 22:10:10&finalDate=2021-12-20 22:10:10

logType = 1
content = temo(s) de pesquisa
initialDate = 2021-01-20 22:10:10
finalDate = 2021-12-20 22:10:10

# License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
