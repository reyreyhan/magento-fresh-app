<?php
/**
 * Document
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */

namespace Reyhan\Sum\Ui\Component\Listing\DataProvider;

class Document extends \Magento\Framework\View\Element\UiComponent\DataProvider\Document
{
    protected $_idFieldName = 'entity_id';

    public function getIdFieldName()
    {
        return $this->_idFieldName;
    }
}
