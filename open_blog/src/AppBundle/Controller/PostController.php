<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    /**
     * @Route("/post/list/", name="list")
     */
    public function listAction(Request $request)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $posts =$postRepository->findAll();

        return $this->render('post/list.html.twig', array(
            'posts'=>$posts
        ));
    }

    /**
     * @Route("/post/search/{title}", name="search")
     */
    public function searchAction(Request $request, $title)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $post = $postRepository->findAllByTitle($title);

        print_r($post);
    }


    /**
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post, array());

        $form->handleRequest($request);

        // $formData = $form->getData();
        // $date = $formData['title']->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 
                'Se ha creado correctamente el articulo.'
            );

            return $this->redirect($this->generateUrl('list'));
        }

        return $this->render('post/new.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    /**
     * @Route("/post/{id}", name="post_view")
     */
    public function viewAction(Request $request, $id)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $post =$postRepository->find($id);

        return new Response('Post con slug '.$post->getTitle());
    }

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    public function editAction(Request $request, $id)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        $post =$postRepository->find($id);

        $form = $this->createForm(PostType::class, $post, array());

        $form->handleRequest($request);

        // $formData = $form->getData();
        // $date = $formData['title']->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success', 
                'Se ha guardado correctamente el articulo.'
            );

            return $this->redirect($this->generateUrl('list'));
        }

        return $this->render('post/edit.html.twig', array(
            'post'=>$post,
            'form'=>$form->createView(),
        ));
    }
}
