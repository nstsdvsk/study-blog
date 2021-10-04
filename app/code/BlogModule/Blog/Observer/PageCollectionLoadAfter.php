<?php

declare(strict_types=1);

namespace BlogModule\Blog\Observer;

use BlogModule\Blog\Api\PostRepositoryInterface;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\ResourceModel\Page\Collection;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use BlogModule\Blog\Model\ResourseModel\Post\Collection as PostCollection;
use BlogModule\Blog\Model\ResourseModel\Post\CollectionFactory as PostCollectionFactory;

/**
 * Class PageCollectionLoadAfter
 */
class PageCollectionLoadAfter implements ObserverInterface
{
    /**
     * @var PostCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * PageSaveAfter constructor
     * @param PostCollectionFactory $postCollectionFactory
     */
    public function __construct(PostCollectionFactory $postCollectionFactory)
    {
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /**
         * @var Collection $collection
         */
        $collection = $observer->getEvent()->getPageCollection();

        $pageIds = [];

        /**
         * @var Page $item
         */
        foreach ($collection->getItems() as $item) {
            $pageIds[] = $item->getId();
        }

        $postCollection = $this->postCollectionFactory->crate();
        $postCollection->addFieldToFilter('page_id', ['in' => $pageIds]);

        $items = $postCollection->getItems();

        foreach ($postCollection->getItems() as $post) {
            $page = $collection->getItemById($post->getPageId());
            if ($page->getId()) {
                $page->setData('author', $post->getData('author'));
                $page->setData('is_post', $post->getData('is_post'));
                $page->setData('published_date', $post->getData('published_date'));
            }
        }
    }
}
