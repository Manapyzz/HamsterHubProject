<?php

namespace VideoBundle\Controller;

use EntityBundle\Entity\Video;
use VideoBundle\Form\Type\VideoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Tests\Fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    /**
     * @Route("/delete")
     */

    public function deleteAction(Request $info){
        $id = $info->get("id");
        $em = $this->getDoctrine()->getManager();
        $delete = $em->find('EntityBundle:Video', $id);
        $em->remove($delete);
        $em->flush();
        $jsondelete = json_encode(Array("id"=>$id));
        return new Response($jsondelete);
    }
}