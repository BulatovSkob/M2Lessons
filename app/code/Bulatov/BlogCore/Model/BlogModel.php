<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Model;

use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Bulatov\BlogCore\Model\ResourceModel\ResourceBlogModel;
use Magento\Framework\Model\AbstractExtensibleModel;

class BlogModel extends AbstractExtensibleModel implements BlogModelInterface
{
    const NAME = 'name';
    const DESCRIPTION = 'description';

    protected function _construct()
    {
        $this->_init(ResourceBlogModel::class);
    }

    public function getName(): string
    {
        return $this->_getData(self::NAME);
    }

    public function getDescription(): ?string
    {
        return $this->_getData(self::DESCRIPTION);
    }

    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }
}
