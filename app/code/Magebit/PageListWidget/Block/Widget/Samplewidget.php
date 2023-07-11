<?php
namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory as PageCollectionFactory;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Samplewidget extends Template implements BlockInterface, IdentityInterface
{
    protected $_template = 'widget/samplewidget.phtml';
    protected PageCollectionFactory $_pageCollectionFactory;
    protected PageRepositoryInterface $_pageRepository;

    public function getIdentities(): array
    {
        $pageCollection = $this->getCmsPages();
        $identities = [];

        foreach ($pageCollection as $page) {
            $identities[] = \Magento\Cms\Model\Page::CACHE_TAG . '_' . $page->getId();
        }

        return $identities;
    }

    public function __construct(
        Template\Context $context,
        PageCollectionFactory $pageCollectionFactory,
        PageRepositoryInterface $pageRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_pageCollectionFactory = $pageCollectionFactory;
        $this->_pageRepository = $pageRepository;
    }

    public function getTitle()
    {
        $displayMode = $this->getData('display_mode');

        if ($displayMode == "specific_pages") {
            return '';
        } else {
            return $this->getData('title');
        }
    }

    public function getCmsPages(): \Magento\Cms\Model\ResourceModel\Page\Collection|array
    {
        $displayMode = $this->getData('display_mode');
        if ($displayMode == 'all_pages') {
            $pageCollection = $this->_pageCollectionFactory->create();
        } elseif ($displayMode == 'specific_pages') {
            $selectedPages = $this->getData('selected_pages');
            $pageCollection = $this->_pageCollectionFactory->create();
            $pageCollection->addFieldToFilter('page_id', ['in' => $selectedPages]);
        } else {
            return [];
        }

        return $pageCollection;
    }

    /**
     * Get cache key info
     *
     * @return array
     */
    public function getCacheKeyInfo(): array
    {
        return [
            'MAGEBIT_PAGE_LIST_WIDGET',
            $this->getTemplate(),
            $this->getTitle(),
            $this->getData('display_mode'),
            $this->getData('selected_pages'),
        ];
    }
}
