<?php

namespace BlogModule\Blog\Api;

use BlogModule\Blog\Api\Data\PostInterface;

/**
 * Interface PostRepositoryInterface
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * @return PostInterface
     */
    public function get();

    /**
     * @param int $pageId
     * @return PostInterface
     */
    public function getByPageId($pageId) : PostInterface;
}
