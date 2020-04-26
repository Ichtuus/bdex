<?php

namespace App\ArtistsBundle\Controller;

use DateTime;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

use App\Entity\Artists;

class ArtistsController extends AbstractController
{

    private $bboy, $countries, $years, $pages, $url;

    /**
     * @Route("/artists", name="artists", options={"expose": true})
     *
     */
    public function listAction() {
        return $this->render('artists/list.html.twig');
    }

    public function call()
    {
        $client = HttpClient::create();
        try {
            $content = $client->request(
                'GET',
                $this->url = 'https://bboyrankingz.com/ranking/artists/2020/elo.json'
            )->toArray();
            $nbOfArtistsInPage = ceil($content['count'] / 10);
            if ($content) {
                $request = [];
                $bboyExtract = [];
                $countriesExtract = [];
                $yearsExtract = [];

                if (empty($bboyExtract)) {
                    $nbOfPages = 0;
                    for ($i = 0; $i < $nbOfArtistsInPage; $i++) {
                        $nbOfPages += 1;
                        $request[$i] = $client->request(
                            'GET',
                            $this->url = 'https://bboyrankingz.com/ranking/artists/2020/elo.json?page='.$nbOfPages
                        )->toArray();

                        array_merge((array)array_push($bboyExtract, $request[$i]['results']));
                    }

                }

                if(empty($countriesExtract) && empty($yearsExtract)) {
                    $request = $client->request(
                        'GET',
                        $this->url = 'https://bboyrankingz.com/ranking/artists/2020/elo.json'
                    )->toArray();
                    $countriesExtract = $request['countries'];
                    $yearsExtract = $request['year'];
                }
                return [
                    'bboy' => $bboyExtract,
                    'countries' => $countriesExtract,
                    'year' =>$yearsExtract
                ];
            } else {
                return $this->json([
                    'error' => 'No datas found'
                ]);
            }
        } catch (ClientExceptionInterface $e) {
            return $this->json([
                'error' => $e
            ]);
        } catch (RedirectionExceptionInterface $e) {
            return $this->json([
                'error' => $e
            ]);
        } catch (ServerExceptionInterface $e) {
            return $this->json([
                'error' => $e
            ]);
        } catch (TransportExceptionInterface $e) {
            return $this->json([
                'error' => $e
            ]);
        } catch (DecodingExceptionInterface $e) {
            return $this->json([
                'error' => $e
            ]);
        }
    }

    /**
     * @Route("/artists/get", name="artists_get_datas", options={"expose": true})
     */
    public function getAll()
    {
        $em = $this->getDoctrine()->getManager();
        $outputArtists = $this->getDatasArtists();

        foreach ($outputArtists as $outputArtist) {
            foreach ($outputArtist as $bboy) {
                if (count($bboy)) {
                    $Artists = new Artists();
                    if (isset($bboy['title'])) {
                        $Artists->setArtistsName($bboy['title']);
                    }
                    if (isset($bboy['country'])) {
                        $Artists->setCountry($bboy['country']);
                    }
                    if (isset($bboy['thumbnail'])) {
                        $Artists->setThumb($bboy['thumbnail']);
                    }
                    $Artists->setDateAdd(new DateTime());
                    $em->persist($Artists);
                    $em->flush();
                }
            }
        }


        return $this->json([
            'bboy' => $this->getDatasArtists(),
            'countries' => $this->getCountriesArtists(),
            'years' => $this->getYearsArtists()
        ]);
    }

    public function getDatasArtists()
    {
        try {
            $apiContent = (array) $this->call();
        } catch (RequestException $e) {
            return 'error';
        }
        return $this->bboy = $apiContent['bboy'];
    }

    public function getCountriesArtists()
    {
        try {
            $apiContent = (array) $this->call();
        } catch (RequestException $e) {
            return 'error';
        }
        return $this->countries = $apiContent['countries'];
    }

    public function getYearsArtists()
    {
        try {
            $apiContent = (array) $this->call();
        } catch (RequestException $e) {
            return 'error';
        }
        return $this->years = $apiContent['year'];
    }

}