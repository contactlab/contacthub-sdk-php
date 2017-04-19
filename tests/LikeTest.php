<?php
namespace ContactHub\Tests;

class LikeTest extends \PHPUnit_Framework_TestCase
{
    use ContactHubSetUpTrait;

    const MARIO_ROSSI_CUSTOMER_ID = 'be02ac64-4d66-4756-93fc-a9e4955db639';

    public function testAddLike()
    {
        $like = [
            'id' => 'LikeId',
            'category' => 'Category',
            'name' => 'Name',
            'createdTime' => $this->now()
        ];
        $like = $this->contactHub->addLike(static::MARIO_ROSSI_CUSTOMER_ID, $like);

        assertEquals('Category', $like['category']);
        return $like;
    }

    /**
     * @depends testAddLike
     */
    public function testUpdateLike($like)
    {
        $like['name'] = 'NewName';
        $like = $this->contactHub->updateLike(static::MARIO_ROSSI_CUSTOMER_ID, $like);

        assertEquals('NewName', $like['name']);
        return $like;
    }

    /**
     * @depends testUpdateLike
     */
    public function testDeleteLike($like)
    {
        $this->contactHub->deleteLike(static::MARIO_ROSSI_CUSTOMER_ID, $like['id']);
    }

    private function now()
    {
        return date('c');
    }
}