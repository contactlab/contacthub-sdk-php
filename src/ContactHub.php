<?php
namespace ContactHub;

use Ramsey\Uuid\Uuid;

class ContactHub
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @var string
     */
    private $nodeId;

    /**
     * ContactHub constructor.
     * @param string $token
     * @param string $workspaceId
     * @param string $nodeId
     */
    public function __construct($token, $workspaceId, $nodeId)
    {
        $this->nodeId = $nodeId;
        $this->apiClient = new GuzzleApiClient($token, $workspaceId);
    }

    /**
     * @param GetCustomersOptions $options
     * @return string
     */
    public function getCustomers(GetCustomersOptions $options = null)
    {
        $params = is_null($options) ? [] : $options->getParams();
        $params['nodeId'] = $this->nodeId;
        return $this->apiClient->get('customers', $params);
    }

    /**
     * @param string $customerId
     * @return array
     */
    public function getCustomer($customerId)
    {
        return $this->apiClient->get('customers/' . $customerId);
    }

    /**
     * @param array $customer
     * @return array
     */
    public function addCustomer($customer)
    {
        $customer['nodeId'] = $this->nodeId;
        return $this->apiClient->post('customers', $customer);
    }

    /**
     * @param $customerId
     * @param $customer
     * @return array
     */
    public function updateCustomer($customerId, $customer)
    {
        $customer['nodeId'] = $this->nodeId;
        $customer['id'] = $customerId;
        return $this->apiClient->put('customers/' . $customerId, $customer);
    }

    /**
     * @param string $customerId
     * @return array
     */
    public function deleteCustomer($customerId)
    {
        return $this->apiClient->delete('customers/' . $customerId);
    }

    /**
     * @param $customerId
     * @param $customer
     * @return array
     */
    public function patchCustomer($customerId, $customer)
    {
        return $this->apiClient->patch('customers/' . $customerId, $customer);
    }

    /**
     * @param string $customerId
     * @param string $tag
     * @return array
     */
    public function addTag($customerId, $tag)
    {
        $customer = $this->getCustomer($customerId);
        $customer = Tag::add($customer, $tag);
        return $this->updateCustomer($customerId, $customer);
    }

    /**
     * @param string $customerId
     * @param string $tag
     * @return array
     */
    public function removeTag($customerId, $tag)
    {
        $customer = $this->getCustomer($customerId);
        $customer = Tag::remove($customer, $tag);
        return $this->updateCustomer($customerId, $customer);
    }

    /**
     * @return string
     */
    public function generateSessionId()
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * @param string $customerId
     * @param string $sessionId
     * @return array
     */
    public function addSession($customerId, $sessionId)
    {
        return $this->apiClient->post('customers/' . $customerId . '/sessions', ['value' => $sessionId]);
    }

    /**
     * @param string $customerId
     * @param string $sessionId
     * @return array
     */
    public function deleteSession($customerId, $sessionId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/sessions/' . $sessionId);
    }

    /**
     * @param string $customerId
     * @return array
     */
    public function getSessions($customerId)
    {
        return $this->apiClient->get('customers/' . $customerId . '/sessions');
    }

    /**
     * @param $customerId
     * @param $sessionId
     * @return array
     */
    public function getSession($customerId, $sessionId)
    {
        return $this->apiClient->get('customers/' . $customerId . '/sessions/' . $sessionId);
    }
}