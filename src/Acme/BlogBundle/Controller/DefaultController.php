<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     *
     * @param type $name
     * @Template
     * @return type 
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     *
     * @return Response 
     */
    public function createAction() {
        $post = new Post();
        $post->setTitle('Demo Blog');
        $post->setBody('Hello Symfony 2');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Created product id ' . $post->getId());
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AcmeBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Страница не найдена!');
        }
        
//        return array('post' => $post);
        $response = $this->render('AcmeBlogBundle:Default:show.html.twig', array('post' => $post));
        return $response;
//        return new Response($html);
    }    
}
