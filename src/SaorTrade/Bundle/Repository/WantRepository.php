<?php

namespace SaorTrade\Bundle\Repository;

interface WantRepository
{
    public function save($entity, $sync = true);
}