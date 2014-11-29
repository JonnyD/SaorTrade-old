<?php

namespace SaorTrade\Bundle\Controller;

use SaorTrade\Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function showUserAction($id)
    {
        $userService = $this->get("saor_trade.user_service");
        $user = $userService->getUserById($id);

        return $this->render('SaorTradeBundle:User:show.html.twig', array(
            'user' => $user
        ));
    }
}