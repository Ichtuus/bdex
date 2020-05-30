<?php

namespace App\AdminBundle\Api\Controller;


use App\AdminBundle\Builder\UserDirector;
use App\AdminBundle\Form\Type\UserType;
use App\AdminBundle\Services\Serializer\Form\ErrorSerializer;
use App\AdminBundle\Repository\UserRepository;
use App\AdminBundle\Services\Serializer\UserArraySerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private UserArraySerializer $userArraySerializer;

    private UserRepository $userRepository;

    private UserDirector $userDirector;

    private EntityManagerInterface $entityManager;

    private ErrorSerializer $errorSerializer;

    /**
     * UserController constructor.
     *
     * @param UserArraySerializer    $userArraySerializer
     * @param UserRepository         $userRepository
     * @param UserDirector           $userDirector
     * @param EntityManagerInterface $entityManager
     * @param ErrorSerializer        $errorSerializer
     */
    public function __construct(
        UserArraySerializer $userArraySerializer,
        UserRepository $userRepository,
        UserDirector $userDirector,
        EntityManagerInterface $entityManager,
        ErrorSerializer $errorSerializer
    ) {
        $this->userArraySerializer = $userArraySerializer;
        $this->userRepository = $userRepository;
        $this->userDirector = $userDirector;
        $this->entityManager = $entityManager;
        $this->errorSerializer = $errorSerializer;
    }

    /**
     * @Route(
     *     "/api/user/{id}/edit",
     *     methods={"PATCH"},
     *     options={"expose"=true},
     *     name="user_patch"
     * )
     * @param Request $request
     * @param         $id
     *
     * @return JsonResponse
     */
    public function patchUser(Request $request, $id)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );

        $user = $this->userRepository->findOneBy(["id" => $id]);
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data, false);
//dump($user); die();
        if (false === $form->isValid()) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'errors' => $this->errorSerializer->convertFormToArray($form)
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $this->entityManager->flush();

        return $this->json([
            'data' => $this->userArraySerializer->toArray($user)
        ]);
    }
}