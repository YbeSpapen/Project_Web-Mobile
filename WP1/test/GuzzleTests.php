<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: 11500691
 * Date: 6/11/2017
 * Time: 19:10
 */
class GuzzleTests extends PHPUnit\Framework\TestCase
{
    private $http;

    public function setUp()
    {
        $this->http = new Client(['base_uri' => '192.168.46.137/api/']);
    }

    public function tearDown()
    {
        $this->http = null;
    }

    /**
     * All locations API calls
     */
    public function testGetLoocation_shouldReturnJSONWithAllLocations() {
        $response = $this->http->request('GET', 'location');

        $this->assertEquals(200, $response->getStatusCode());
/*
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $userAgent = json_decode($response->getBody())->{"user-agent"};
        $this->assertRegexp('/Guzzle/', $userAgent);
*/
    }
}