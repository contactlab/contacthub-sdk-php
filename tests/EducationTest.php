<?php
namespace ContactHub\Tests;

use ContactHub\SchoolType;

class EducationTest extends \PHPUnit_Framework_TestCase
{
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

        $education = $this->contactHub->addEducation(Customer::ALDO_BAGLIO, $education);

        assertEquals('SchoolConcentration', $education['schoolConcentration']);
        return $education;
    }

    /**
     * @depends testAddEducation
     */
    public function testUpdateEducation($education)
    {
        $education['schoolConcentration'] = 'NewSchoolConcentration';

        $education = $this->contactHub->updateEducation(Customer::ALDO_BAGLIO, $education['id'], $education);

        assertEquals('NewSchoolConcentration', $education['schoolConcentration']);
        return $education;
    }

    /**
     * @depends testUpdateEducation
     */
    public function testDeleteEducation($education)
    {
        $this->contactHub->deleteEducation(Customer::ALDO_BAGLIO, $education['id']);
    }
}