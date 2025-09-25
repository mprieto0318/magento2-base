<?php declare(strict_types=1);

namespace Mprieto\Blog\Model\ResourceModel\Blog;

use Mprieto\Blog\Model\Blog as BlogModel;
use Mprieto\Blog\Model\ResourceModel\Blog as BlogResource;

 class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
     protected function _construct()
     {
         $this->_init(BlogModel::class, BlogResource::class);
     }

 }
