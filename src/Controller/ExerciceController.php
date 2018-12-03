<?php

namespace App\Controller;
use App\Entity\Exercice;
use App\Form\Type\ExerciceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/exercice")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function create(Request $request){
        $exercice = new Exercice();

        $form = $this
            ->createForm(ExerciceType::class, $exercice);
        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($exercice);
            $em->flush($exercice);

            $this->addFlash('success','Le nouvel exercice a bien été ajouté.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render('Exercice/create.html.twig', ['exerciceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id":"\d+"})
     */
    public function update(Request $request, Exercice $exercice)
    {
        $form = $this
            ->createForm( ExerciceType::class, $exercice);

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($exercice);

            $this->addFlash('success','L\'exercice a été modifié.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render( 'Exercice/create.html.twig', [
            'exerciceForm' => $form->createView(),
            'exercice' => $exercice
        ]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id":"\d+"})
     */
    public function delete(Request $request, Exercice $exercice)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('EXERCICE_DELETE', $token)){
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($exercice);
        $em->flush();

        return $this->redirectToRoute('app_admin_read');
    }

}