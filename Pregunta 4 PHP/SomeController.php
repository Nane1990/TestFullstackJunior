<?php

namespace App\Controller;

use App\Service\MathService; use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; use Symfony\Component\HttpFoundation\Response;

class SomeController extends AbstractController { 

   private $mathService;
   public function __construct(MathService $mathService)
   {
       $this->mathService = $mathService;
   }

   public function someAction()
   {
       $result = $this->mathService->sum(5, 3);

       return new Response('The sum is: ' . $result);
   }

}


/ src/Entity/User.php namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity()

    @ORM\Table(name="users") / class User { /*
        @ORM\Id()
        @ORM\GeneratedValue()
        @ORM\Column(type="integer") */ private $id;

    /**
        @ORM\Column(type="string", length=255) */ private $username;

    /**
        @ORM\Column(type="string", length=255) */ private $email;

    // getters y setters para $username y $email public function getId(): ?int { return $this->id; }

    public function getUsername(): ?string { 
	   return $this->username; 
	}

    public function setUsername(string $username): self {
		$this->username = $username;
		return $this;

    }

    public function getEmail(): ?string { 
        return $this->email; 
	}

    public function setEmail(string $email): self { 
        $this->email = $email;
	    return $this;
	} 
