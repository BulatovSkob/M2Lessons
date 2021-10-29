<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\Block;

use Magento\Framework\View\Element\Template;

class Blog extends Template
{
    public function getBlogs(): array
    {
        return ['blog1', 'blog2'];
    }
}
