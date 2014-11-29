<?php

namespace SaorTrade\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SaorTradeBundle:Default:index.html.twig', array('name' => $name));
    }
}
