<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Api;

use Bulatov\BlogCore\Api\Data\BlogModelInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

interface BlogRepositoryInterface
{
    /**
     * @throws AlreadyExistsException
     */
    public function create(string $name, string $description = null): void;

    /**
     * @throws NoSuchEntityException
     */
    public function delete(string $name): void;

    /**
     * @return BlogModelInterface[]
     */
    public function getAll(): array;

    /**
     * @throws NoSuchEntityException
     */
    public function update(string $oldName, string $newName = null, string $description = null): void;

    /**
     * @throws NoSuchEntityException
     */
    public function getByName(string $name): BlogModelInterface;
}
