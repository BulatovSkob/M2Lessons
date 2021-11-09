<?php declare(strict_types=1);

namespace Bulatov\BlogBackend\ViewModel;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Edit implements ArgumentInterface
{
    private BlogRepositoryInterface $blogRepository;
    private RequestInterface $request;
    private int $blogId;

    public function __construct(BlogRepositoryInterface $blogRepository, RequestInterface $request)
    {
        $this->blogRepository = $blogRepository;
        $this->request = $request;
        $this->blogId = (int) $this->request->getParam('id');
    }

    /**
     * @return BlogModelInterface
     */
    public function getBlogByParamId(): ?BlogModelInterface
    {
        try {
            $blog = $this->blogRepository->getById($this->blogId);
        } catch (NoSuchEntityException $ex) {
            return null;
        }

        return $blog;
    }
}
