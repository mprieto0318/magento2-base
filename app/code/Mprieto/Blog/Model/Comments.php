<?php declare(strict_types=1);

namespace Mprieto\Blog\Model;

use Mprieto\Blog\Api\Data\CommentsInterface;

class Comments extends \Magento\Framework\Model\AbstractModel implements CommentsInterface
{
    private const COMMENT_ID = 'comment_id';
    private const BLOG_ID = 'blog_id';
    private const CUSTOMER_ID = 'customer_id';
    private const COMMENT = 'comment';
    private const CREATED_AT = 'created_at';
    private const UPDATED_AT = 'updated_at';
    private const STATUS = 'status';

    protected function _construct() {
        $this->_eventPrefix = 'mprieto_blog_comments';
        $this->_eventObject = 'comments';
        $this->_idFieldName = self::COMMENT_ID;
        $this->_init(\Mprieto\Blog\Model\ResourceModel\Comments::class);
    }

    /**
     * @return int
     */
    public function getCommentId(): int
    {
        return (int) $this->getData(self::COMMENT_ID);
    }

    /**
     * @param int $commentId
     * @return mixed
     */
    public function setCommentId(int $commentId)
    {
        $this->setData(self::COMMENT_ID, $commentId);
    }

    /**
     * @return int
     */
    public function getBlogId(): int
    {
        return (int) $this->getData(self::BLOG_ID);
    }

    /**
     * @param int $blogId
     * @return mixed
     */
    public function setBlogId(int $blogId)
    {
        $this->setData(self::BLOG_ID, $blogId);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int) $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param int $customerId
     * @return mixed
     */
    public function setCustomerId(int $customerId)
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return (string) $this->getData(self::COMMENT);
    }

    /**
     * @param string $comment
     * @return mixed
     */
    public function setComment(string $comment)
    {
        $this->setData(self::COMMENT, $comment);
    }

    /**
     * @return string
     */
    public function getCreateAt(): string
    {
        return (string) $this->getData(self::CREATED_AT);
    }

    /**
     * @param string $createAt
     */
    public function setCreateAt(string $createAt)
    {
        $this->setData(self::CREATED_AT, $createAt);
    }

    /**
     * @return string
     */
    public function getUpdateAt(): string
    {
        return (string) $this->getData(self::UPDATED_AT);
    }

    /**
     * @param string $updateAt
     */
    public function setUpdateAt(string $updateAt)
    {
        $this->setData(self::UPDATED_AT, $updateAt);
    }


    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return (bool) $this->getData(self::STATUS);
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status)
    {
        $this->setData(self::STATUS, $status);
    }
}
