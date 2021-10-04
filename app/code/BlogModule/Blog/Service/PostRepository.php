<?php

namespace BlogModule\Blog\Service;

use BlogModule\Blog\Api\Data\PostInterface;
use BlogModule\Blog\Api\PostManagementInterface;
use BlogModule\Blog\Api\PostRepositoryInterface;
use BlogModule\Blog\Model\Post;
use BlogModule\Blog\Model\ResourseModel\Post as PostResource;
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
     * PostRepository constructor.
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PostResource $resource
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder   $searchCriteriaBuilder,
        PostResource            $resource,
        PostManagementInterface $postManagement
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resource = $resource;
        $this->postManagement = $postManagement;
    }

    public function get()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

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
