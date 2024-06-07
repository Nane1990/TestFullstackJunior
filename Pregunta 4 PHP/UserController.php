<?php   
	
// src/Controller/UserController.php namespace App\Controller;

use App\Entity\User; 
use App\Form\UserType; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController { 
/** * @Route("/user/new", name="user_new") */ 
    public function newUser(Request $request): Response { 
	// crea una nueva instancia de User $user = new User();
    // crea el formulario
	
		$form = $this->createForm(UserType::class, $user);

		// maneja la solicitud
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// guarda el nuevo usuario, por ejemplo:
			// $entityManager = $this->getDoctrine()->getManager();
			// $entityManager->persist($user);
			// $entityManager->flush();

			return $this->redirectToRoute('user_success');
		}

    // renderiza el formulario en la plantilla twig
    return $this->render('user/new.html.twig', [
        'form' => $form->createView(),
    ]);
    }
}