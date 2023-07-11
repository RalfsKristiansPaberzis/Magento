<?php

namespace Magebit\CreateFrontendPagemain\Block\Page;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getTitle(): string
    {
        return 'Hello world';
    }
}
