<?php

namespace App\Models\ElasticSearch\Builders;

use \ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use \ONGR\ElasticsearchDSL\Query\TermLevel\RangeQuery;
use \ONGR\ElasticsearchDSL\Query\TermLevel\TermQuery;
use \ONGR\ElasticsearchDSL\Query\TermLevel\TermsQuery;

class ElasticsearchQueryLog implements ElasticSearchQueryBuilderInterface
{
     /**
     * Constrói uma query de tipo de log para o ElasticSearch
     */
    public static function buildLogTypeSearch($bool, $options)
    {
        if (!$options['logType'] || $options['logType'] <= 0) {
            return;
        }

        $termQueryForUser = new TermQuery("logType", $options['logType']);
        $bool->add($termQueryForUser, BoolQuery::MUST);
    }

    /**
     * Constrói uma query de data para o ElasticSearch
     */
    public static function buildDataRangeSearch($bool, $options)
    {
        if (!$options['inicialDate'] && !$options['finalDate']) {
            return;
        }

        $rangeFilter = [];

        if ($options['initialDate']) {
            $inicialDate = date('Y/m/d H:m:s', strtotime($options['initialDate']));
            $rangeFilter['gte'] = $inicialDate;
        }

        if ($options['finalDate']) {
            $finalDate = date('Y/m/d H:m:s', strtotime($options['finalDate']));
            $rangeFilter['lte'] = $finalDate;
        }

        $rangeQuery = new RangeQuery(
            "date",
            $rangeFilter
        );

        $bool->add($rangeQuery, BoolQuery::MUST);
    }

    /**
     * Constrói uma query de pesquisa de conteúdo para o ElasticSearch
     */
    public static function buildContentSearch($bool, $options)
    {
        if (!$options['content']) {
            return;
        }

        $terms = explode(' ', $options['content']);

        $termQueryForUser = new TermsQuery(
            "content",
            $terms
        );

        $bool->add($termQueryForUser, BoolQuery::MUST);
    }
    
    /**
     * @doc parent
     */
    public static function build($options, $search)
    {
        $bool = new BoolQuery();

        self::buildDataRangeSearch($bool, $options);
        self::buildLogTypeSearch($bool, $options);
        self::buildContentSearch($bool, $options);

        $search->addQuery($bool);
    }
}