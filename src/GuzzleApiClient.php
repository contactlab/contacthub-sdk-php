<?php
namespace ContactHub;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

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
            ],
            'connect_timeout' => 20
        ]);
    }

    /**
     * @param string $path
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function get($path, array $params = [])
    {
        return $this->request('GET', $path, ['query' => $params]);
    }

    /**
     * @param string $path
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function post($path, array $params = [])
    {
        return $this->request('POST', $path, ['json' => $params]);
    }

    /**
     * @param string $path
     * @param array $params
     * @return array
     */
    public function delete($path, array $params = [])
    {
        return $this->request('DELETE', $path, ['query' => $params]);
    }

    /**
     * @param $path
     * @param array $params
     * @return array
     */
    public function put($path, array $params = [])
    {
        return $this->request('PUT', $path, ['json' => $params]);
    }

    /**
     * @param $path
     * @param array $params
     * @return array
     */
    public function patch($path, array $params = [])
    {
        return $this->request('PATCH', $path, ['json' => $params]);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @return array
     * @throws Exception
     */
    private function request($method, $path, $params = [])
    {
        try {
            $response = $this->guzzle->request($method, $this->url($path), $params);
            return json_decode((string)$response->getBody(), true);
        } catch (BadResponseException $e) {
            throw Exception::fromJson($e->getResponse()->getBody());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $path
     * @return string
     */
    private function url($path)
    {
        return '/hub/v1/workspaces/' . $this->workspaceId . '/' . $path;
    }
}