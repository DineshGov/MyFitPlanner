<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Seance;
use App\Entity\Serie;
use App\Form\Type\SerieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/serie")
 */
class SerieController extends abstractController
{
    /**
     * @Route("/new/{id}", requirements={"id":"\d+"})
     */
    public function create(Request $request, Seance $seance){
        $serie = new Serie();
        $serie->setSeance($seance);

        $form = $this
            ->createForm(SerieType::class, $serie);
        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($serie);
            $em->flush($serie);

            $this->addFlash('success','La série a été ajoutée.');

            return $this->redirectToRoute('app_serie_read', [
                'id' => $seance->getId() ]);
        }

        return $this->render('Serie/create.html.twig', ['serieForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/read/{id}", requirements={"id":"\d+"})
     */
    public function read(Seance $seance){
        $em = $this->getDoctrine()->getManager();
        $serieRepository = $em->getRepository(Serie::class);
        $series = $serieRepository->findBy(['seance' => $seance],['exercice' => 'ASC']);

        return $this->render('Serie/read.html.twig', [
            'series' => $series,
            'seance' => $seance
        ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id":"\d+"})
     */
    public function update(Request $request, Serie $serie)
    {
        $form = $this
            ->createForm( SerieType::class, $serie);

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($serie);

            $this->addFlash('success','La série a été modifiée.');

            return $this->redirectToRoute('app_serie_read', [
                'id' => $serie->getSeance()->getId(),
            ]);
        }

        return $this->render( 'Serie/create.html.twig', [
            'serieForm' => $form->createView(),
            'serie' => $serie
        ]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id":"\d+"})
     */
    public function delete(Request $request, Serie $serie)
    {
        $token = $request->query->get('token');

        $id = $serie->getSeance()->getId();

        if(!$this->isCsrfTokenValid('SERIE_DELETE', $token)){
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($serie);
        $em->flush();

        return $this->redirectToRoute('app_serie_read', [
            'id' => $id
        ]);
    }
}