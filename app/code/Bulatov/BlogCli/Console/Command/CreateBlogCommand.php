<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateBlogCommand extends Command
{
    const BLOG_NAME = 'blog_name';
    const BLOG_DESCRIPTION = 'blog_description';
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('blog:create');
        $this->setDescription('Command for creating a blog');
        $this->addOption(self::BLOG_NAME, null, InputOption::VALUE_REQUIRED);
        $this->addOption(self::BLOG_DESCRIPTION, null, InputOption::VALUE_OPTIONAL);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $blogName = $input->getOption(self::BLOG_NAME);
        $blogDescription = $input->getOption(self::BLOG_DESCRIPTION);
        $blogName ? $this->createBlog($blogName, $output, $blogDescription) : $this->showError($output);
    }

    private function createBlog(string $blogName, OutputInterface $output, ?string $blogDescription): void
    {
        $output->writeln('creating ' . $blogName);
        try {
            $this->blogRepository->create($blogName, $blogDescription);
        } catch (AlreadyExistsException $ex) {
            $output->writeln($blogName . ' name is already exist');

            return;
        }

        $output->writeln($blogName . ' created');
    }

    private function showError($output): void
    {
        $output->writeln('<info>Blog name should be provided: blog:create [--blog_name name]</info>');
        $output->writeln('Stopped');
    }
}
