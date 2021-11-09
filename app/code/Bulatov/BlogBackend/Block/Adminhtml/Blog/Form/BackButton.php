<?php declare(strict_types=1);

namespace Bulatov\BlogBackend\Block\Adminhtml\Blog\Form;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton
 */
class BackButton implements ButtonProviderInterface
{
    private UrlInterface $url;

    /**
     * BackButton constructor.
     * @param UrlInterface $url
     */
    public function __construct(UrlInterface $url)
    {
        $this->url = $url;
    }

    /**
     * @return array<string:mixed>
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    private function getBackUrl(): string
    {
        return $this->url->getUrl('blockbackend/blogcontroller/index');
    }
}
