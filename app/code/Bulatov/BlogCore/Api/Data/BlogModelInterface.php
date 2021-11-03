<?php declare(strict_types=1);

namespace Bulatov\BlogCore\Api\Data;

interface BlogModelInterface
{
    public function setName(string $name): void;
    public function setDescription(?string $description): void;
    public function getName(): string;
    public function getDescription(): ?string;
}
