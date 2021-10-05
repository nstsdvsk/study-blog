<?php

namespace BlogModule\Blog\Service;

use BlogModule\Blog\Api\Data\PostInterface;
use BlogModule\Blog\Api\PostManagementInterface;
use BlogModule\Blog\Api\PostRepositoryInterface;
use BlogModule\Blog\Model\Post;
use BlogModule\Blog\Model\ResourseModel\Post as PostResource;
use BlogModule\Blog\Model\ResourseModel\Post\Collection as PostCollection;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Class PostRepository
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    private $searchCriteriaBuilder;

    /**
     * @var PostResource
     */
    private $resource;

    /**
     * @var PostManagementInterface
     */
    private $postManagement;


    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var PostCollection
     */
    private $postCollection;

    /**
     * PostRepository
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PostResource $resource
     * @param PostManagementInterface $postManagement
     * @param PostRepositoryInterface $postRepository
     * @param PostCollection $postCollection
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder   $searchCriteriaBuilder,
        PostResource            $resource,
        PostManagementInterface $postManagement,
        PostRepositoryInterface $postRepository,
        PostCollection $postCollection
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resource = $resource;
        $this->postManagement = $postManagement;
        $this->postRepository = $postRepository;
        $this->postCollection = $postCollection;
    }

    public function get()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $this->postRepository->getList();

        return $this->pageRepository->getList($searchCriteria);
    }

    /**
     * @param int $pageId
     * @return PostInterface|Post
     */
    public function getByPageId($pageId): PostInterface
    {
        $post = $this->postManagement->getEmptyObject();
        $this->resource->load($post, $pageId, 'page_id');

        return $post;
    }
}
