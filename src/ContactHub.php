<?php
namespace ContactHub;

use Ramsey\Uuid\Uuid;

/**
 * ContactHub contains method for interact with ContactHub Apis
 * @package ContactHub
 */
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
     * 
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
     * Gets list of customers
     *
     * @param GetCustomersOptions $options
     * @return array
     */
    public function getCustomers(GetCustomersOptions $options = null)
    {
        $params = is_null($options) ? [] : $options->getParams();
        $params['nodeId'] = $this->nodeId;
        return $this->apiClient->get('customers', $params);
    }

    /**
     * Gets details of customer
     *
     * @param string $customerId
     * @return array
     */
    public function getCustomer($customerId)
    {
        return $this->apiClient->get('customers/' . $customerId);
    }

    /**
     * Create a new customer
     *
     * @param array $customer
     * @return array
     */
    public function addCustomer(array $customer)
    {
        $customer['nodeId'] = $this->nodeId;
        return $this->apiClient->post('customers', $customer);
    }

    /**
     * Modify customer
     *
     * @param string $customerId
     * @param array $customer
     * @return array
     */
    public function updateCustomer($customerId, array $customer)
    {
        $customer['nodeId'] = $this->nodeId;
        $customer['id'] = $customerId;
        return $this->apiClient->put('customers/' . $customerId, $customer);
    }

    /**
     * Delete customer
     *
     * @param string $customerId
     * @return array
     */
    public function deleteCustomer($customerId)
    {
        return $this->apiClient->delete('customers/' . $customerId);
    }

    /**
     * Modifies partially the customer
     *
     * @param string $customerId
     * @param array $customer
     * @return array
     */
    public function patchCustomer($customerId, array $customer)
    {
        return $this->apiClient->patch('customers/' . $customerId, $customer);
    }

    /**
     * Add a new tag to customer
     *
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
     * Delete tag from customer
     *
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
     * Create customer education
     *
     * @param string $customerId
     * @param array $education
     * @return array
     */
    public function addEducation($customerId, array $education)
    {
        return $this->apiClient->post('customers/' . $customerId . '/educations', $education);
    }

    /**
     * Modify customer education
     *
     * @param string $customerId
     * @param string $educationId
     * @param array $education
     * @return array
     */
    public function updateEducation($customerId, $educationId, array $education)
    {
        return $this->apiClient->put('customers/'.$customerId.'/educations/' . $educationId, $education);
    }

    /**
     * Delete customer education
     *
     * @param string $customerId
     * @param string $educationId
     * @return array
     */
    public function deleteEducation($customerId, $educationId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/educations/' . $educationId);
    }

    /**
     * Add customer Job
     *
     * @param string $customerId
     * @param array $job
     * @return array
     */
    public function addJob($customerId, array $job)
    {
        return $this->apiClient->post('customers/' . $customerId . '/jobs' , $job);
    }

    /**
     * Update customer Job
     *
     * @param string $customerId
     * @param string $jobId
     * @param array $job
     * @return array
     */
    public function updateJob($customerId, $jobId, array $job)
    {
        return $this->apiClient->put('customers/' . $customerId . '/jobs/' . $jobId, $job);
    }

    /**
     * Delete customer Job
     *
     * @param string $customerId
     * @param string $jobId
     * @return array
     */
    public function deleteJob($customerId, $jobId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/jobs/' . $jobId);
    }

    /**
     * Generate session id
     *
     * @return string
     */
    public function generateSessionId()
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * Gets list of session assign to customer
     *
     * @param string $customerId
     * @return array
     */
    public function getSessions($customerId)
    {
        return $this->apiClient->get('customers/' . $customerId . '/sessions');
    }


    /**
     * Gets a specific sessions assigned at customer
     *
     * @param string $customerId
     * @param string $sessionId
     * @return array
     */
    public function getSession($customerId, $sessionId)
    {
        return $this->apiClient->get('customers/' . $customerId . '/sessions/' . $sessionId);
    }

    /**
     * Create a session of customer
     *
     * @param string $customerId
     * @param string $sessionId
     * @return array
     */
    public function addSession($customerId, $sessionId)
    {
        return $this->apiClient->post('customers/' . $customerId . '/sessions', ['value' => $sessionId]);
    }

    /**
     * Delete a session of customer
     *
     * @param string $customerId
     * @param string $sessionId
     * @return array
     */
    public function deleteSession($customerId, $sessionId)
    {
        return $this->apiClient->delete('customers/' . $customerId . '/sessions/' . $sessionId);
    }

    /**
     * Create customer like
     *
     * @param string $customerId
     * @param array $like
     * @return array
     */
    public function addLike($customerId, array $like)
    {
        return $this->apiClient->post('customers/' . $customerId . '/likes' , $like);
    }

    /**
     * Modify customer like
     *
     * @param string $customerId
     * @param string $likeId
     * @param array $like
     * @return array
     */
    public function updateLike($customerId, $likeId, array $like)
    {
        $like['id'] = $likeId;
        return $this->apiClient->put('customers/' . $customerId . '/likes/' . $likeId, $like);
    }

    /**
     * Delete customer like
     *
     * @param string $customerId
     * @param string $likeId
     * @return array
     */
    public function deleteLike($customerId, $likeId)
    {
        return $this->apiClient->delete('customers/'.$customerId.'/likes/'.$likeId);
    }

    /**
     * Get customer events
     *
     * @param string $customerId
     * @param GetEventsOptions $options
     * @return array
     */
    public function getEvents($customerId, GetEventsOptions $options = null)
    {
        $params = $options ? $options->toParams() : [];
        $params['customerId'] = (string) $customerId;
        return $this->apiClient->get('events', $params);
    }

    /**
     * Add customer event
     *
     * @param string $customerId
     * @param array $event
     * @return array
     */
    public function addEvent($customerId, array $event)
    {
        $event['customerId'] = $customerId;
        return $this->apiClient->post('events', $event);
    }

    /**
     * Delete customer event
     * 
     * @param string $eventId
     * @return array
     */
    public function deleteEvent($eventId)
    {
        return $this->apiClient->delete('events/' . $eventId);
    }
}