<?php
namespace ContactHub;

interface ApiClient
{
    public function get($path, array $params);
}