<?php
namespace Mprieto\Blog\Controller\Adminhtml\Blog;

use Mprieto\Blog\Api\Data\BlogInterface;
use Mprieto\Blog\Api\Data\BlogInterfaceFactory;
use Mprieto\Blog\Api\BlogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Mprieto_Blog::blog';

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param BlogInterfaceFactory $blogFactory
     * @param BlogRepositoryInterface $blogRepository
     */
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly BlogInterfaceFactory $blogFactory,
        private readonly BlogRepositoryInterface $blogRepository
    ) {

        parent::__construct($context);
    }


    public function execute(): ResultInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = BlogInterface::STATUS_ENABLED;
            }
            if (empty($data['blog_id'])) {
                $data['blog_id'] = null;
            }

            $model = $this->blogFactory->create();

            $id = (int)  $this->getRequest()->getParam('blog_id');
            if ($id) {
                try {
                    $model = $this->blogRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This blog no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->blogRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the blog.'));
                $this->dataPersistor->clear('mprieto_blog_blog');
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the blog.'));
            }

            # Necesario para persistir los datos al editar el form
            $this->dataPersistor->set('mprieto_blog_blog', $data);
            return $resultRedirect->setPath('*/*/edit', ['blog_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
