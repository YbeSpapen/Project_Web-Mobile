<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller
{
    /**
     * @Route("/", name="locations")
     */
    public function showLocations(Request $request)
    {
        $locations = $this->getDoctrine()->getRepository('AppBundle:Location')->findBy(array(), array('name' => 'ASC'));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($locations, $request->query->getInt('page', 1), 5);

        return $this->render('location/locations.html.twig', array('locations' => $pagination));
    }
}