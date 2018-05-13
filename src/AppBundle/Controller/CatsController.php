<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cat;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CatsController extends Controller
{
    /**
     * @Route("/cats/list", name="cats_list", methods={"GET"})
     */
    public function catsListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AppBundle\Entity\Cat');

        $cats = $repository->findAll();

        return $this->render('/pages/cats_list.html.twig', array('cats' => $cats));
    }

    /**
     * @Route("/cats/info/{id}", name="cats_info", methods={"GET"})
     */
    public function catInfoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository('AppBundle\Entity\Cat')->find($id);

        return $this->render('/pages/cat_info.html.twig', array('cat' => $cat));
    }

    /**
     * @Route("/cats/add", name="cat_add_page", methods={"GET"})
     */
    public function catAddPageAction()
    {
        return $this->render('/pages/cat_add.html.twig');
    }

    /**
     * @Route("/cats/add", name="cats_add", methods={"POST"})
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

        return $this->redirect('/cats/list');
    }

    /**
     * @Route("/cats/edit/{id}", name="cats_edit", methods={"POST"})
     */
    public function catEditAction($id, Request $request)
    {
        $name = $request->request->get('name');
        $age = $request->request->get('age');
        $weight = $request->request->get('weight');
        $colour = $request->request->get('colour');
        $guardianMobile = $request->request->get('guardianMobile');
        $notes = $request->request->get('notes');
        $isSterilized = $request->request->get('isSterilized');
        $gpsLong = $request->request->get('gpsLong');
        $gpsLat = $request->request->get('gpsLat');

        $em = $this->getDoctrine()->getManager();

        $update = $em->getRepository('AppBundle\Entity\Cat')->updateCat(
           $id, $name, $age, $colour, $weight, $guardianMobile, $gpsLong, $gpsLat, $notes, $isSterilized
        );

        return $this->redirect('/admin/cats');
    }


    /**
     * @Route("/cats/delete/{id}", name="cats_delete")
     */
    public function catDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('AppBundle\Entity\Cat');

        $cat = $repository->find($id);
        $em->remove($cat);

        $em->flush();

        return $this->redirect('/admin/cats');
    }


}
