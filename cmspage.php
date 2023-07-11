<?php

use Magento\Framework\AppInterface;

try {
    require_once __DIR__ . '/app/bootstrap.php';
} catch (\Exception $e) {
    echo 'Autoload error: ' . $e->getMessage();
    exit(1);
}
try {
    $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
    $objectManager = $bootstrap->getObjectManager();
    $appState = $objectManager->get('\Magento\Framework\App\State');
    $appState->setAreaCode('frontend');
    $om = \Magento\Framework\App\ObjectManager::getInstance();
    $storeManager = $om->create('Magento\Cms\Model\PageFactory');

    $pagedata = [
        'title' => 'Your Title Here',
        'identifier' => 'page-identifier-here',
        'stores' => 0,
        'is_active' => 1,
        'content_heading' => 'Page Heading Here',
        'content' => 'page content here',
        'page_layout' => '1column'
    ];

    $storeManager->create()->setData($pagedata)->save();
    echo "CMS static Page programmatically successfully created";
} catch (\Exception $e) {
    print_r($e->getMessage());
}
