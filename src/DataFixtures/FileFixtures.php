<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $file = (new File())
//        ->setName('audio.mp3')
//        ->setPath('/home/audio')
//        ->setSize(25);
//        $manager->persist($file);
//
//        $file = (new File())
//        ->setName('video.mp4')
//        ->setPath('/home/video')
//        ->setSize(75);
//        $manager->persist($file);
//
//        $file = (new File())
//        ->setName('image.png')
//        ->setPath('/home/images')
//        ->setSize(15);
//        $manager->persist($file);
//
//        $file = (new File())
//        ->setName('document.docx')
//        ->setPath('/home/documents')
//        ->setSize(5);
//        $manager->persist($file);

        $manager->flush();
    }
}
