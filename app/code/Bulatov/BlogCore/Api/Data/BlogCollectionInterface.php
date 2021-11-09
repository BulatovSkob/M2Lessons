<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Api\Data;

interface BlogCollectionInterface
{
    /**
     * @return BlogModelInterface[]
     */
    public function getItems();

    /**
     * @return BlogModelInterface
     */
    public function getNewEmptyItem();

    /**
     * @param $model
     * @return mixed
     */
    public function setModel($model);
}
