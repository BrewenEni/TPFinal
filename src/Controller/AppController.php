<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app_index')]
    public function index(UserRepository $userRepository, LanguageRepository $languageRepository): Response
    {
        $users = $userRepository->findAll();
        $userCount = $userRepository->getTotalUserCount();
        $languages = $languageRepository->findAll();
        return $this->render('app/index.html.twig', [
            'users' => $users,
            'languages' => $languages,
            'nbUser' => $userCount
        ]);
    }

    #[Route('/app/filtrer/{languageID}', name: 'app_filtrer')]
    public function filtrer($languageID,UserRepository $userRepository, LanguageRepository $languageRepository): Response
    {

        $users = $userRepository->orderByLanguage($languageID);
        $userCount = $userRepository->getTotalUserCount();
        $languages = $languageRepository->findAll();
        return $this->redirectToRoute('app_index');
    }
}
