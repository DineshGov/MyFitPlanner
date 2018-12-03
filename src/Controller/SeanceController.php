<?php

namespace App\Controller;
use App\Entity\Seance;
use App\Form\Type\SeanceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seance")
 */
class SeanceController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function create(Request $request){
        $seance = new Seance();

        $user = $this->getUser();
        $seance->setUser($user);

        $form = $this
            ->createForm(SeanceType::class, $seance);
        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($seance);
            $em->flush($seance);

            $this->addFlash('success','Seance ajoutée.');

            return $this->redirectToRoute('app_seance_read');
        }

        return $this->render('Seance/create.html.twig', ['seanceForm' => $form->createView()
        ]);
    }

    /**
     * @Route()
     */
    public function read(Request $request){
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $seanceRepository = $em->getRepository(Seance::class);
        $seances = $seanceRepository->findBy(['user' => $this->getUser()], ['date' => 'ASC']);

        return $this->render("Seance/read.html.twig", [
            'seances' => $seances
            ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id":"\d+"})
     */
    public function update(Request $request, Seance $seance){
        $form = $this
            ->createForm( SeanceType::class, $seance);

        $loggedUser = $this->getUser();
        $user = $seance->getUser();

        if($loggedUser->getId() !== $user->getId()){
            throw $this->createAccessDeniedException();
        }

        $form->HandleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush($seance);

            $this->addFlash('success','La séance a été modifiée.');

            return $this->redirectToRoute('app_seance_read');
        }

        return $this->render( 'Seance/create.html.twig', [
            'seanceForm' => $form->createView(),
            'seance' => $seance
        ]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id":"\d+"})
     */
    public function delete(Request $request, Seance $seance)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('SEANCE_DELETE', $token)){
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($seance);
        $em->flush();

        return $this->redirectToRoute('app_seance_read');
    }

}