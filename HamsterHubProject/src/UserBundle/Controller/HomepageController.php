<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EntityBundle\Repository\VideoRepository;


class HomepageController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('EntityBundle:Video')
            ->findAll();
        for($i = 0; $i < count($videos); $i++){
            $arrayVideo['url'] = $videos[$i]->getLink();
            $arrayVideo['username'] = $videos[$i]->getUser()->getUserName();
            $arrayVideo['preview'] = $videos[$i]->getPreviewImage();
            $arrayVideo['youtubeId'] = $videos[$i]->getYoutubeId();
            $usersVideo[] = $arrayVideo;
        }
        return $this->render(
            'UserBundle:Homepage:homepage.html.twig',
            array('videos' => $usersVideo));
    }
}
