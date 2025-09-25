<?php
declare(strict_types=1);

namespace Mprieto\Blog\Ui\Grid\Blog\Component\Listing\Column;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class StoreView extends Column
{
    private StoreManagerInterface $storeManager;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (!empty($item['store_id'])) {
                    try {
                        $store = $this->storeManager->getStore((int)$item['store_id']);
                        $item['store_id'] = $store->getName();
                    } catch (\Exception $e) {
                        $item['store_id'] = __('All Store Views');
                    }
                } else {
                    $item['store_id'] = __('All Store Views');
                }
            }
        }
        return $dataSource;
    }
}
