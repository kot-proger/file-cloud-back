<?php

namespace App\Command;

use App\Service\DirectoryService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:makeBaseDir', description: 'Creates basic file directory')]
class MakeBaseDirectoryCommand extends Command
{
    private string $path;

    public function __construct(private DirectoryService $directoryService, string $path)
    {
        $this->path = $path;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->directoryService->createBaseDir($this->path);

        return Command::SUCCESS;
    }
}
