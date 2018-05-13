<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/users/edit/{id}", name="user_edit", methods={"POST"})
     */
    public function userEditAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle\Entity\User')->find($id);

        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $mobile = $request->request->get('mobile');
        $email = $request->request->get('email');
        if ($request->request->get('password')) {
            $password = (password_hash($request->request->get('password'), PASSWORD_BCRYPT));
        } else {
            $password = $user->getPassword();
        }

        $update = $em->getRepository('AppBundle\Entity\User')->updateUser(
            $id,
            $firstName,
            $lastName,
            $mobile,
            $password,
            $email
        );

        return $this->redirect('/admin/users');
    }

    /**
     * @Route("/users/delete/{id}", name="user_delete")
     */
    public function userDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle\Entity\User')->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirect('/admin/users');
    }
}
