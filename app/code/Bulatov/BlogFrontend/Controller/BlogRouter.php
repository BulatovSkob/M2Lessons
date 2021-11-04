<?php declare(strict_types=1);

namespace Bulatov\BlogFrontend\Controller;

use Bulatov\BlogFrontend\Controller\Blog\Index;
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
        $identifier = trim($request->getPathInfo(), '/');

        if (strpos($identifier, 'learning') !== false) {
            $request->setModuleName('routing');
            $request->setControllerName('index');
            $request->setActionName('index');
            $request->setParams([
                'first_param' => 'first_value',
                'second_param' => 'second_value'
            ]);

            return $this->actionFactory->create(Index::class);
        }

        return null;
    }
}
