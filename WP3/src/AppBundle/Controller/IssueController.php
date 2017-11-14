<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Issue;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class IssueController extends Controller
{
    /**
     * @Route("/giveIssue", name="giveIssue")
     */
    public function giveIssue(Request $request)
    {
        $locationId = $request->get('locationId');

        $issue = new Issue();
        $issue->setHandled(false);
        $issue->setDate(new Datetime());
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);
        $issue->setLocation($location);

        $form = $this->createFormBuilder($issue)
            ->add('problem', TextareaType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush();

            return $this->redirectToRoute('locations');
        }

        return $this->render('issue/issue.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/issues", name="issues")
     */
    public function showIssues(Request $request)
    {
        $locationId = $request->get('locationId');
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);

        $issues = $location->getIssues();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($issues, $request->query->getInt('page', 1), 5);

        return $this->render('issue/issues.html.twig', array('issues' => $pagination));
    }


    /**
     * @Route("/assignedIssues", name="assignedIssues")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function technicianAssignedIssues(Request $request)
    {
        $user = $user = $this->get('security.token_storage')->getToken()->getUser();
        $issues = $user->getIssues();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($issues, $request->query->getInt('page', 1), 5);

        return $this->render('issue/technician_issues.html.twig', array('issues' => $pagination));
    }

    /**
     * @Route("/setHandled", name="setHandled")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function technicianSetIssueHandled(Request $request)
    {
        $issueId = $request->get('issueId');
        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);
        $handled = $request->get('handled');

        if ($handled == 1) {
            $issue->setHandled(true);
        } else {
            $issue->setHandled(false);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('assignedIssues');
    }

    /**
     * @Route("/setTechnicianToIssue", name="setTechnicianToIssue")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function setTechnicianToIssue(Request $request)
    {
        $issueId = $request->get('issueId');
        $technicianId = $request->get('technicianId');

        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->find($technicianId);

        $issue->setTechnician($technician);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('locations');
    }

    /**
     * @Route("/setTechnician", name="setTechnician")
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function setTechnician(Request $request)
    {
        $issueId = $request->get('issueId');
        $technicianId = $request->get('technicianId');
        $assign = $request->get('assign');

        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->find($technicianId);

        if ($assign == 1) {
            $issue->setTechnician($technician);
        } else {
            $issue->setTechnician(null);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('getTechnicians', array('issueId' => $issueId));
    }
}