<?php

namespace SaorTrade\Bundle\Repository;

use Doctrine\ORM\EntityRepository;

abstract class CustomRepository extends EntityRepository
{
    public function save($entity, $sync = true)
    {
        $this->_em->persist($entity);
        if ($sync) {
            $this->_em->flush();
        }
    }
}