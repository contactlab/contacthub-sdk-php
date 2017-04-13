<?php
namespace ContactHub\Tests;

use ContactHub\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{
    public function testAddTagWithNullTagField()
    {
        $customer = [
            'tags' => null
        ];

        $customer = Tag::add($customer, 'tag');

        assertEquals(['auto' => [], 'manual' => ['tag']], $customer['tags']);
    }

    public function testAddTagWithOneAlreadyPresentTag()
    {
        $customer = [
            'tags' => [
                'auto' => [],
                'manual' => ['already_present']
            ]
        ];

        $customer = Tag::add($customer, 'tag');

        assertEquals(['auto' => [], 'manual' => ['already_present', 'tag']], $customer['tags']);
    }

    public function testNotAddTagIfAlreadyPresent()
    {
        $customer = [
            'tags' => [
                'auto' => [],
                'manual' => ['already_present']
            ]
        ];

        $customer = Tag::add($customer, 'already_present');

        assertEquals(['auto' => [], 'manual' => ['already_present']], $customer['tags']);
    }

    public function testAddTagWithEmptyArrayTags()
    {
        $customer = [
            'tags' => []
        ];

        $customer = Tag::add($customer, 'already_present');

        assertEquals(['auto' => [], 'manual' => ['already_present']], $customer['tags']);
    }

    public function testAddTagWithManualTagsNull()
    {
        $customer = [
            'tags' => [
                'auto' => [],
                'manual' => null
            ]
        ];

        $customer = Tag::add($customer, 'already_present');

        assertEquals(['auto' => [], 'manual' => ['already_present']], $customer['tags']);
    }
}