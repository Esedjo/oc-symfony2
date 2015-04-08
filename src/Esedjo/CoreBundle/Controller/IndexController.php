<?php

namespace Esedjo\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function IndexAction()
    {
        return $this->render('EsedjoCoreBundle:Index:index.html.twig', array(
            ));    }

    public function ContactAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()
                ->add('notice', ' : La page de contact n\'est pas encore disponible, merci de revenir plus tard.');

        return $this->render('EsedjoCoreBundle:Index:contact.html.twig', array
            ('title' => 'Message Flash')
        );
    }

}
