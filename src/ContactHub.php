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
        return $this->apiClient->post('customers/'.$customerId.'/sessions', ['value' => $sessionId]);
    }

    /**
     * @param string $customerId
     * @param array $job
     * @return array
     */
    public function addJob($customerId, array $job)
    {
        return $this->apiClient->post('customers/' . $customerId . '/jobs' , $job);
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
     * @param $customerId
     * @param array $education
     * @return array
     */
    public function addEducation($customerId, array $education)
    {
        return $this->apiClient->post('customers/'.$customerId.'/educations', $education);
    }

    /**
     * @param string $jobId
     * @return array
     */
    public function deleteJob($customerId, $jobId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/jobs/' . $jobId);
    }

    /**
     * @param $customerId
     * @param array $education
     * @return array
     */
    public function updateEducation($customerId, array $education)
    {
        $educationId = $education['id'];
        return $this->apiClient->put('customers/' . $customerId . '/educations/' . $educationId, $education);
    }

    /**
     * @param $customerId
     * @param $educationId
     * @return array
     */
    public function deleteEducation($customerId, $educationId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/educations/' . $educationId);
    }

    /**
     * @param string $customerId
     * @param array $like
     * @return array
     */
    public function addLike($customerId, array $like)
    {
        return $this->apiClient->post('customers/' . $customerId . '/likes' , $like);
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

    /**
     * @param array $like
     * @return array
     */
    public function updateLike($customerId, array $like)
    {
        $likeId = $like['id'];
        return $this->apiClient->put('customers/' . $customerId . '/likes/' . $likeId, $like);
    }

    /**
     * @param string $customerId
     * @param string $likeId
     * @return array
     */
    public function deleteLike($customerId, $likeId)
    {
        return $this->apiClient->delete('customers/'.$customerId.'/likes/'.$likeId);
    }

    /**
     * @param string $customerId
     * @param string $jobId
     * @param array $job
     * @return array
     */
    public function updateJob($customerId, $jobId, array $job)
    {
        return $this->apiClient->put('customers/' . $customerId . '/jobs/' . $jobId, $job);
    }
}