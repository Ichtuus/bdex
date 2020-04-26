<?php

namespace App\GroupsBundle\Controller;

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
use App\Entity\Group;

class GroupsController extends AbstractController
{
    private $group, $pages, $url;

    /**
     * @Route("/groups", name="groups_list", options={"expose": true})
     *
     */
    public function listAction()
    {
        return $this->render('groups/list.html.twig');
    }

    public function call()
    {
        $client = HttpClient::create();
        try {
            $content = $client->request(
                'GET',
                $this->url = 'https://bboyrankingz.com/ranking/groups/2020/elo.json'
            )->toArray();
            $nbOfGroupsInPage = ceil($content['count'] / 10);
            if ($content) {
                $request = [];
                $groupExtract = [];
                if (empty($groupExtract)) {
                    $nbOfPages = 0;
                    for ($i = 0; $i < $nbOfGroupsInPage; $i++) {
                        $nbOfPages += 1;
                        $request[$i] = $client->request(
                            'GET',
                            $this->url = 'https://bboyrankingz.com/ranking/groups/2020/elo.json?page=' . $nbOfPages
                        )->toArray();
                        array_merge((array)array_push($groupExtract, $request[$i]['results']));
                    }
                }

                return [
                    'crew' => $groupExtract,
                ];
            } else {
                return $this->json([
                    'error' => 'No datas found',
                ]);
            }
        } catch (ClientExceptionInterface $e) {
            return $this->json([
                'error' => $e,
            ]);
        } catch (RedirectionExceptionInterface $e) {
            return $this->json([
                'error' => $e,
            ]);
        } catch (ServerExceptionInterface $e) {
            return $this->json([
                'error' => $e,
            ]);
        } catch (TransportExceptionInterface $e) {
            return $this->json([
                'error' => $e,
            ]);
        } catch (DecodingExceptionInterface $e) {
            return $this->json([
                'error' => $e,
            ]);
        }
    }

    /**
     * @Route("/groups/get", name="groups_get_datas", options={"expose": true})
     */
    public function getAll()
    {
        $em = $this->getDoctrine()->getManager();
        $outputGroups = $this->getDatasGroups();
        foreach ($outputGroups as $outputGroup) {
            foreach ($outputGroup as $group) {
                $Group = new Group();
                if (count($group)) {
                    if (isset($group['title'])) {
                        $Group->setTitle($group['title']);
                    }
                    if (isset($group['country'])) {
                        $Group->setCountry($group['country']);
                    }
                    if (isset($group['thumbnail'])) {
                        $Group->setThumb($group['thumbnail']);
                    }
                    $Group->setDateAdd(new DateTime());
//                    $em->detach();
                    $em->persist($Group);
                    $em->flush();
                }
            }
        }

        return $this->json([
            'crew' => $this->getDatasGroups(),
        ]);
    }

    public function getDatasGroups()
    {
        try {
            $apiContent = (array)$this->call();
        } catch (RequestException $e) {
            return 'error';
        }

        return $this->group = $apiContent['crew'];
    }
}