<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/inscription", methods={"GET", "POST"})
     */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder){

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_navigation_home');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $rawPassword = $user->getRawPassword();
            $encoded = $encoder->encodePassword($user, $rawPassword);
            $user->setPassword($encoded);
            $user->setIsAdmin(0);
            $user->eraseCredentials();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue, vous pouvez désormais vous connecter.');
            return $this->redirectToRoute('app_user_signin');
        }

        return $this->render(
            'User/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/connexion", methods={"GET", "POST"})
     */
    public function signin(AuthenticationUtils $utils){

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_navigation_home');
        }

        return $this->render('user/login.html.twig', [
            'error' => $utils->getLastAuthenticationError(),
            'last_username' => $utils->getLastUsername(),
        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logout(){}


}