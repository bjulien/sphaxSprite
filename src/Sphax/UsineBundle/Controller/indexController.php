<?php
namespace Sphax\UsineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class indexController extends Controller
{
	 /**
     * @Route("/test", name="indexTest")
     * @Template("SphaxUsineBundle:test:raphael.html.twig")
     */
    public function indexAction()
    {
        return array('name' => 'toto');
    }
}