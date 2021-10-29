<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class BlogViewModel implements ArgumentInterface
{
    public function getBlogs(): string
    {
        return 'view_model';
    }
}
