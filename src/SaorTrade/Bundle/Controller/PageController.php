<?php

namespace SaorTrade\Bundle\Controller;

use SaorTrade\Bundle\Form\RegistrationForm;
use SaorTrade\Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function homeAction()
    {
        return $this->render('SaorTradeBundle:Page:home.html.twig');
    }

    public function registerAction(Request $request)
    {
        $user = new User();
        $registrationForm = $this->createForm(new RegistrationForm(), $user);
        $registrationForm->handleRequest($request);
        if ($registrationForm->isValid()) {
            $userService = $this->get('saor_trade.user_service');
            $userService->registerUser($user);
        }

        return $this->render('SaorTradeBundle:Security:register.html.twig', array(
            'registrationForm' => $registrationForm->createView(),
        ));
    }
}
