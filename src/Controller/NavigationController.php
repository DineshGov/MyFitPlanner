<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class NavigationController extends AbstractController
{
    /**
     * @Route()
     */
    public function home(){
        return $this->render("Navigation/home.html.twig");
    }
}