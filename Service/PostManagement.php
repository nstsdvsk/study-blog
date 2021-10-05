<?php

namespace BlogModule\Blog\Service;

use BlogModule\Blog\Api\Data\PostInterface;
use BlogModule\Blog\Api\PostManagementInterface;
use BlogModule\Blog\Model\PostFactory;
use BlogModule\Blog\Model\ResourseModel\Post as PostResource;
use Magento\Framework\Exception\AlreadyExistsException;

/**
 * Class PostManagement
 */
class PostManagement implements PostManagementInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostResource
     */
    private $resource;

    /**
     * PostManagement constructor.
     * @param PostFactory $postFactory
     * @param PostResource $resourse
     */
    public function __construct(
        PostFactory $postFactory,
        PostResource $resourse
    ) {
        $this->postFactory = $postFactory;
        $this->resource = $resourse;
    }

    /**
     * @return PostInterface
     */
    public function getEmptyObject() : PostInterface
    {
        return $this->postFactory->create();
    }

    /**
     * @param PostInterface $post
     * @throws AlreadyExistsException
     */
    public function save(PostInterface $post)
    {
        $this->resource->save($post);
    }
}
