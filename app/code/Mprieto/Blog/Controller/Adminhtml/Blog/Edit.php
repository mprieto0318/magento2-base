<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Mprieto\Blog\Api\Data\BlogInterface;
use Mprieto\Blog\Api\Data\BlogInterfaceFactory;
use Mprieto\Blog\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    public function __construct(
        Context $context,
        private readonly BlogRepositoryInterface $blogRepository,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly BlogInterfaceFactory $blogFactory
    )
    {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $blogId = $this->getRequest()->getParam('blog_id');

        if($blogId) {
            try {
                $blog = $this->blogRepository->getById($blogId);
                # set params to form
                $this->dataPersistor->set('mprieto_blog_blog', $blog);

            }catch (NoSuchEntityException $exception){
                $this->messageManager->addErrorMessage(__('The Blog with the given id does not exist.') . $exception->getMessage());
            }
        }else {
            $blog = $this->blogFactory->create();
        }

        $title = ($blog->getId()) ? $blog->getName() : 'Edit Blog';
        $page->setActiveMenu('Mprieto_Blog::blog');
        $page->addBreadcrumb(__('Blogs'), __('Blogs'));
        $page->addBreadcrumb($title, $title);
        $page->getConfig()->getTitle()->prepend($title);

        return $page;
    }

}
