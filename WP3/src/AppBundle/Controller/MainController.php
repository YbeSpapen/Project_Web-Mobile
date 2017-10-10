<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Issue;
use AppBundle\Entity\Status;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/status", name="status")
     */
    public function giveStatus()
    {
        return $this->render('default/status.html.twig');
    }

    /**
     * @Route("/issue", name="issue")
     */
    public function giveIssue(Request $request)
    {
        $issue = new Issue();
        $issue->setHandled(false);
        $issue->setDate(new Datetime());
        $issue->setLocationId($request->get('locatieId'));

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
        $status->setLocationId($locationId);
        $status->setStatus($this->getStatus($statusCode));

        $em = $this->getDoctrine()->getManager();
        $em->persist($status);
        $em->flush();

        return $this->redirectToRoute('welcome');
    }

    function getStatus($code)
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
