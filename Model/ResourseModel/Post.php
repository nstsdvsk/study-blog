<?php

namespace BlogModule\Blog\Model\ResourseModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 */
class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('blogmodule_blog_page_post', 'post_id');
    }
}
