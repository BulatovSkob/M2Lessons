<?php
namespace Bulatov\BlogBackend\Controller\Adminhtml\BlogController;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Create action.
 */
class Create extends Action
{
    const ADMIN_RESOURCE = 'Bulatov_BlogBackend::dealers';


    private PageFactory $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bulatov_BlogBackend::index');

        return $resultPage;
    }
}
