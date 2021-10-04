<?php

namespace Magento\Theme\Block\Html;

use Magento\Framework\View\Element\Template;

class Title extends Template {

    protected $pageTitle;

    public function getPageTitle() {

        if (!empty($this->pageTitle)) {
            return $this->pageTitle;
        }
    }

    public function getPageHeading() {
        if (!empty($this->pageTitle)) {
            return __($this->pageTitle);
        }
        return __($this->pageConfig->getTitle()->getShortHeading());
    }

    public function setPageTitle() {
        $this->pageTitle = $pageTitle;
    }
}