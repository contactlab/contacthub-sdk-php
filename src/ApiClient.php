<?php
namespace ContactHub;

interface ApiClient
{
    public function get($path, array $params = []);

    public function post($path, array $params = []);

    public function put($path, array $params = []);

    public function delete($path, array $params = []);
}