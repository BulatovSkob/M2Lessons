<?php
declare(strict_types=1);

namespace Bulatov\BlogFrontend\Controller;


use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class ActionExample implements HttpGetActionInterface
{
    private PageFactory $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute(): ResultInterface
    {
        $page =  $this->pageFactory->create();
        $page->addHandle('example_layout');

        return $page;
    }
}
