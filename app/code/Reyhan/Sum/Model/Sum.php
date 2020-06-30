<?php

/**
 * Sum.php
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */

namespace Reyhan\Sum\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Sum extends AbstractModel implements IdentityInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'reyhan_sum_sum';

    /**
     * @var string
     */
    protected $_cacheTag = 'reyhan_sum_sum';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'reyhan_sum_sum';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Reyhan\Sum\Model\ResourceModel\Sum');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->getResource()->save($this);
        }
        return $this;
    }


}
