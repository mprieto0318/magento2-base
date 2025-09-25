<?php

namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Mprieto\Blog\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Mprieto\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Mprieto\Blog\Api\Data\BlogInterface;

class MassEnable extends Action
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory,
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
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            /** @var BlogInterface $blog */
            foreach ($collection as $blog) {
                $blog->setIsActive(BlogInterface::STATUS_ENABLED);
                $this->blogRepository->save($blog);
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been enabled.', $collectionSize));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage('Something went wrong while processing the operation: ', $exception->getMessage());
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $result->setPath('mprieto_blog/blog/index');
    }
}
