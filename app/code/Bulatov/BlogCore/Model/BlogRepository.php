<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Model;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Bulatov\BlogCore\Model\ResourceModel\ResourceBlogModel;
use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Bulatov\BlogCore\Model\ResourceModel\ResourceBlogModel\BlogCollectionFactory;

class BlogRepository implements BlogRepositoryInterface
{

    private BlogModelFactory $blogFactory;
    private ResourceBlogModel $resourceBlogModel;
    private BlogCollectionFactory $blogCollectionFactory;

    public function __construct(
        BlogModelFactory $blogFactory,
        ResourceBlogModel $resourceBlogModel,
        BlogCollectionFactory $blogCollectionFactory
    )
    {
        $this->blogFactory = $blogFactory;
        $this->resourceBlogModel = $resourceBlogModel;
        $this->blogCollectionFactory = $blogCollectionFactory;
    }


    public function create(string $name, string $description = null): BlogModelInterface
    {
        $blog = $this->blogFactory->create();
        $blog->setName($name);
        $description === null ?: $blog->setDescription($description);

        return $blog;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(BlogModelInterface $blogModel): void
    {
        $this->resourceBlogModel->save($blogModel);
    }

    /**
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $blog = $this->blogFactory->create();
        $this->resourceBlogModel->load($blog, $id, 'id');
        if ($blog->getId() === null) {
            throw new NoSuchEntityException(__('blog with id ' . $id . ' doenst\'t exist'));
        }

        $this->resourceBlogModel->delete($blog);
    }

    /**
     * @return BlogModelInterface[]
     */
    public function getAll(): array
    {
        $collection = $this->blogCollectionFactory->create();

        return $collection->getItems();
    }

    /**
     * @throws NoSuchEntityException
     * @throws AlreadyExistsException
     */
    public function update(string $oldName, string $newName = null, string $description = null): void
    {
        $blog = $this->blogFactory->create();
        $this->resourceBlogModel->load($blog, $oldName, 'name');
        if ($blog->getId() === null) {
            throw new NoSuchEntityException(__('blog with name ' . $oldName . ' doenst\'t exist'));
        }

        $newName === null ?: $blog->setName($newName);
        $description === null ?: $blog->setDescription($description === '' ? null : $description);
        $this->resourceBlogModel->save($blog);
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getByName(string $name): BlogModelInterface
    {
        $blog = $this->blogFactory->create();
        $this->resourceBlogModel->load($blog, $name, 'name');
        if ($blog->getId() === null) {
            throw new NoSuchEntityException(__('blog with name ' . $name . ' doenst\'t exist'));
        }

        return $blog;
    }

    public function getById(int $id): BlogModelInterface
    {
        $blog = $this->blogFactory->create();
        $this->resourceBlogModel->load($blog, $id, 'id');
        if ($blog->getId() === null) {
            throw new NoSuchEntityException(__('blog with id ' . $id . ' doenst\'t exist'));
        }

        return $blog;
    }
}
