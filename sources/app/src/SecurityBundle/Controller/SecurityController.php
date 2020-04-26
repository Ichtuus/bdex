<?php

namespace App\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Security $security, Request $request)
    {
         $user = $security->getUser();

         if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
             return $this->json([
                 'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
             ], 400);
         }

         return $this->json([
             'userid' => $user ? $user->getId() : null,
             'username' => $user ? $user->getUsername() : null
         ]);
//        $user = $this->getUser();
//        return $this->json([
//            'result' => true,
//            'username' => $user->getUsername(),
//        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('should not be reached');
    }
}