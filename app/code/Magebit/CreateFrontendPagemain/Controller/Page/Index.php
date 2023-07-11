<?php

namespace Magebit\CreateFrontendPagemain\Controller\Page;

use Magento\Framework\App\ActionInterface;

class Index implements ActionInterface
{
    protected \Magento\Framework\View\Result\PageFactory $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute(): \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface
    {
        return $this->_pageFactory->create();
    }
}
