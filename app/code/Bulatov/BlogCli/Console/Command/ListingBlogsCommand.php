<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListingBlogsCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('blog:list');
        $this->setDescription('Command for getting a list of all blogs');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln('Blogs:');
    }
}
