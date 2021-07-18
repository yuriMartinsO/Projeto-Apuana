<?php

namespace App\Models\Facade;

use App\Models\ElasticSearch\ElasticSearchIndexer;
use App\Models\ElasticSearch\Client;

class ElasticSearchIndexerFacade
{
    /**
     * Deleta todos os indexes do ElasticSearch
     */
    public function deleteIndexes()
    {
        $client = new Client();
        $params = ['index' => 'logs'];

        $client->delete($params);
    }

    /**
     * Realiza a indexação de todos os objetos para o ElasticSearch
     * 
     * @param array $objects
     * @return integer
     */
    public function index($objects)
    {
        $this->deleteIndexes();

        $indexed = 0;

        foreach ($objects as $object) {
            $elasticSearchIndexer = new ElasticSearchIndexer();

            if ($elasticSearchIndexer->indexObject($object)) {
                $indexed++;
            }
        }

        return $indexed;
    }
}
