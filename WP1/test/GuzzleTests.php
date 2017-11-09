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

    /**
     * All locations API calls
     */
    public function testGetLocation_shouldReturnJSONWithAllLocations() {
        $response = $this->http->request('GET', 'location');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson[0]->id, "1");
    }

    /**
     * Get statuses by location_id API calls
     */
    public function testGetStatusesByLocationId_shouldReturnJSONWithAllFoundLocations() {
        $response = $this->http->request('GET', 'status/location/1');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson[0]->id, "11");
    }

    /**
     * Get status percentage API calls
     */
    public function testGetStatusesPercentage_shouldReturnJSONWithPercentage() {
        $response = $this->http->request('GET', 'status/percentage');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertNotNull($decodedJson);
    }

    /**
     * Get issues by location_id API calls
     */
    public function testGetIssuesByLocationId_shouldReturnJSONWithAllFoundIssues() {
        $response = $this->http->request('GET', 'issue/location/1');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson[0]->id, "2");
    }

    /**
     * Get issue by id API calls
     */
    public function testGetIssuesById_shouldReturnJSONWithFoundIssue() {
        $response = $this->http->request('GET', 'issue/2');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->id, "2");
    }

    /**
     * Get issues by technician_id API calls
     */
    public function testGetIssuesByTechnicianId_shouldReturnJSONWithAllFoundIssues() {
        $response = $this->http->request('GET', 'issue/technician/1');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson[0]->id, "2");
    }

    /**
     * Get technicians  API calls
     */
    public function testGetTechnicians_shouldReturnJSONWithAllFoundTechnicians() {
        $response = $this->http->request('GET', 'technicians');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson[0]->id, "1");
    }

    /**
     * Add location API call
     */
    public function testAddLocation_shouldReturnJSONWithAddedLocation() {
        $response = $this->http->request('POST', 'location/add', [
            'form_params'=> [
                "id" => "1",
                "name" => "Brussel"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->name, "Brussel");
    }

    /**
     * Add status API call
     */
    public function testAddStatus_shouldReturnJSONWithAddedStatus() {
        $response = $this->http->request('POST', 'status/add', [
            'form_params'=> [
                "location_id" => "1",
                "status" => "HAPPY",
                "date" => "2017-11-08 19:25:05"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->status, "HAPPY");
    }

    /**
     * Add issue API call
     */
    public function testAddIssue_shouldReturnJSONWithAddedIssue() {
        $response = $this->http->request('POST', 'issue/add', [
            'form_params'=> [
                "location_id" => "1",
                "problem" => "Verstopte WC",
                "date" => "2017-11-08 19:25:05",
                "handled" => 0
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->problem, "Verstopte WC");
    }

    /**
    * Add technician API call
    */
    public function testAddTechnician_shouldReturnJSONWithAddedTechnician() {
        $response = $this->http->request('POST', 'technician/add', [
            'form_params'=> [
                "email" => "robbekimpen@hotmail.com",
                "name" => "Robbe Kimpen",
                "role" => "ROLE_TECHNICIAN",
                "password" => "testtest"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->email, "robbekimpen@hotmail.com");
    }

    /**
     * Assign technician to issue API call
     */
    public function testAssignTechnician_shouldReturnJSONWithUpdatedIssue() {
        $response = $this->http->request('POST', 'issue/assignTechnician', [
            'form_params'=> [
                "issue_id" => "4",
                "technician_id" => "1"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->technician_id, "1");
    }

    /**
     * Update issue state API call
     */
    public function testUpdateIssueState_shouldReturnJSONWithUpdatedIssue() {
        $response = $this->http->request('POST', 'issue/updateState', [
            'form_params'=> [
                "issue_id" => "4",
                "handled" => "1"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $decodedJson = json_decode($response->getBody());
        $this->assertEquals($decodedJson->handled, "1");
    }

    public function tearDown()
    {
        $this->http = null;
    }
}
