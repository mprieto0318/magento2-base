<?php declare(strict_types=1);

namespace Mprieto\Blog\Model\ResourceModel\Comments;

use Mprieto\Blog\Model\Comments as CommentsModel;
use Mprieto\Blog\Model\ResourceModel\Comments as CommentsResource;

 class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
     protected function _construct()
     {
         $this->_init(CommentsModel::class, CommentsResource::class);
     }

 }
