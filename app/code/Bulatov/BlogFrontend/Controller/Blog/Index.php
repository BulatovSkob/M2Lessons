<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\Controller\Blog;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    protected PageFactory $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute(): ResultInterface
    {
        return $this->pageFactory->create();
    }

    public function example(): ResultInterface
    {
        return $this->pageFactory->create();
    }
}
