<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;

class Rollno
{    
/**
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     */
    public ?int $rollno = null;
 }
