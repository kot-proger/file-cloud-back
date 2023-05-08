<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = (new Role())
            ->setName('admin');
        $manager->persist($file);

        $file = (new File())
            ->setName('user');
        $manager->persist($file);

        $manager->flush();
    }
}
