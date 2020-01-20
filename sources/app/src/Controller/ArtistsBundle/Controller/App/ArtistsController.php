<?php

namespace App\Controller\ArtistsBundle\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArtistsController extends AbstractController
{

    /**
     * @Route("/artists", name="artists_list", options={"expose": true})
     *
     */
    public function listAction() {
        return $this->render('artists/list.html.twig');
    }

    /**
     * @Route("/artists/all", name="artists_get_list", options={"expose": true})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getListArtists(Request $request) {

        $data = $request->getContent();
        $data = json_decode($data, true);

        return $this->json($data);
    }
}