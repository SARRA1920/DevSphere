<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
abstract class AbstractAdminController extends AbstractController
{
    public function __construct()
    {
        // This constructor ensures that all admin controllers require ROLE_ADMIN
    }
}
