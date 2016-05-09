<?php

namespace VideoBundle\Controller;

use EntityBundle\Entity\Video;
use VideoBundle\Form\Type\VideoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    /**
     * @Route("/upload", name="user_link_upload")
     */
    public function uploadAction(Request $request)
    {
        // 1) build the form
        $video = new Video();
        $video->setUser($this->getUser());
        $form = $this->createForm(VideoType::class, $video);
        
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $videoUrl = $video->getLink();
            $embedUrl = explode("watch?v=", $videoUrl);
            $videoEmbed = $embedUrl[0] . 'embed/' . $embedUrl[1];
            $partUrl = explode('=', $videoUrl);
            $youtube_id = $partUrl[1];
            $video->setYoutubeId($youtube_id);
            $video->setLink($videoEmbed);
            $video->setPreviewImage('http://img.youtube.com/vi/'.$youtube_id.'/0.jpg');
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
        }

        return $this->render(
            'VideoBundle:Upload:upload.html.twig',
            array('form' => $form->createView()));
    }
}