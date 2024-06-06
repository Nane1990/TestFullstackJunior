<?php
// src/Validator/Constraints/EmailDomainValidator.php namespace App\Validator\Constraints; 
use Symfony\Component\Validator\Constraint; 
use Symfony\Component\Validator\ConstraintValidator; 

class EmailDomainValidator extends ConstraintValidator { 

	public function validate($value, Constraint $constraint) { 
		if (!$constraint instanceof EmailDomain) { 
			throw new \InvalidArgumentException(sprintf( 'The constraint must be an instance of "%s".', EmailDomain::class )); 
			}
		if (!$value) {
			return;
		}

		$email = explode('@', $value);
		$domain = $email[1];

		if (strtolower($domain) === 'example.com') {
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ domain }}', $domain)
				->addViolation();
		}
	}
}
