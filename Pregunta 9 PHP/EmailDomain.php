<?php
// src/Validator/Constraints/EmailDomain.php

namespace App\Validator\Constraints; 
use Symfony\Component\Validator\Constraint; 
/**
   @Annotation */ class EmailDomain extends Constraint { 
   public $message = 'El dominio "{{ domain }}" no está permitido.'; }
