<?php

namespace Mprieto\Blog\Api\Data;

interface BlogInterface
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    /**
     * @return int
     */
    public function getBlogId(): int;

    /**
     * @param int $blogId
     * @return void
     */
    public function setBlogId(int $blogId);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     * @return void
     */
    public function setContent(string $content);

    /**
     * @return string
     */
    public function getCreateAt(): string;

    /**
     * @param string $createAt
     * @return void
     */
    public function setCreateAt(string $createAt);

    /**
     * @return string
     */
    public function getUpdateAt(): string;

    /**
     * @param string $updateAt
     * @return void
     */
    public function setUpdateAt(string $updateAt);

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @param bool $isActive
     * @return void
     */
    public function setIsActive(bool $isActive);

    /**
     * @return int
     */
    public function getStoreId(): int;

    /**
     * @param int $storeId
     * @return void
     */
    public function setStoreId(int $storeId);

    /**
     * @return \Mprieto\Blog\Api\Data\CommentsInterface[]|null
     */
    public function getComments();

    /**
     * @param \Mprieto\Blog\Api\Data\CommentsInterface[] $comments
     * @return $this
     */
    public function setComments(array $comments);

}
