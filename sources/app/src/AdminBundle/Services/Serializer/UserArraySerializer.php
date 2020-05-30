<?php

namespace App\AdminBundle\Services\Serializer;

use App\Entity\User;

class UserArraySerializer
{
    /**
     * @param User $user
     *
     * @return array
     */
    public function toArray(User $user)
    {
        return $result = [
            'id'                => $user->getId(),
            'username'          => $user->getUsername(),
            'email'             => $user->getEmail(),
            'adress'            => $user->getAdress(),
            'birthday'          => $user->getBirthday(),
            'image'             => $user->getImage(),
        ];
    }
}