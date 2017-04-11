<?php
namespace ContactHub;

use GuzzleHttp\Client;

class GuzzleApiClient implements ApiClient
{
    const BASE_URL = 'https://api.contactlab.it/';

    private $guzzle;
    private $workspaceId;

    function __construct($token, $workspaceId)
    {
        $this->workspaceId = $workspaceId;
        $this->guzzle = new Client([
            'base_uri' => self::BASE_URL,
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);
    }

    public function get($path, array $params)
    {
        $response = $this->guzzle->request('GET', $this->url($path), ['query' => $params]);
        return (string) $response->getBody();
    }

    private function url($path)
    {
        return '/hub/v1/workspaces/' . $this->workspaceId . '/' . $path;
    }
}