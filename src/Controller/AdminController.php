<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\GroupeMusculaire;
use App\Entity\Muscle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends abstractController
{
    /**
     * @Route()
     */
    public function read(){
        $em = $this->getDoctrine()->getManager();
        $exerciceRepository = $em->getRepository(Exercice::class);
        $exercices = $exerciceRepository->findBy([], ['name' => 'ASC']);

        $groupeMusculaireRepository = $em->getRepository(GroupeMusculaire::class);
        $groupesMusculaires = $groupeMusculaireRepository->findBy([], ['name' => 'ASC']);

        $muscleRepository = $em->getRepository(Muscle::class);
        $muscles = $muscleRepository->findBy([], ['name' => 'ASC']);

        return $this->render("Admin/home.html.twig",
            ['exercices' => $exercices,
             'groupesMusculaires' => $groupesMusculaires,
             'muscles' => $muscles]
        );
    }
}