<?php

namespace Acme\BlogBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 
class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeBlogBundle:Admin:index.html.twig');
    }
}