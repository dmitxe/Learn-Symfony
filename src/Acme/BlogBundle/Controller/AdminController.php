<?php

namespace Acme\BlogBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 
class AdminController extends Controller
{
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository('AcmeBlogBundle:User')->find(1);
        
        ld($this->get('security.context')->getToken());
        
        return $this->render('AcmeBlogBundle:Admin:index.html.twig');
    }
}