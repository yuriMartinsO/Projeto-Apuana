<?php

namespace App\Models\ElasticSearch\Builders;

interface ElasticSearchQueryBuilderInterface
{
    /**
     * Realiza a construção de queries e outras consultas do ElasticSearch
     * 
     * @param ONGR\ElasticsearchDSL\Search $search+
     */
    public static function build($params, $search);
}