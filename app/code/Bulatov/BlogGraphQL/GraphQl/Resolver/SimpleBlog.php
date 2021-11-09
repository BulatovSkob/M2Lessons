<?php


namespace Bulatov\BlogGraphQL\GraphQl\Resolver;

use Bulatov\BlogCore\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class SimpleBlog implements ResolverInterface
{
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
            return $this->blogRepository->getByName($args['name']);
        } catch (NoSuchEntityException $ex) {
            return ['description' => $ex->getMessage()];
        }
    }
}
