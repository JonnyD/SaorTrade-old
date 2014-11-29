<?php

namespace SaorTrade\Bundle\Repository;

interface UserRepository
{
    public function save($entity, $sync = true);
}