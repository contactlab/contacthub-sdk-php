<?php
namespace ContactHub\Tests;

use ContactHub\ContactHub;

trait ContactHubSetUpTrait
{
    /** @var ContactHub */
    private $contactHub;

    public function setUp()
    {
        $this->contactHub = new ContactHub(Auth::TOKEN, Auth::WORKSPACE_ID, Auth::NODE_ID);
    }
}