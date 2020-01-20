<?php

namespace App\Controller\Crawler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class DatasCrawlerController extends AbstractController
{
//    /**
//     * @Route("/links", name="crawler")
//     */
//    public function crawlerAction()
//    {
//        $url = "https://bboyrankingz.com/bboys/";
//        $client = new Client();
//        $crawler = $client->request('GET', $url);
//        $links_count = $crawler->filter('body')->nextAll();;
//        $all_links = [];
//        if($links_count){
//            $datas = $crawler->filter('body')->nextAll();
//            echo '<pre>'; print_r''
//        }
////        if ($links_count > 0) {
////            $links = $crawler->filter('a')->links();
////            foreach ($links as $link) {
////                $all_links[] = $link->getURI();
////            }
////            $all_links = array_unique($all_links);
////            echo "All Avialble Links From this page $url Page<pre>";
////            print_r($all_links);
////            echo "</pre>";
////        } else {
////            echo "No Links Found";
////        }
//        die;
//    }
}