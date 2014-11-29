<?php

namespace SaorTrade\Bundle\Controller;

use SaorTrade\Bundle\Entity\Want;
use SaorTrade\Bundle\Form\Want\AddWantForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WantController extends Controller
{
    public function showAction($id)
    {
        $wantService = $this->get("saor_trade.want_service");
        $want = $wantService->getWantById($id);

        return $this->render('SaorTradeBundle:Want:show.html.twig', array(
            'want' => $want
        ));
    }

    public function listAction()
    {
        $wantService = $this->get("saor_trade.want_service");
        $wants = $wantService->getAllWants();

        return $this->render('SaorTradeBundle:Want:list.html.twig', array(
            'wants' => $wants
        ));
    }

    public function addAction(Request $request)
    {
        $want = new Want();
        $addWantForm = $this->createForm(new AddWantForm(), $want);
        $addWantForm->handleRequest($request);
        if ($addWantForm->isValid()) {
            $wantService = $this->get("saor_trade.want_service");
            $wantService->addWant($want);
        }

        return $this->render('SaorTradeBundle:Want:add.html.twig', array(
            'addWantForm' => $addWantForm->createView()
        ));
    }
}