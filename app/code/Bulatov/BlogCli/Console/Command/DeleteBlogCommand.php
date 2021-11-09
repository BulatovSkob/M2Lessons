<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteBlogCommand extends Command
{
    const BLOG_ID = 'blog_id';
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }
    protected function configure(): void
    {
        $this->setName('blog:delete');
        $this->setDescription('Command for deleting a certain blog');
        $this->addOption(self::BLOG_ID, null, InputOption::VALUE_REQUIRED);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $id = $input->getOption(self::BLOG_ID);
        $id ? $this->deleteBlog((int)$id, $output) : $this->showError($output);
    }

    private function deleteBlog(int $id, OutputInterface $output): void
    {
        $output->writeln('deleting ' . $id);
        try {
            $this->blogRepository->delete($id);
        } catch (NoSuchEntityException $ex) {
            $output->writeln($ex->getMessage());

            return;
        }

        $output->writeln($id . ' deleted');
    }

    private function showError($output): void
    {
        $output->writeln('<info>Blog name should be provided: blog:delete [--blog_name name]</info>');
        $output->writeln('Stopped');
    }
}
