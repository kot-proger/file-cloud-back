<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = new File();
        $file->setName('audio.mp3');
        $file->setDate('03.04.2023');
        $file->setPath('/home/audio');
        $file->setSize(25);
        $manager->persist($file);

        $file = new File();
        $file->setName('video.mp4');
        $file->setDate('03.04.2023');
        $file->setPath('/home/video');
        $file->setSize(75);
        $manager->persist($file);

        $file = new File();
        $file->setName('image.png');
        $file->setDate('03.04.2023');
        $file->setPath('/home/images');
        $file->setSize(15);
        $manager->persist($file);

        $file = new File();
        $file->setName('document.docx');
        $file->setDate('03.04.2023');
        $file->setPath('/home/documents');
        $file->setSize(5);
        $manager->persist($file);

        $manager->flush();
    }
}
