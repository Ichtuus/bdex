<?php

namespace App\Controller\ArtistsBundle\Controller\App;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtistsController extends AbstractController
{

    /**
     * @Route("/artists", name="artists_list", options={"expose": true})
     *
     */
    public function listAction(

    ) {
        return $this->render('artists/list.html.twig');
    }

}