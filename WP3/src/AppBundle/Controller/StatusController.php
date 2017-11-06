<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use DateTime;
use AppBundle\Entity\Status;

class StatusController extends Controller
{
    /**
     * @Route("/giveStatus", name="giveStatus")
     */
    public function giveStatus()
    {
        return $this->render('default/status.html.twig');
    }

    /**
     * @Route("/handleStatus", name="handleStatus")
     */
    public function handleStatus(Request $request)
    {
        $locationId = $request->get('locationId');
        $statusCode = $request->get('status');

        $status = new Status();
        $status->setDate(new DateTime());
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);
        $status->setLocation($location);
        $status->setStatus($this->getStatus($statusCode));

        $em = $this->getDoctrine()->getManager();
        $em->persist($status);
        $em->flush();

        return $this->redirectToRoute('locations');
    }

    /**
     * @Route("/statuses", name="statuses")
     */
    public function showStatuses(Request $request)
    {
        $locationId = $request->get('locationId');
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);

        $statuses = $location->getStatuses();

        return $this->render('default/statuses.html.twig', array('statuses' => $statuses));
    }

    private function getStatus($code)
    {
        if ($code == 1) {
            return "HAPPY";
        } else if ($code == 2) {
            return "MEDIUM";
        } else {
            return "MAD";
        }
    }

}