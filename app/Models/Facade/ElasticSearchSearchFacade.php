<?php

namespace App\Models\Facade;

use App\Models\ElasticSearch\Client;
use App\Models\ElasticSearch\Builders\ElasticsearchQueryLog;

class ElasticSearchSearchFacade
{
    /**
     * Realiza a indexação de todos os objetos para o ElasticSearch
     * 
     * @param array $searchFields
     * @return Log[]
     */
    public function search($searchFields)
    {
        $search = new \ONGR\ElasticsearchDSL\Search();

        ElasticsearchQueryLog::build($searchFields, $search);

        $params = [
            'index' => 'logs',
            'type' => 'log',
            'body' => $search->toArray(),
        ];

        $client = new Client();
        $return = $client->search($params);

        $results = [];

        foreach ($return["hits"]["hits"] as $result) {
            $results[] = $result["_source"];
        }

        return $results;
    }
}
