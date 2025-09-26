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
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('Mprieto_Blog::blog');
        $page->addBreadcrumb(__('Blogs'), __('Blogs'));
        $page->addBreadcrumb(__('New Blog'), __('New Blog'));
        $page->getConfig()->getTitle()->prepend(__('New Blog'));

        return $page;
        //return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)
        //    ->forward('edit');

    }

}
