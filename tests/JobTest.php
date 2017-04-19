<?php
namespace ContactHub\Tests;

class JobTest extends \PHPUnit_Framework_TestCase
{
    const MARIO_ROSSI_CUSTOMER_ID = 'be02ac64-4d66-4756-93fc-a9e4955db639';

    use ContactHubSetUpTrait;

    public function testAddJob()
    {
        $job = [
            'id' => 'NewJobId',
            'companyIndustry' => 'Company Industry',
            'companyName' => 'Company Name',
            'jobTitle' => 'Job Title',
            'startDate' => '2017-04-03',
            'endDate' => '2017-04-13',
            'isCurrent' => true
        ];

        $job = $this->contactHub->addJob(static::MARIO_ROSSI_CUSTOMER_ID, $job);

        assertEquals('Company Name', $job['companyName']);
        return $job;
    }

    /**
     * @depends testAddJob
     */
    public function testUpdateJob($job)
    {
        $job['jobTitle'] = 'New Job Title';

        $job = $this->contactHub->updateJob(static::MARIO_ROSSI_CUSTOMER_ID, $job['id'], $job);

        assertEquals('New Job Title', $job['jobTitle']);
        return $job;
    }

    /**
     * @depends testUpdateJob
     */
    public function testDeleteJob($job)
    {
        $this->contactHub->deleteJob(static::MARIO_ROSSI_CUSTOMER_ID, $job['id']);
    }
}