<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ResourceBlogModel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('blogs', 'id');
    }
}
