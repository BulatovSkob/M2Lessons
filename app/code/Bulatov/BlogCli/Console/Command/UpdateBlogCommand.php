<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateBlogCommand extends Command
{
    const BLOG_NAME = 'blog_name';

    protected function configure(): void
    {
        $this->setName('blog:update');
        $this->setDescription('Command for updating a certain blog');
        $this->addOption(self::BLOG_NAME, null, InputOption::VALUE_REQUIRED);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $blogName = $input->getOption(self::BLOG_NAME);
        $blogName ? $this->updateBlog($blogName, $output) : $this->showError($output);
    }

    private function updateBlog(string $blogName, OutputInterface $output): void
    {
        $output->writeln('updating ' . $blogName);
        $output->writeln($blogName . ' updated');
    }

    private function showError($output): void
    {
        $output->writeln('<info>Blog name should be provided: blog:update [--blog_name name]</info>');
        $output->writeln('Stopped');
    }
}
