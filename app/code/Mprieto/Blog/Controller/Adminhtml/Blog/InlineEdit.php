<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Mprieto\Blog\Api\BlogRepositoryInterface;
use Mprieto\Blog\Model\Blog;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class InlineEdit extends Action
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
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items = $this->getRequest()->getParam('items');

        $messages = [];
        $error = false;
        if(!count($items)) {
            $messages[] = __('Please correct the data sent..');
            $error = true;
        }else {

                foreach (array_keys($items) as $blogId) {
                    try {
                        /** @var Blog $blog */
                        $blog = $this->blogRepository->getById((int) $blogId);
                        $blog->setData(array_merge($blog->getData(), $items[$blogId]));
                        $this->blogRepository->save($blog);
                    }catch (\Throwable $exception){
                        $messages[] = '[Blog ID:]'. $blog->getId(). ' Error: ' . $exception->getMessage();
                        $error = true;
                    }
                }
        }

        return $result->setData(['messages'=>$messages, 'error'=>$error]);
    }
}
