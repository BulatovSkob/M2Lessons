<?php
namespace Bulatov\BlogBackend\Controller\Adminhtml\DieController;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action implements HttpGetActionInterface
{
    public function execute()
    {
        die();
    }
}
