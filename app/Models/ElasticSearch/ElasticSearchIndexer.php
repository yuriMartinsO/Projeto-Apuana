<?php

namespace App\Models\ElasticSearch;

class ElasticSearchIndexer
{
    /**
     * Cliente do ElasticSearch
     * 
     * @var App\Models\ElasticSearch\Client
     */
    private $client;

    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Realiza a indexação de um objeto para o ElasticSearch
     * 
     * @param Object $object
     * @return boolean
     */
    public function indexObject($object)
    {
        $params = $object->getElasticIndexerArray();

        return $this->client->index($params);
    }
}
