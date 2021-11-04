<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

class BlogRouter implements RouterInterface
{
    protected ActionFactory $actionFactory;
    protected ResponseInterface $response;

    public function __construct(ActionFactory $actionFactory, ResponseInterface $response)
    {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    public function match(RequestInterface $request): ?ActionInterface
    {
        return $request->getPathInfo() === '/not_a_blog/example'
            ? $this->actionFactory->create(ActionExample::class)
            : null;
    }
}
