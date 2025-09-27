<?php declare(strict_types=1);

namespace Mprieto\Blog\Api;

use Mprieto\Blog\Api\Data\BlogInterface;
interface BlogRepositoryInterface
{
    /**
     * @param \Mprieto\Blog\Api\Data\BlogInterface $blog
     * @return int
     */
    public function save(BlogInterface $blog): int;

    /**
     * @param \Mprieto\Blog\Api\Data\BlogInterface $blog
     * @return void
     */
    public function delete(BlogInterface $blog): void;

    /**
     * @param int $blogId
     * @return \Mprieto\Blog\Api\Data\BlogInterface
     */
    public function getById(int $blogId): BlogInterface;

    /**
     * @param int $blogId
     * @return \Mprieto\Blog\Api\Data\BlogInterface
     */
    public function getByIdComments(int $blogId): BlogInterface;

    /**
     * @param int $blogId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $blogId): bool;

    /**
     * Retrieve blogs matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mprieto\Blog\Api\Data\BlogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
