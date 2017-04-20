<?php
namespace ContactHub\Tests;

class LikeTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

    public function testAddLike()
    {
        $like = [
            'id' => uniqid(),
            'category' => 'Category',
            'name' => 'Name',
            'createdTime' => $this->now()
        ];
        $like = $this->contactHub->addLike(Customer::ALDO_BAGLIO, $like);

        assertEquals('Category', $like['category']);
        return $like;
    }

    /**
     * @depends testAddLike
     */
    public function testUpdateLike($like)
    {
        $like['name'] = 'NewName';
        $like = $this->contactHub->updateLike(Customer::ALDO_BAGLIO, $like['id'], $like);

        assertEquals('NewName', $like['name']);
        return $like;
    }

    /**
     * @depends testUpdateLike
     */
    public function testDeleteLike($like)
    {
        $this->contactHub->deleteLike(Customer::ALDO_BAGLIO, $like['id']);
    }

    private function now()
    {
        return date('c');
    }
}