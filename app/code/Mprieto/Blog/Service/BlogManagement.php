<?php declare(strict_types = 1);

namespace Mprieto\Blog\Service;

use Mprieto\Blog\Api\BlogManagementInterface;
use Mprieto\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Mprieto\Blog\Model\BlogFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class BlogManagement implements BlogManagementInterface
{
    protected const PATH_MPRIETO_BLOG_SETTING_ENABLE = 'mprieto_blog/settings/enable';

    /**
     * @param BlogFactory $blogFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        protected readonly BlogFactory $blogFactory,
        protected readonly CollectionFactory $collectionFactory,
        protected readonly StoreManagerInterface $storeManager,
        protected readonly ScopeConfigInterface $scopeConfig,
        protected readonly LoggerInterface $logger
    )
    {
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        $enableModule = $this->scopeConfig->getValue(
            self::PATH_MPRIETO_BLOG_SETTING_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getCode()
        ) ?? null;

        return $enableModule;
    }
}
