<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller
{
    /**
     * @Route("/", name="locations")
     */
    public function showLocations(Request $request)
    {
        $locations = $this->getDoctrine()->getRepository('AppBundle:Location')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($locations, $request->query->getInt('page', 1), 5);

        return $this->render('location/locations.html.twig', array('locations' => $pagination));
    }
}