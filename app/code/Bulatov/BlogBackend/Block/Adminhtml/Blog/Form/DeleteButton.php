<?php declare(strict_types=1);

namespace Bulatov\BlogBackend\Block\Adminhtml\Blog\Form;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Bulatov\BlogCore\Api\BlogRepositoryInterface;

/**
 * Class BackButton
 */
class DeleteButton implements ButtonProviderInterface
{
    private UrlInterface $url;
    private BlogRepositoryInterface $blogRepository;
    private RequestInterface $request;

    public function __construct(
        UrlInterface $url,
        BlogRepositoryInterface $blogRepository,
        RequestInterface $request
    ) {
        $this->url = $url;
        $this->blogRepository = $blogRepository;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getEntityId() !== 0) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getButtonUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    private function getButtonUrl(): string
    {
        return $this->url->getUrl('*/dealer/delete', ['id' => $this->getEntityId()]);
    }

    private function getEntityId(): int
    {
        try {
            return (int)$this->blogRepository->getById((int)$this->request->getParam('id'))->getId();
        } catch (NoSuchEntityException $e) {
            return 0;
        }
    }
}
