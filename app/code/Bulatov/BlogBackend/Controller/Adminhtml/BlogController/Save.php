<?php declare(strict_types=1);

namespace Bulatov\BlogBackend\Controller\Adminhtml\BlogController;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\Manager;

/**
 * Save action.
 */
class Save extends Action
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
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->request->getParam('id');
        $name = (string)$this->request->getParam('name');
        $description = (string)$this->request->getParam('description');
        $blog = $id === '' ? $this->createBlog($name, $description) : $this->getAndChangeBlog((int)$id ,$name, $description);
        if ($blog instanceof BlogModelInterface) {
            $this->saveBlog($blog);
        }

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

    /**
     * @throws AlreadyExistsException
     */
    private function saveBlog(BlogModelInterface $blog): void
    {
        $this->blogRepository->save($blog);
        $this->messageManager->addSuccessMessage('Saved entity successfully');
    }

    private function getRedirect(): Redirect
    {
        $redirect = $this->redirectFactory->create([]);
        $redirect->setPath('*/*/index');

        return $redirect;
    }

    private function createBlog(string $name, string $description): BlogModelInterface
    {
        return $this->blogRepository->create($name, $description);
    }

    /**
     * @throws NoSuchEntityException
     */
    private function getAndChangeBlog(int $id, string $name, string $description): ?BlogModelInterface
    {
        if ($this->isValidEntityId($id) === false) {
            $this->messageManager->addErrorMessage('Invalid ID');

            return null;
        }

        $blog = $this->blogRepository->getById($id);
        $blog->setName($name);
        $blog->setDescription($description);

        return $blog;
    }


}
