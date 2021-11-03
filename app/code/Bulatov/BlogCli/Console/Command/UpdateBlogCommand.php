<?php declare(strict_types=1);

namespace Bulatov\BlogCli\Console\Command;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateBlogCommand extends Command
{
    const OLD_NAME = 'old_name';
    const NEW_NAME = 'new_name';
    const DESCRIPTION = 'description';
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
        parent::__construct();
    }
    protected function configure(): void
    {
        $this->setName('blog:update');
        $this->setDescription('Command for updating a certain blog');
        $this->addOption(self::OLD_NAME, null, InputOption::VALUE_REQUIRED);
        $this->addOption(self::NEW_NAME, null, InputOption::VALUE_OPTIONAL);
        $this->addOption(self::DESCRIPTION, null, InputOption::VALUE_OPTIONAL);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $oldName = $input->getOption(self::OLD_NAME);
        $newName = $input->getOption(self::NEW_NAME);
        $description = $input->getOption(self::DESCRIPTION);
        $oldName ? $this->updateBlog($oldName, $output, $newName, $description) : $this->showError($output);
    }

    private function updateBlog(string $oldName, OutputInterface $output, ?string $newName, ?string $description): void
    {
        $output->writeln('updating ' . $oldName);
        try {
            $this->blogRepository->update($oldName, $newName, $description);
        } catch (NoSuchEntityException $ex) {
            $output->writeln($ex->getMessage());

            return;
        }

        $output->writeln($oldName . ' updated');
    }

    private function showError($output): void
    {
        $output->writeln('<info>Blog name should be provided: blog:update [--blog_name name]</info>');
        $output->writeln('Stopped');
    }
}
