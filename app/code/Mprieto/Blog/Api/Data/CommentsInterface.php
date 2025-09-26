<?php

namespace Mprieto\Blog\Api\Data;

interface CommentsInterface
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    /**
     * @return int
     */
    public function getCommentId(): int;

    /**
     * @param int $commentId
     * @return void
     */
    public function setCommentId(int $commentId);

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
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @param int $customerId
     * @return void
     */
    public function setCustomerId(int $customerId);

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment);

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
    public function getStatus(): bool;

    /**
     * @param bool $status
     * @return void
     */
    public function setStatus(bool $status);

}
