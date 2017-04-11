<?php
namespace ContactHub;

class ContactHub
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    private function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public static function create($token, $workspaceId)
    {
        return new static(new GuzzleApiClient($token, $workspaceId));
    }

    /**
     * @param string $nodeId
     * @return Paginated
     */
    public function getCustomers($nodeId)
    {
        return $this->apiClient->get('customers', ['nodeId' => $nodeId]);
    }
}