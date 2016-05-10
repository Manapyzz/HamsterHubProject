<?php

namespace UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction($usernameUrl)
    {
        $userLoggedIn = $this->getUser()->getId();

        $userProfile = $this->getDoctrine()->getManager()
            ->getRepository('EntityBundle:User')
            ->findOneByUsername($usernameUrl);

        $profile['id'] = $userProfile->getId();

        if($usernameUrl == strtolower($userProfile->getUserName())) {
            $profile['username'] = $userProfile->getUserName();
            $profile['email'] = $userProfile->getEmail();
            $profile['lastname'] = $userProfile->getLastname();
            $profile['firstname'] = $userProfile->getFirstname();
            $profile['imageProfile'] = $userProfile->getImageFile();

            $explodeUrl = explode('web/', $profile['imageProfile']);
            $imageUrl = $explodeUrl[1];

            $em = $this->getDoctrine()->getManager();
            $userProfileVideos = $em->getRepository('EntityBundle:Video')
                ->findBy(array('user' => $userProfile));

            $videos = [];
            $error = '';
            if(isset($videos)){
                for ($i = 0; $i < count($userProfileVideos); $i++) {
                    $video['name'] = $userProfileVideos[$i]->getName();
                    $video['preview'] = $userProfileVideos[$i]->getPreviewImage();
                    $video['youtubeId'] = $userProfileVideos[$i]->getYoutubeId();
                    $video['id'] = $userProfileVideos[$i]->getId();
                    $videos[] = $video;
                } ;
                if(count($videos) === 0){
                    $error = 'This User has no videos';
                };
            }

            return $this->render('FOSUserBundle:Profile:show_content.html.twig', array(
                'videos' => $videos, 'profile' => $profile, 'userLogged' => $userLoggedIn, 'imageUrl' => $imageUrl, 'errors' => $error
            ));
        }
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
    
        if ($form->isValid()) {

            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $response = new RedirectResponse('/');
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}