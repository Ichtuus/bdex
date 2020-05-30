<?php

namespace App\AdminBundle\Builder;

use App\Entity\User;

class UserDirector
{
    /**
     * @param      $data
     *
     * @param User $user
     *
     * @return User
     */
    public function buildUser($data, User $user)
    {
        if($user->getUsername()){
            $user->setUsername($data->username);
        }

        if($user->getAdress()){
            $user->setAdress($data->adress);
        }

        if($user->getEmail()){
            $user->setEmail($data->email);
        }

        if($user->getImage()){
            $user->setImage($data->image);
        }

        if($user->getBirthday()){
            $user->setBirthday($data->birthday);
        }

        return $user;
    }
}