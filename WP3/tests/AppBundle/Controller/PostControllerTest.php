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

    public function testHome()
    {
        $crawler = $this->client->request('GET','/');
        $heading = $crawler->filter('h1')->eq(0)->text();
        $this->assertEquals(
            1,
            $crawler->filter('h1:contains("Welcome")')->count()
        );
    }

    public function testRowCount()
    {
        $crawler = $this->client->request('GET','/');
        $rows = $crawler->filter('tr')->count();
        $this->assertEquals(6,$rows);
    }

    public function testClickIssuesButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Issues")')->first()->link();

        $crawler = $this->client->click($link);

        $this->assertEquals('Issues', $crawler->filter('h1')->first()->text());
    }

    public function testClickStatusButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Statuses")')->first()->link();

        $crawler = $this->client->click($link);

        $this->assertEquals('Statuses', $crawler->filter('h1')->first()->text());
    }

    public function testClickGiveIssueButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Give issue")')->first()->link();

        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Send')->form();

        $form['form[problem]'] = 'Beamer lamp is kapot';

        $crawler = $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect());
        $this->client->followRedirect();
        $this->assertContains('Welcome',$this->client->getResponse()->getContent());

    }

    public function testClickGiveStatusButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Give status")')->first()->link();

        $crawler = $this->client->click($link);

        $images = $crawler->filter('img')->count();
        $this->assertEquals(3,$images);



    }










    /*
    public function testClickGiveIssueButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Give issue")')->link();
        $issuePage = $this->client->click($link);

        $this->assertEquals('http://localhost/giveIssue?locationId=7',$issuePage->getUri());
    }

    public function testClickGiveStatusButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Give status")')->link();
        $statusPage = $this->client->click($link);

        $this->assertEquals('http://localhost/giveStatus?locationId=7',$statusPage->getUri());
    }

    public function testClickIssueButton()
    {
        $crawler = $this->client->request('GET','/');

        $link = $crawler->filter('a:contains("Issues")')->link();
        $issuePage = $this->client->click($link);

        $issuePageCrawler = $this->client->request('GET',$link);

        $this->assertEquals(
            1,
            $issuePageCrawler->filter('h1:contains("Issues")')->count()
        );
    }
    */



}
