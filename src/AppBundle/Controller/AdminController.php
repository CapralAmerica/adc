<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin", methods={"GET"})
     */
    public function adminIndexAction(Request $request)
    {
        $role = $request->getSession()->get('role');

        if ($role == "ROLE_ADMIN") {
            return $this->render('/admin/admin.html.twig');
        } else if ($role == "ROLE_MODERATOR") {
            return $this->render('/admin/admin.html.twig');
        } else {
            return $this->redirect('/');
        }
    }

    /**
     * @Route("/admin/cats", name="admin_cats", methods={"GET"})
     */
    public function adminCatsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AppBundle\Entity\Cat');

        $cats = $repository->findAll();

        return $this->render('/admin/admin_cats.html.twig', array('cats' => $cats));
    }

    /**
     * @Route("/admin/cats/add", name="admin_cats_add", methods={"GET"})
     */
    public function adminCatsAddAction()
    {
        return $this->render('/admin/admin_cats_add.html.twig');
    }

    /**
     * @Route("/admin/users", name="admin_users", methods={"GET"})
     */
    public function adminUsersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AppBundle\Entity\User');

        $users = $repository->findAll();

        return $this->render('/admin/admin_users.html.twig', array('users' => $users));
    }


    /**
     * @Route("/admin/cats/info/{id}", name="admin_cats_info", methods={"GET"})
     */
    public function adminCatInfoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository('AppBundle\Entity\Cat')->find($id);

        return $this->render('admin/admin_cat_info.html.twig', array('cat' => $cat));
    }

    /**
     * @Route("/admin/cats/edit/{id}", name="admin_cats_edit", methods={"GET"})
     */
    public function adminCatEditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository('AppBundle\Entity\Cat')->find($id);

        return $this->render('/admin/admin_cat_edit.html.twig', array('cat' => $cat));
    }

    /**
     * @Route("/admin/users/add", name="admin_user_add", methods={"GET"})
     */
    public function adminUserAddAction()
    {
        return $this->render('/admin/admin_user_add.html.twig');
    }

    /**
     * @Route("/admin/user/edit/{id}", name="admin_user_edit", methods={"GET"})
     */
    public function adminUserEditAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle\Entity\User')->find($id);

        return $this->render('/admin/admin_user_edit.html.twig', array('user' => $user));
    }

    /**
     * @Route("admin/cats/add", name="admin_cats_add")
     */
    public function catAddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $date = new \DateTime();

        $file = $request->files->get('photo');

        $file->move(__DIR__ . '/../../../web/photo/', $file->getClientOriginalName());

        $base_url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        $cat = new Cat();

        $cat->setName($request->request->get('name'));
        $cat->setAge($request->request->get('age'));
        $cat->setColour($request->request->get('colour'));
        $cat->setIsSterilized($request->request->get('isSterilized'));
        $cat->setNotes($request->request->get('notes'));
        $cat->setWeight($request->request->get('weight'));
        $cat->setGuardianMobile($request->request->get('guardian_mobile'));
        $cat->setPhoto($base_url.'/photo/'.$file->getClientOriginalName());

        if ($request->request->get('gps_lat') && $request->request->get('gps_long')) {
            $cat->setGpsLat($request->request->get('gps_lat'));
            $cat->setGpsLong($request->request->get('gps_long'));
        }
        $cat->setAddedAt($date);

        $em->persist($cat);
        $em->flush();

        return $this->redirect('/admin/cats');
    }
}
