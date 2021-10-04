<?php

declare(strict_types=1);

namespace BlogModule\Blog\Observer;

use BlogModule\Blog\Api\Data\PostInterface;
use BlogModule\Blog\Api\PostManagementInterface;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Class PageSaveAfter
 */
class PageSaveAfter implements ObserverInterface
{
    /**
     * @var PostManagementInterface
     */
    private $postManagement;

    /**
     * PageSaveAfter constructor
     * @param PostManagementInterface $postManagement
     */
    public function __construct(PostManagementInterface $postManagement)
    {
        $this->postManagement = $postManagement;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /**
         * @var PageInterface $entity
         */
        $entity = $observer->getEvent()->getObject();
        $data = $entity->getData();

        /**
         * @var PostInterface|Post $post
         */
        $post = $this->postManagement->getEmptyObject();

//        var_dump($data['author']);
//        var_dump($data['is_post']);
//        var_dump($data['publish_date']);
//        var_dump($data['page_id']);
//        die();
//        $post->setData('author', $data['author']);
//        $post->setData('is_post', $data['is_post']);
//        $post->setData('publish_date', $data['publish_date']);
//        $post->setData('page_id', $data['page_id']);

        $post->setData('author', "TEXT11");
        $post->setData('is_post', "1");
        $post->setData('publish_date', "2020-04-09");
        $post->setData('page_id', "7");


        $this->postManagement->save($post);
    }
}
