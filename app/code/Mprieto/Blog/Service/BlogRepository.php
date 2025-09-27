<?php declare(strict_types = 1);

namespace Mprieto\Blog\Service;

use Mprieto\Blog\Api\Data\BlogInterface;
use Mprieto\Blog\Api\Data\BlogSearchResultsInterface;
use Mprieto\Blog\Api\Data\BlogSearchResultsInterfaceFactory;
use Mprieto\Blog\Api\BlogRepositoryInterface;
use Mprieto\Blog\Model\ResourceModel\Blog as BlogResource;
use Mprieto\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Mprieto\Blog\Model\BlogFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Mprieto\Blog\Model\Comments;
use Mprieto\Blog\Model\CommentsFactory;
use Mprieto\Blog\Model\ResourceModel\Comments as CommentsResource;
use Mprieto\Blog\Model\ResourceModel\Comments\CollectionFactory as CommentsCollectionFactory;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * @param BlogResource $blogResource
     * @param BlogFactory $blogFactory
     * @param CollectionFactory $blogCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        private readonly BlogResource $blogResource,
        private readonly BlogFactory $blogFactory,
        private readonly CollectionFactory $blogCollectionFactory,
        private readonly CollectionProcessorInterface $blogCollectionProcessor,
        private readonly BlogSearchResultsInterfaceFactory $blogSearchResultsFactory,
        protected CommentsResource $commentsResource,
        protected CommentsFactory $commentsFactory,
        protected CommentsCollectionFactory $commentsCollectionFactory
    )
    {

    }


    /**
     * @param \Mprieto\Blog\Api\Data\BlogInterface $blog
     * @return int
     * @throws NoSuchEntityException
     */
    public function save(BlogInterface $blog): int
    {
        $this->blogResource->save($blog);

        return $blog->getBlogId();
    }

    /**
     * @param \Mprieto\Blog\Api\Data\BlogInterface $blog
     * @return void
     */
    public function delete(BlogInterface $blog): void
    {
        $this->blogResource->delete($blog);
    }

    /**
     * @param int $blogId
     * @return \Mprieto\Blog\Api\Data\BlogInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $blogId): BlogInterface
    {
        $blog = $this->blogFactory->create();
        $this->blogResource->load($blog, $blogId);
        if(!$blog->getId()) {
            throw new NoSuchEntityException(__('The blog with id %1 does not exist.', $blogId));
        }
        return $blog;
    }

    /**
     * @param int $blogId
     * @return \Mprieto\Blog\Api\Data\BlogInterface
     * @throws NoSuchEntityException
     */
    public function getByIdComments(int $blogId): BlogInterface
    {
        $blog = $this->blogFactory->create();
        $this->blogResource->load($blog, $blogId);
        if(!$blog->getId()) {
            throw new NoSuchEntityException(__('The blog with id %1 does not exist.', $blogId));
        }

        $collection = $this->commentsCollectionFactory->create();
        $collection->addFieldToFilter('blog_id', $blogId);

        $commentsData = [];
        foreach ($collection as $comment) {
            $commentsData[] = $comment->getData();
        }

        $blog->setComments($commentsData);

        return $blog;
    }

    /**
     * @param $blogId
     * @return bool
     * @throws NoSuchEntityException
     */
    public function deleteById($blogId): bool
    {
        $blog = $this->getById($blogId);
        $this->delete($blog);
        return true;
    }


    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->blogCollectionFactory->create();

        $this->blogCollectionProcessor->process($criteria, $collection);

        /** @var BlogSearchResultsInterface $searchResults */
        $searchResults = $this->blogSearchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        foreach ($collection->getItems() as $item) {
            $commentsCollection = $this->commentsCollectionFactory->create();
            $commentsCollection->addFieldToFilter('blog_id', $item->getId());

            $commentsData = [];
            foreach ($commentsCollection as $comment) {
                $commentsData[] = $comment->getData();
            }

            $item->setComments($commentsData);
        }

        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
