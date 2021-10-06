<?php

namespace BlogModule\Blog\Service;

use BlogModule\Blog\Api\Data\PostInterface;
use BlogModule\Blog\Api\PostManagementInterface;
use BlogModule\Blog\Api\PostRepositoryInterface;
use BlogModule\Blog\Model\Post;
use BlogModule\Blog\Model\ResourseModel\Post as PostResource;
use BlogModule\Blog\Model\ResourseModel\Post\Collection as PostCollection;
use BlogModule\Blog\Model\ResourseModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Cms\Api\Data\PageSearchResultsInterface;

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
     * @var postCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * PostRepository
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PostResource $resource
     * @param PostManagementInterface $postManagement
     * @param PostCollectionFactory $postCollectionFactory
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder   $searchCriteriaBuilder,
        PostResource            $resource,
        PostManagementInterface $postManagement,
        PostCollectionFactory $postCollectionFactory
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resource = $resource;
        $this->postManagement = $postManagement;
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @return PageSearchResultsInterface
     * @throws LocalizedException
     */
    public function get()
    {
        $postCollection = $this->postCollectionFactory->create();
        $postCollection->addFieldToFilter('is_post', ['eq' => 1]);

        $pageIds = [];

        /**
         * @var Post $post
         */
        foreach ($postCollection->getItems() as $post) {
            $pageIds[] = $post->getData('page_id');
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('page_id', $pageIds, 'in')
            ->create();

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
