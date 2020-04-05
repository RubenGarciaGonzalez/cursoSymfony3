<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    /**
     * @Route("/category/{page}", name="category", requirements={"page": "\d+"})
     */
    public function listAction(Request $request, $page)
    {
        echo 'category';
    }

    /**
     * @Route("/category/new", name="category_new")
     */
    public function newAction(Request $request)
    {
        echo 'category_new';
    }

    /**
     * @Route("/category/edit/{slug}", name="category_edit")
     */
    public function editAction(Request $request, $slug)
    {
        return new Response('<html><body>Editando la categoría '.$slug.'!</body></html>');  
    }

}
