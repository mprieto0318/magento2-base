<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)
            ->forward('edit');

    }

}
