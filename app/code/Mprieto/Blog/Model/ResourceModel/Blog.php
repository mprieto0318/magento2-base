<?php declare(strict_types=1);

namespace Mprieto\Blog\Model\ResourceModel;

class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    private const TABLE_NAME = 'mprieto_blog';
    private const FIELD_NAME = 'blog_id';

    protected function _construct() {
        $this->_init(self::TABLE_NAME, self::FIELD_NAME);
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setData('updated_at', time());
        return parent::_beforeSave($object);
    }
}
