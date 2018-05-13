<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PagesController extends Controller
{

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function indexAction()
    {
        return new JsonResponse('Hello');
    }

    /**
     * @Route("/sign_in", name="sign_in", methods={"GET"})
     */
    public function signInAction()
    {
        return $this->render('/pages/security/sign_in.html.twig');
    }


    /**
     * @Route("/sign_up", name="sign_up", methods={"GET"})
     */
    public function signUpAction()
    {
        return $this->render('/pages/security/sign_up.html.twig');
    }

}
