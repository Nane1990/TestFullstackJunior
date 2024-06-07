<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; use Symfony\Component\HttpFoundation\Response; use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController {
	
	/** * @Route("/hello/{name}", name="hello") */
	public function hello($name) {
		return new Response('¡Hola, ' . $name . '!'); 
	}
	
    /** * @Route("/hello/{name}", name="hello") */ 
	public function hello($name = "World") { 
	    return new Response('¡Hola, ' . $name . '!');
	}		
}

