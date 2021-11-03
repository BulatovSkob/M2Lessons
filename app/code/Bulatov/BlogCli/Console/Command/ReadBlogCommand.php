<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ReadBlogCommand extends Command
{
    const BLOG_NAME = 'blog_name';
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('blog:read');
        $this->setDescription('Command for reading a certain blog');
        $this->addOption(self::BLOG_NAME, null, InputOption::VALUE_REQUIRED);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $blogName = $input->getOption(self::BLOG_NAME);
        $blogName ? $this->readBlog($blogName, $output) : $this->showError($output);
    }

    private function readBlog(string $blogName, OutputInterface $output): void
    {
        $output->writeln('start reading ' . $blogName . ' blog');
        try {
            $blog = $this->blogRepository->getByName($blogName);
        } catch (NoSuchEntityException $ex) {
            $output->writeln($ex->getMessage());

            return;
        }

        $output->writeln($blog->getDescription());
    }

    private function showError($output): void
    {
        $output->writeln('<info>Blog name should be provided: blog:read [--blog_name name]</info>');
        $output->writeln('Stopped');
    }
}
