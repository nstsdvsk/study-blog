<?php

namespace BlogModule\Blog\Model\ResourseModel\Post;

use BlogModule\Blog\Model\ResourseModel\Post as PostResourse;
use BlogModule\Blog\Model\Post;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResourse::class);
    }
}
