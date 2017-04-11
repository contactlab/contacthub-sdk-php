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
     * @param string $externalId
     * @param array $query
     * @param array $fields
     * @return array
     */
    public function getCustomers($nodeId, $externalId = null, $query = null, $fields = [])
    {
        return $this->apiClient->get('customers', [
            'nodeId' => $nodeId,
            'externalId' => $externalId,
            'query' => json_encode($query),
            'fields' => implode(',', $fields)
        ]);
    }

    public function addCustomer($nodeId, $customer)
    {
        $customer['nodeId'] = $nodeId;
        return $this->apiClient->post('customers', $customer);
    }

    public function deleteCustomer($customerId)
    {
        return $this->apiClient->delete('customers', $customerId);
    }
}