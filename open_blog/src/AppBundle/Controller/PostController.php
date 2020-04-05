<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    /**
     * @Route("/list/{page}", name="list")
     */
    public function listAction(Request $request, $page)
    {
        // replace this example code with whatever you need
        echo 'list';
    }

    /**
     * @Route("/{slug}", name="post_view")
     */
    public function viewAction(Request $request, $slug)
    {
        // replace this example code with whatever you need
        echo 'post_view';
    }

    /**
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        // replace this example code with whatever you need
        echo 'post_new';
    }

    /**
     * @Route("/post/edit/{slug}", name="post_edit")
     */
    public function editAction(Request $request, $slug)
    {
        // replace this example code with whatever you need
        echo 'post_edit';
    }
}
