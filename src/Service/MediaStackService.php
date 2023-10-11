<?php

namespace App\Service;

use GuzzleHttp\Client;

class MediaStackService
{
    private $client;
    private $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = $_ENV['MEDIASTACK_API_KEY'];
    }

    public function getNews($params)
    {
        // Ajoutez le paramètre 'languages' pour filtrer les articles en français
        $params = array_merge($params, [
            'languages' => 'fr',
            'sort' => 'published_desc',
            'sources' => 'le-monde'
        ]);

        $response = $this->client->get('http://api.mediastack.com/v1/news', [
            'query' => array_merge($params, ['access_key' => $this->apiKey]),
        ]);

        return json_decode($response->getBody(), true);
    }
}
