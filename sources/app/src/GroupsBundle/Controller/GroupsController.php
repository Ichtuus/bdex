<?php

namespace App\GroupsBundle\Controller;

use DateTime;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use GuzzleHttp\Exception\RequestException;
use PDOException;
use Exception;
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
    private $group, $pages, $url, $em;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

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
        $outputGroups = $this->getDatasGroups();

        foreach ($outputGroups as $outputGroup) {
           $insert = array_map(function($group){
               $Group = new Group();
               $Group->setGroupName($group['title']);
               $Group->setCountry($group['country']);
               $Group->setThumb($group['thumbnail']);
               $Group->setDateAdd(new DateTime());
               $this->em->persist($Group);
               $this->em->flush();
            }, $outputGroup);
        }
//        return $this->json([
//            'crew' => $this->getDatasGroups(),
//        ]);
    }

    public function getDatasGroups()
    {
        try {
            $apiContent = (array) $this->call();
        } catch (RequestException $e) {
            return 'error';
        }

        return $this->group = $apiContent['crew'];
    }

    protected function createNewEntityManager() {

        return $this->em->create(
            $this->em->getConnection(),
            $this->em->getConfiguration(),
            $this->em->getEventManager()
        );
    }
}