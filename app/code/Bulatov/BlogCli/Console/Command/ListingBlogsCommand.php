<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListingBlogsCommand extends Command
{
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('blog:list');
        $this->setDescription('Command for getting a list of all blogs');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        foreach ($this->blogRepository->getAll() as $blog) {
            $output->writeln($blog->getName() . "\n");
        }
    }
}
