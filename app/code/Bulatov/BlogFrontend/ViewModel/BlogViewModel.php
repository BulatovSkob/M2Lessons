<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\ViewModel;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class BlogViewModel implements ArgumentInterface
{

    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * @return BlogModelInterface[]
     */
    public function getBlogs(): array
    {
        return $this->blogRepository->getAll();
    }
}
