<?php
namespace ContactHub;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\TransferException;

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

    public function get($path, array $params = [])
    {
        try {
            $response = $this->guzzle->request('GET', $this->url($path), ['query' => $params]);
            return json_decode((string) $response->getBody(), true);
        } catch (ClientException $e) {
            throw Exception::fromJson($e->getResponse()->getBody());
        } catch (TransferException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function url($path)
    {
        return '/hub/v1/workspaces/' . $this->workspaceId . '/' . $path;
    }
}