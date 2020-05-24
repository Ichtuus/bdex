<?php

namespace App\AdminBundle\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{

    public function editUserData(User $data): JsonResponse
    {
        return $this->json(["data" => $data]);
    }
}