<?php

namespace BlogModule\Blog\Model;

use BlogModule\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;
use BlogModule\Blog\Model\ResourseModel\Post as PostResourse;

/**
 * Class Post
 */
class Post extends AbstractModel implements PostInterface
{
    protected function _construct()
    {
        $this->_init(PostResourse::class);
    }
}
