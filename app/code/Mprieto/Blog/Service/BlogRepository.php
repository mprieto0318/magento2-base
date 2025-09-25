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
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
