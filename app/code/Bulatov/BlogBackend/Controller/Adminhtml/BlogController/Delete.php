<?php declare(strict_types=1);

namespace Bulatov\BlogBackend\Controller\Adminhtml\BlogController;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\Manager;

/**
 * Save action.
 */
class Delete extends Action
{
    const ADMIN_RESOURCE = 'Bulatov_BlogBackend::backend_blog';

    private RedirectFactory $redirectFactory;
    private BlogRepositoryInterface $blogRepository;
    private RequestInterface $request;

    public function __construct(
        Context $context,
        RedirectFactory $redirectFactory,
        Manager $messageManager,
        BlogRepositoryInterface $blogRepository,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->redirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
        $this->blogRepository = $blogRepository;
        $this->request = $request;
    }

    /**
     * @return ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = (int)$this->request->getParam('id');
        $this->isValidEntityId($id)
            ? $this->blogRepository->delete($id)
            : $this->messageManager->addErrorMessage('Invalid ID');

        return $this->getRedirect();
    }

    private function isValidEntityId(int $id): bool
    {
        return $id > 0 && $this->isEntityExist($id);
    }

    private function isEntityExist(int $id): bool
    {
        try {
            $blog = $this->blogRepository->getById($id);
        } catch (NoSuchEntityException $exception) {
            return false;
        }

        return $blog->getId() > 0;
    }


    private function getRedirect(): Redirect
    {
        $redirect = $this->redirectFactory->create([]);
        $redirect->setPath('*/*/index');

        return $redirect;
    }
}
