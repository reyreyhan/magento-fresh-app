<?php
/**
 * DataProvider
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */
namespace Reyhan\Sum\Ui\Component\Form\Sum;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\FilterPool;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Reyhan\Sum\Model\ResourceModel\Sum\Collection;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;
    
    /**
     * @var FilterPool
     */
    protected $filterPool;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Collection $collection
     * @param FilterPool $filterPool
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        FilterPool $filterPool,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collection;
        $this->filterPool = $filterPool;
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->loadedData) {
            $storeId = (int)$this->request->getParam('store');
            $this->collection
                ->setStoreId($storeId)
                ->addAttributeToSelect('*');
            $items = $this->collection->getItems();
            foreach ($items as $item) {
                $item->setStoreId($storeId);
                $this->loadedData[$item->getId()] = $item->getData();
                break;
            }
        }
        return $this->loadedData;
    }
}
