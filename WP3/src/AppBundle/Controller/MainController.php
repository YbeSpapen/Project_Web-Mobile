<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Issue;
use AppBundle\Entity\Status;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MainController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function showAction(Request $request)
    {
        $locations = $this->getDoctrine()->getRepository('AppBundle:Location')->findAll();

        return $this->render('default/index.html.twig', array('locations' => $locations));
    }

    /**
     * @Route("/giveStatus", name="status")
     */
    public function giveStatus()
    {
        return $this->render('default/status.html.twig');
    }

    /**
     * @Route("/giveIssue", name="issue")
     */
    public function giveIssue(Request $request)
    {
        $locationId = $request->get('locatieId');

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

            return $this->redirectToRoute('welcome');
        }

        return $this->render('default/issue.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/handleStatus", name="handleStatus")
     */
    public function handleStatus(Request $request)
    {
        $locationId = $request->get('locatieId');
        $statusCode = $request->get('status');

        $status = new Status();
        $status->setDate(new DateTime());
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);
        $status->setLocation($location);
        $status->setStatus($this->getStatus($statusCode));

        $em = $this->getDoctrine()->getManager();
        $em->persist($status);
        $em->flush();

        return $this->redirectToRoute('welcome');
    }

    /**
     * @Route("/overview", name="overview")
     */
    public function overviewLocation(Request $request)
    {
        $locationId = $request->get('locatieId');
        $location = $this->getDoctrine()->getRepository('AppBundle:Location')->find($locationId);

        $statuses = $this->getDoctrine()->getRepository('AppBundle:Status')->findBy(
            array('location' => $location));
        $issues = $this->getDoctrine()->getRepository('AppBundle:Issue')->findBy(
            array('location' => $location));

        return $this->render('default/overview.html.twig', array('issues' => $issues, 'statuses' => $statuses));
    }

    /**
     * @Route("/assignedProblems", name="assignedProblems")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function assignedProblems(Request $request)
    {
        $user = $user = $this->get('security.token_storage')->getToken()->getUser();
        $issues = $this->getDoctrine()->getRepository('AppBundle:Issue')->findBy(array('technician' => $user));

        return $this->render('default/technician_issues.html.twig', array('issues' => $issues));
    }

    /**
     * @Route("/setHandled", name="setHandled")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function setHandled(Request $request)
    {
        $issueId = $request->get('issueId');
        $handled = $request->get('handled');
        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);
        if ($handled == 1) {
            $issue->setHandled(true);
        } else {
            $issue->setHandled(false);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('assignedProblems');

    }

    /**
     * @Route("/setTechnicianIssue", name="setTechnicianToIssue")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function setTechnicianIssue(Request $request)
    {
        $issueId = $request->get('issueId');
        $technicianId = $request->get('technicianId');
        $assign = $request->get('assign');

        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->find($technicianId);

        $issue->setTechnician($technician);

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $locations = $this->getDoctrine()->getRepository('AppBundle:Location')->findAll();
        return $this->render('default/index.html.twig', array('locations' => $locations));
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

    /**
     * @Route("/getTechnicians", name="getTechnicians")
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function getTechnicians(Request $request)
    {
        $issueId = $request->get('issueId');
        $technicians = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('role' => 'ROLE_TECHNICIAN'));
        $issue = $this->getDoctrine()->getRepository('AppBundle:Issue')->find($issueId);

        return $this->render('default/technicians.html.twig', array('technicians' => $technicians, 'issue' => $issue));
    }

    /**
     * @Route("/getTechniciansAdmin", name="getTechniciansAdmin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getTechniciansAdmin(Request $request)
    {
        $technicians = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('role' => 'ROLE_TECHNICIAN'));

        return $this->render('default/technicians_admin.html.twig', array('technicians' => $technicians));
    }

    /**
     * @Route("/editTechnician", name="editTechnician")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editTechnician(Request $request)
    {
        $technicianId = $request->get('technicianId');
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('role' => 'ROLE_TECHNICIAN', 'id' => $technicianId));


        $form = $this->createForm(UserType::class, $technician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($technician, $technician->getPlainPassword());
            $technician->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('getTechniciansAdmin');
        }

        return $this->render('default/technician_edit_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/removeTechnician", name="removeTechnician")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeTechnician(Request $request)
    {
        $technicianId = $request->get('technicianId');
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('role' => 'ROLE_TECHNICIAN', 'id' => $technicianId));
        $issues = $this->getDoctrine()->getRepository('AppBundle:Issue')->findBy(array('technician' => $technicianId));

        $em = $this->getDoctrine()->getManager();
        foreach ($issues as $issue )
        {
            $issue->setTechnician();
        }
        $em->remove($technician);
        $em->flush();

        return $this->redirectToRoute('getTechniciansAdmin');
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
