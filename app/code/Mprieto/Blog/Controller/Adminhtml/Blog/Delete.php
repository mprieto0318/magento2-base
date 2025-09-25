<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Mprieto\Blog\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    public function __construct(
        Context $context,
        private readonly BlogRepositoryInterface $blogRepository,
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $blogId = (int) $this->getRequest()->getParam('blog_id', 0);
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if(!$blogId){
            $this->messageManager->addWarningMessage(__('This blog no longer exists.'));
            return $result->setPath('mprieto_blog/blog/index');
        }

        try {
            $blog = $this->blogRepository->getById($blogId);
            if(!$blog){
                $this->messageManager->addWarningMessage(__('This blog no longer exists.'));
            }else {
                $this->blogRepository->delete($blog);
                $this->messageManager->addSuccessMessage('Blog was successfully deleted.');
            }
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage(
                'Something went wrong while processing the operation: ',
                $exception->getMessage()
            );
        }

        return $result->setPath('mprieto_blog/blog/index');
    }
}
