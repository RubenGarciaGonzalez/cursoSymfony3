<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    /**
     * @Route("/post/list/{page}", name="list")
     */
    public function listAction(Request $request, $page)
    {
        $postRepository = $this->getDoctrine()->getRepository('AppBundle:Post');

        // $posts =$postRepository->findBy(array('id'=>4));

        return new Response('List '.$posts);
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
        $post->setTitle('10 Trucos Symfony');
        $post->setSlug('10-trucos-symfony');
        // $post->setDescription('Lorem ipsum dolor');

        $validator = $this->get('validator');
        $errors = $validator->validate($post,null, array('edit'));

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response ($errorsString);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Post creado con el slug '.$post->getSlug());
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
       
        
    }
}
