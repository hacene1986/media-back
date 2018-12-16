<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\MediaType;
use App\Entity\Media;


class MediaController extends AbstractController
{
    /**
     * @Route("/media", name="media")
     */
    public function index(Request $request)
    {
      // récupération paramètres URL

 $type = $request->query->get('type');
 $medias = $this->getDoctrine()
   ->getRepository(Media::class)
   ->findByFilters($type)
   ;

 $type = array(
   'Livre' => 'Livre',
   'Film' => 'Film',
   'Audio' => 'Audio'
 );
 return $this->render('media/index.html.twig', [
     'medias' => $medias,
     'type' => $type
 ]);
    }

    /**
     * @Route("/media/json", name="media_json")
     */
    public function index_json()
    {


      // $type = $request->query->get('type');
       $media = $this->getDoctrine()
         ->getRepository(Media::class)
        // ->findAll()
        ->findByFiltersAssoc();
         ;

       return new JsonResponse($media);

    }

    /**
     * @Route("/media/type/json", name="media_type_json")
     */
    public function index_type_json(Request $request)
    {


       $type = $request->query->get('type');
       $media = $this->getDoctrine()
         ->getRepository(Media::class)
        // ->findAll()
        ->findByFiltersType($type);
         ;

       return new JsonResponse($media);

    }

    /**
     * @Route("/media/add", name="media_add")
     */
    public function add(Request $request)
    {
      $media = new Media();
      $form = $this->createForm(MediaType::class, $media);
      $form->handleRequest($request);
      if ($form->isSubmitted()) {
        $media = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($media);
        $em->flush();
 }
 return $this->render('form.html.twig', [
     'form' => $form->createView(),
 ]);
    }
}
