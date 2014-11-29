<?php

namespace SaorTrade\Bundle\Service;

use SaorTrade\Bundle\Repository\UserRepository;
use SaorTrade\Bundle\Entity\Want;
use SaorTrade\Bundle\Repository\WantRepository;

class WantService
{
    private $wantRepository;

    public function __construct(WantRepository $wantRepository)
    {
        $this->wantRepository = $wantRepository;
    }

    public function getAllWants()
    {
        return $this->wantRepository->findAll();
    }

    public function addWant(Want $want)
    {
        $this->wantRepository->save($want);
    }

    public function getWantById($id)
    {
        return $this->wantRepository->find($id);
    }
}