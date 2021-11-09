<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Model\ResourceModel\ResourceBlogModel;

use Bulatov\BlogCore\Api\Data\BlogCollectionInterface;
use Bulatov\BlogCore\Model\BlogModel;
use Bulatov\BlogCore\Model\ResourceModel\ResourceBlogModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class BlogCollection extends AbstractCollection implements BlogCollectionInterface
{
    protected function _construct()
    {
        $this->_init(BlogModel::class, ResourceBlogModel::class);
    }
}
