<?php

namespace App\Controller;

use App\Entity\FormPanel;
use App\Form\FormPanelType;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;

class FormController extends AbstractController
{
    #[Route('/', name: 'app_form',
    //Create contact forms
    //Save data in database
        )]
    public function index(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $formPanel = new FormPanel();

        $form = $this->createForm(FormPanelType::class, $formPanel);
        $form->handleRequest($request);
        $formPanel->setBrowserName($_SERVER['HTTP_USER_AGENT']);
        $formPanel->setIpAddress($request->getClientIp());

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('pdfFileName')->getData();

            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $uuid  = Uuid::v4();
                $newFilename = $safeFilename . '-' . $uuid->toBase32() . '.' . $pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo $e;
                }
                $formPanel->setPdfFileName($newFilename);
            }

            $em = $doctrine->getManager();
            $em->persist($formPanel);
            $em->flush();
            $this->addFlash('success', 'Thank you for your notification');
            return $this->redirectToRoute('app_form');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
