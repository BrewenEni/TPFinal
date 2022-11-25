<?php

namespace App\Controller;

use App\Repository\UserRepository;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(UserRepository $userRepository){
        $userCount = $userRepository->getTotalUserCount();
        $currentUser = $this->getUser();
        if($currentUser){
            return $this->redirectToRoute('app_index');
        }
        return $this->render('main/home.html.twig',[
            "nbUser" => $userCount
        ]);
    }
}
