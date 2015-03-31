<?php

// src/Esedjo/PlatformBundle/Controller/AdvertController.php

namespace Esedjo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('EsedjoPlatformBundle:Advert:index.html.twig');
        return new Response($content);
    }
}
