<?php
/**
 * Created by PhpStorm.
 * User: brecht
 * Date: 25/10/2017
 * Time: 21:00
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\MainController;
use AppBundle\Entity\Location;
use AppBundle\Repository\LocatieRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/*
 * The Symfony docs describe functional testing like this:
 *  Make a request;
 * Test the response;
 * Click on a link or submit a form;
 * Test the response;
 * Rinse and repeat.
 */
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
        $crawler = $this->client->request('GET','/');

        $this->assertEquals(3,$crawler->filterXPath('descendant::td/div/a')->count());

    }

    public function testOverviewButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Overview")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/overview?locatieId=1',$overViewPage->getUri());


    }
    public function testRateButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Rate")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/giveIssue?locatieId=1',$overViewPage->getUri());


    }
    public function testStatusButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("status")')->link();
        $overViewPage = $this->client->click($link);

        $this->assertEquals('http://localhost/giveStatus?locatieId=1',$overViewPage->getUri());
    }
}
