<?php

namespace Esedjo\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
   
    public function IndexAction()
    {
        $listAdverts = array(
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 0,
                'author'  => 'Jacques',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime('+74 day')),
            array(
                'title'   => 'Recherche développpeur Symfony2',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
                'date'    => new \Datetime('-74 day')),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime('+735 day')),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime('+174 day')),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 4,
                'author'  => 'Pierre',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime('+1 year')),
        );

        usort($listAdverts, array("Esedjo\CoreBundle\Controller\IndexController","cmp"));

        return $this->render('EsedjoCoreBundle:Index:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function ContactAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()
                ->add('notice', ' : La page de contact n\'est pas encore disponible, merci de revenir plus tard.');

        return $this->render('EsedjoCoreBundle:Index:contact.html.twig', array
            ('title' => 'Message Flash')
        );
    }

    public function cmp($a, $b)
    {
        return strnatcmp( $a["date"]->format('Y-m-d H:m:s'), $b["date"]->format('Y-m-d H:m:s') );
    }



}
