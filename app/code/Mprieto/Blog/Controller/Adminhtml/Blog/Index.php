<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    public function execute(): ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('Mprieto_Blog::blog');
        $page->addBreadcrumb(__('Blogs'), __('Blogs'));
        $page->addBreadcrumb(__('Manage Blogs'), __('Manage Blogs'));
        $page->getConfig()->getTitle()->prepend(__('Blogs'));

        return $page;
    }

}
