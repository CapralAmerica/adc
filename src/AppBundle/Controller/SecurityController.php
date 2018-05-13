<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    /**
     * @Route("/create/user", name="create_user", methods={"POST"})
     */
    public function createUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $user = new User();

        $role = 'ROLE_USER';

        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        if ($request->request->get('email')) $user->setEmail($request->request->get('email'));
        $user->setMobile($request->request->get('mobile'));
        $user->setPassword(password_hash($request->request->get('password'), PASSWORD_BCRYPT));
        $user->setCreatedAt($date);

        if (!$request->request->get('role')) {
            $user->setRole($role);
        } else {
            $user->setRole($request->request->get('role'));
        }

        $em->persist($user);
        $em->flush();

        if (!$request->getSession()) {
            $session = new Session();
            $session->start();

            $session->set('firstName', $request->request->get('firstName'));
            $session->set('lastName', $request->request->get('lastName'));
            $session->set('role', $role);
            $session->set('password', $request->request->get('password'));
        }

        return $this->redirect('/');
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        $username = $request->request->get('mobile');


        $em = $this->getDoctrine()->getManager();

        $sql = 'SELECT * FROM user u WHERE u.mobile = :username';

        $statement = $em->getConnection()->prepare($sql);
        $statement->bindValue('username', $username);

        $statement->execute();

        $result = $statement->fetchAll();

        if ($result && password_verify($request->request->get('password'),
                $result[0]['password']) === true) {
            $session = new Session();
            $session->start();

            $session->set('firstName', $result[0]['firstName']);
            $session->set('lastName', $result[0]['lastName']);
            $session->set('role', $result[0]['role']);
            $session->set('id', $result[0]['id']);
            return $this->redirect('/');
        }

        return new JsonResponse('');

    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logoutAction(Request $request)
    {

//        $session = $this->get('session');
//        $ses_vars = $session->all();
//        foreach ($ses_vars as $key => $value) {
//            $session->remove($key);
//        }
        $request->getSession()->invalidate(1);


        return $this->redirect('/');
    }


}
