<?php
declare(strict_types=1);

namespace Bulatov\BlogBackend\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class BlogActions extends Column
{
    private UrlInterface $urlModel;
    private Escaper $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlModel,
        Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlModel = $urlModel;
        $this->escaper = $escaper;
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $name = $this->escaper->escapeHtml($item['name']);
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlModel->getUrl(
                                'blogbackend/blogcontroller/edit',
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlModel->getUrl(
                                'blogbackend/blogcontroller/delete',
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $name),
                                'message' => __('Are you sure you want to delete a %1 record?', $name)
                            ],
                            'post' => true
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
