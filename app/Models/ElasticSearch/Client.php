<?php

namespace App\Models\ElasticSearch;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class Client
{
    /**
     * Cliente do ElasticSearch
     * 
     * @var Elasticsearch\Client
     */
    private $client;

    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    /**
     * Realiza a indexação para o ElasticSearch
     * 
     * @param array $params
     * @return boolean
     */
    public function index(array $params = [])
    {
        try {
            $response = $this->client->index($params);

            if (!$response) {
                return false;
            }

            return true;
        } catch (\Elasticsearch\Common\Exceptions\NoNodesAvailableException $e) {
            return false;
        }
    }

    /**
     * Deleta um index
     * 
     * @param array $params
     * @return boolean
     */
    public function delete(array $params = [])
    {
        try {
            $response = $this->client->indices()->delete($params);

            if (!$response) {
                return false;
            }

            return true;
        } catch (Missing404Exception $e) {
            return false;
        }
    }

    /**
     * Deleta um index
     * 
     * @param array $params
     * @return array
     */
    public function search(array $params = [])
    {
        try {
            $response = $this->client->search($params);

            return $response;
        } catch (Missing404Exception $e) {
            return [];
        }
    }
}
