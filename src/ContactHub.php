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
     * @param GetCustomersOptions $options
     * @return array
     */
    public function getCustomers($nodeId, GetCustomersOptions $options = null)
    {
        $params = is_null($options) ? [] : $options->getParams();
        $params['nodeId'] = $nodeId;
        return $this->apiClient->get('customers', $params);
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