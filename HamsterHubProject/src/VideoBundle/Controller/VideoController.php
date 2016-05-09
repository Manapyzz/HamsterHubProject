<?php

namespace VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VideoController extends Controller {
    
    public function showAction($video_Id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('EntityBundle:Video')
            ->findOneByYoutubeId($video_Id);

        $videoPage['url'] = $video->getLink();
        $videoPage['title'] = $video->getName();
        $videoPage['description'] = $video->getDescription();
        $videoPage['authorName'] = $video->getUser()->getUserName();

        return $this->render('VideoBundle:Video:show_video.html.twig', array(
            'videoPage' => $videoPage
        ));
    }
}