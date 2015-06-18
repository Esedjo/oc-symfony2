<?php

// src/Esedjo/PlatformBundle/Controller/AdvertController.php

namespace Esedjo\PlatformBundle\Controller;

use Esedjo\PlatformBundle\Entity\Advert;
use Esedjo\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{

    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
        // On déclenche une exception NotFoundHttpException, cela va afficher
        // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
        throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Ici, on récupérera la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony2',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime())
        );
        return $this->render('EsedjoPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EsedjoPlatformBundle:Advert')
        ;

        $image = new Image();
        $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        $image->setAlt('Job de rêve');

        $advert = $repository->find($id);
        $advert->setImage($image);

        if (null === $advert) {
              throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        return $this->render('EsedjoPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }

    public function addAction(Request $request)
    {

        // Création de l'annonce, objet Advert
        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony2');
        $advert->setAuthor('Alexandre');
        $advert->setContent('Nous recherchons un développeur Symfony2 ayant plus de 2 ans d\'expériences sur ce framework');

        // Création de l'entité Image
        $image = new Image();
        $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        $image->setAlt('C\'est le job de rêve');

        $advert->setImage($image);

        // Appel de l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // On persiste l'entité
        $em->persist($advert);

        // Nettoyage de l'entité persistée
        $em->flush();

        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
        // Ici, on s'occupera de la création et de la gestion du formulaire

           $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirect($this->generateUrl('esedjo_platform_view', array('id' => $advert->getId())));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('EsedjoPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à $id
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        // Même mécanisme que pour l'ajout
        return $this->render('EsedjoPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question
        return $this->render('EsedjoPlatformBundle:Advert:delete.html.twig');
    }
    
    public function menuAction()
    {
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony2' ),
            array('id' => 5, 'title' => 'Mission de webmaster' ),
            array('id' => 9, 'title' => 'Offre de stage webdesigner' )
        );

        return $this->render('EsedjoPlatformBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
}
