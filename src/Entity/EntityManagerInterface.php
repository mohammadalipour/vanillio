<?php

namespace App\Entity;

interface EntityManagerInterface
{
    public function getRepository(EntityManager $entityManager);
}