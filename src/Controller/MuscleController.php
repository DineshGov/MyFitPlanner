<?php

namespace App\Controller;

use App\Entity\Muscle;
use App\Form\Type\MuscleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/muscle")
 */
class MuscleController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function create(Request $request){
        $muscle = new Muscle();

        $form = $this
            ->createForm(MuscleType::class, $muscle);
        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($muscle);
            $em->flush($muscle);

            $this->addFlash('success','Le nouveau muscle a bien été ajouté.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render('Muscle/create.html.twig', ['muscleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id":"\d+"})
     */
    public function update(Request $request, Muscle $muscle)
    {
        $form = $this
            ->createForm( MuscleType::class, $muscle);

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($muscle);

            $this->addFlash('success','Le muscle a été modifié.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render( 'Muscle/create.html.twig', [
            'muscleForm' => $form->createView(),
            'muscle' => $muscle
        ]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id":"\d+"})
     */
    public function delete(Request $request, Muscle $muscle)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('MUSCLE_DELETE', $token)){
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($muscle);
        $em->flush();

        return $this->redirectToRoute('app_admin_read');
    }
}
