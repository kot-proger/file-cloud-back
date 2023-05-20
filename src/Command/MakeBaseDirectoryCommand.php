<?php

namespace App\Command;

use App\Service\DirectoryService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:makeBaseDir', description: 'Creates basic file directory')]
class MakeBaseDirectoryCommand extends Command
{
    public function __construct(private DirectoryService $directoryService)
    {
        parent::__construct();
    }
}
