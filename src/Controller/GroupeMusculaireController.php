<?php

namespace App\Controller;

use App\Entity\GroupeMusculaire;
use App\Form\Type\GroupeMusculaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/groupemusculaire")
 */
class GroupeMusculaireController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function create(Request $request){
        $groupeMusculaire = new GroupeMusculaire();

        $form = $this
            ->createForm(GroupeMusculaireType::class, $groupeMusculaire);

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupeMusculaire);
            $em->flush($groupeMusculaire);

            $this->addFlash('success','Le nouveau groupe musculaire a bien été ajouté.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render('GroupeMusculaire/create.html.twig', ['groupeMusculaireForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id":"\d+"})
     */
    public function update(Request $request, GroupeMusculaire $groupeMusculaire)
    {
        $form = $this
            ->createForm( GroupeMusculaireType::class, $groupeMusculaire);

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($groupeMusculaire);

            $this->addFlash('success','Le groupe musculaire a été modifié.');

            return $this->redirectToRoute('app_admin_read');
        }

        return $this->render( 'GroupeMusculaire/create.html.twig', [
            'groupeMusculaireForm' => $form->createView(),
            'groupeMusculaire' => $groupeMusculaire
        ]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id":"\d+"})
     */
    public function delete(Request $request, GroupeMusculaire $groupeMusculaire)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('GROUPEMUSCULAIRE_DELETE', $token)){
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($groupeMusculaire);
        $em->flush();

        return $this->redirectToRoute('app_admin_read');
    }
}