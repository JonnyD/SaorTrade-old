<?php

namespace SaorTrade\Bundle\Repository;

interface RoleRepository
{
    public function save($entity, $sync = true);
}