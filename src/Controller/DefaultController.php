<?php

namespace App\Controller;

use App\Repository\ExtensionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(ExtensionRepository $extensionRepository): Response
    {
        $allExtensions = $extensionRepository->findAll();

        return $this->render('default/index.html.twig', [
            "allExtensions" => $allExtensions,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/extension/{ext}', name: 'app_extension')]
    public function extension(string $ext,ExtensionRepository $extensionRepository): Response
    {
        $extension = $extensionRepository->findOneBy(["shortcut_name"=>$ext]);

        return $this->render('extension/index.html.twig', [
            "extension" => $extension,
            'controller_name' => 'DefaultController',
        ]);
    }
}
