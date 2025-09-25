<?php declare(strict_types=1);

namespace Mprieto\Blog\Model;

use Mprieto\Blog\Api\Data\BlogInterface;

class Blog extends \Magento\Framework\Model\AbstractModel implements BlogInterface
{
    private const BLOG_ID = 'blog_id';
    private const NAME = 'name';
    private const CONTENT = 'content';
    private const IS_ACTIVE = 'is_active';
    private const CREATED_AT = 'created_at';
    private const UPDATED_AT = 'updated_at';
    private const STORE_ID = 'store_id';

    protected function _construct() {
        $this->_eventPrefix = 'mprieto_blog';
        $this->_eventObject = 'blog';
        $this->_idFieldName = self::BLOG_ID;
        $this->_init(\Mprieto\Blog\Model\ResourceModel\Blog::class);
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
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return (string) $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     * @return mixed
     */
    public function setContent(string $content)
    {
        $this->setData(self::CONTENT, $content);
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
    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return (int) $this->getData(self::STORE_ID);
    }

    /**
     * @param int $storeId
     */
    public function setStoreId(int $storeId)
    {
        $this->setData(self::STORE_ID, $storeId);
    }

}
