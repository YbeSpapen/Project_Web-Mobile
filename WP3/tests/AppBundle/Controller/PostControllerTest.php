<?php
/**
 * Created by PhpStorm.
 * User: brecht
 * Date: 25/10/2017
 * Time: 21:00
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testShowIndex()
    {
        $crawler = $this->client->request('GET','/');

        $this->assertEquals(
            1,
            $crawler->filter('h1:contains("Welcome")')->count()
        );
    }

    public function testButtonCountAnonymous()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET','/');

        $this->assertEquals(3,$crawler->filterXPath('descendant::td/div/a')->count());

    }

    public function testOverviewButton()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Overview")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/overview?locatieId=1',$overViewPage->getUri());


    }
    public function testRateButton()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Rate")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/giveIssue?locatieId=1',$overViewPage->getUri());


    }
    public function testStatusButton()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("status")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/overview?giveStatus?locatieId=1',$overViewPage->getUri());


    }
}
