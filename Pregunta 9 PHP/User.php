<?php
// src/Entity/User.php
namespace App\Entity;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;
class User
{
    // ...

    /**
     * @Assert\Email()
     * @CustomAssert\EmailDomain()
     */
    private $email;

    // ...
}