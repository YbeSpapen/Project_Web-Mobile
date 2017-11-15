<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\TechnicianEditType;
use AppBundle\Form\TechnicianType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return $this->render(
            'auth/login.html.twig',
            array(
                'last_username' => $helper->getLastUsername(),
                'error' => $helper->getLastAuthenticationError(),
            )
        );
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setRole('ROLE_MANAGER');
            //$user->setRole('ROLE_ADMIN');

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('auth/register_manager.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/adminRegisterTechnician", name="adminRegisterTechnician")
     */
    public function adminRegisterTechnician(Request $request)
    {
        $user = new User();
        $form = $this->createForm(TechnicianType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);


            $user->setRole('ROLE_TECHNICIAN');

            /** @var UploadedFile $file */
            $file = $user->getPhoto();

            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );

                $user->setPhoto($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('getTechniciansAdmin');
        }

        return $this->render('auth/register_technician.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

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

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($technicians, $request->query->getInt('page', 1), 5);

        return $this->render('user/technicians.html.twig', array('technicians' => $pagination, 'issue' => $issue));
    }

    /**
     * @Route("/getTechniciansAdmin", name="getTechniciansAdmin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getTechniciansAdmin(Request $request)
    {
        $technicians = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('role' => 'ROLE_TECHNICIAN'));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($technicians, $request->query->getInt('page', 1), 5);

        return $this->render('user/technicians_admin.html.twig', array('technicians' => $pagination));
    }


    /**
     * @Route("/editTechnician", name="editTechnician")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editTechnician(Request $request)
    {
        $technicianId = $request->get('technicianId');
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('role' => 'ROLE_TECHNICIAN', 'id' => $technicianId));
        $oldPhoto = $technician->getPhoto();

        $form = $this->createForm(TechnicianEditType::class, $technician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $technician->getPhoto();

            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );

                $technician->setPhoto($fileName);
            } else {
                $technician->setPhoto($oldPhoto);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('getTechniciansAdmin');
        }

        return $this->render('auth/edit_technician.html.twig', [
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
        $technician = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('id' => $technicianId));

        $em = $this->getDoctrine()->getManager();
        $em->remove($technician);
        $em->flush();

        return $this->redirectToRoute('getTechniciansAdmin');
    }

    /**
     * @Route("/pdf", name="pdf")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function pdfAction()
    {
        $user = $user = $this->get('security.token_storage')->getToken()->getUser();

        $html = $this->renderView('user/pdf.html.twig', array('user' => $user));

        $name = $user->getName();
        $date = date('d-m-Y');
        $filename = sprintf("%s - %s.pdf", $name, $date);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }

    /**
     * @Route("/csv", name="csv")
     * @Security("has_role('ROLE_TECHNICIAN')")
     */
    public function csvAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('AppBundle:Issue')->findAllUnhandledIssuesByUser($user);

        $response = new StreamedResponse();
        $response->setCallback(
            function () use ($results) {
                $handle = fopen('php://output', 'r+');
                fputcsv($handle, array("Problem", "Since", "Location"), ';', '"');
                foreach ($results as $row) {
                        $data = array($row->getProblem(), $row->getDate()->format('Y-m-d'), $row->getLocation());
                        fputcsv($handle, $data, ';', '"');
                }
                fclose($handle);
            }
        );
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition', 'attachment; filename="tasks.csv"');

        return $response;
    }
}