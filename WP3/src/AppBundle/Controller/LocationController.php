<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LocationController extends Controller
{
    /**
     * @Route("/", name="locations")
     */
    public function showLocations()
    {
        $locations = $this->getDoctrine()->getRepository('AppBundle:Location')->findAll();

        return $this->render('location/locations.html.twig', array('locations' => $locations));
    }
}