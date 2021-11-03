<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Psr\Log\LoggerInterface;

class BlogViewModel implements ArgumentInterface
{

    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getBlogs(): string
    {
        return (string) $this->scopeConfig->getValue('admin/url/use_custom');
    }
}
