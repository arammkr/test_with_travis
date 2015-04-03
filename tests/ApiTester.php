<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Session;

class ApiTester extends TestCase
{
    protected $faker;

    protected $responseObject;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    public function setUp()
    {
        parent::setUp();
        Session::start();
    }


    protected function getJson($uri, $method = 'GET', $params = [])
    {
        $this->responseObject = json_decode($this->call($method, $uri, $params)->getContent(), true);
        return $this->responseObject;
    }

    public function assertApiStatusOk()
    {
        $this->assertEquals('OK', $this->responseObject['status']);
    }

    public function assertApiStatusNotAuth()
    {
        $this->assertEquals('NOT_AUTH', $this->responseObject['status']);
    }

    public function assertApiStatusNotFound()
    {
        $this->assertEquals('NOT_FOUND', $this->responseObject['status']);
    }

    public function token()
    {
        $this->startSession();
        return csrf_token();
    }

    public function login()
    {
        $this->be($this->getUserForAuth());
        return $this;
    }
}

