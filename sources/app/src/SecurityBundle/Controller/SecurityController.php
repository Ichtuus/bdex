<?php

namespace App\SecurityBundle\Controller;

use App\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class SecurityController extends AbstractController
{

    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/login", name="login")
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        try {
            $user = $this->getUser();
            $userClone = clone $user;
            $userClone->setPassword('');
            $data = $this->serializer->serialize($userClone, JsonEncoder::FORMAT);
            return new JsonResponse($data, Response::HTTP_OK, [], true);
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
        return new JsonResponse([]);
    }

    /**
     * @Route("/logout", name="logout")
     * @throws \Exception
     */
    public function logout()
    {
//        return $this->redirectToRoute('home');
        throw new \Exception('should not be reached');
    }

}