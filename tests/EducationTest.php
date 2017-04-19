<?php
namespace ContactHub\Tests;

use ContactHub\SchoolType;

class EducationTest extends \PHPUnit_Framework_TestCase
{
    const MARIO_ROSSI_CUSTOMER_ID = 'be02ac64-4d66-4756-93fc-a9e4955db639';

    use ContactHubSetUpTrait;

    public function testAddEducation()
    {
        $education = [
            'id' => 'EducationId',
            'schoolType' => SchoolType::HIGH_SCHOOL,
            'schoolName' => 'SchoolName',
            'schoolConcentration' => 'SchoolConcentration',
            'startYear' => 2016,
            'endYear' => 2017,
            'isCurrent' => true
        ];

        $education = $this->contactHub->addEducation(static::MARIO_ROSSI_CUSTOMER_ID, $education);

        assertEquals('SchoolConcentration', $education['schoolConcentration']);
        return $education;
    }

    /**
     * @depends testAddEducation
     */
    public function testUpdateEducation($education)
    {
        $education['schoolConcentration'] = 'NewSchoolConcentration';

        $education = $this->contactHub->updateEducation(static::MARIO_ROSSI_CUSTOMER_ID, $education);

        assertEquals('NewSchoolConcentration', $education['schoolConcentration']);
        return $education;
    }

    /**
     * @depends testUpdateEducation
     */
    public function testDeleteEducation($education)
    {
        $this->contactHub->deleteEducation(static::MARIO_ROSSI_CUSTOMER_ID, $education['id']);
    }
}