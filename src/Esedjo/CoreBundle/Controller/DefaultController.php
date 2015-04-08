<?php

namespace Esedjo\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EsedjoCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
