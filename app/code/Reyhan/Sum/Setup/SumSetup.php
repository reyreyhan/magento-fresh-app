<?php
/**
 * SumSetup
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */

namespace Reyhan\Sum\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;

/**
 * @codeCoverageIgnore
 */
class SumSetup extends EavSetup
{
    /**
     * Entity type for Sum EAV attributes
     */
    const ENTITY_TYPE_CODE = 'reyhan_sum';

    /**
     * Retrieve Entity Attributes
     *
     * @return array
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function getAttributes()
    {
        $attributes = [];

        $attributes['identifier'] = [
            'type' => 'static',
            'label' => 'identifier',
            'input' => 'text',
            'required' => true,
            'sort_order' => 10,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'group' => 'General',
            'validate_rules' => 'a:2:{s:15:"max_text_length";i:100;s:15:"min_text_length";i:1;}'
        ];

        // Add your entity attributes here... For example:

        $attributes['value1'] = [
            'type' => 'varchar',
            'label' => 'Value1',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 30,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            //'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];

        $attributes['value2'] = [
            'type' => 'varchar',
            'label' => 'Value2',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 30,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            //'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];

        $attributes['operator'] = [
            'type' => 'varchar',
            'label' => 'Operator',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 30,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            //'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];

        $attributes['total'] = [
            'type' => 'varchar',
            'label' => 'Total',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 30,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            //'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];

        return $attributes;
    }

    /**
     * Retrieve default entities: sum
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        $entities = [
            self::ENTITY_TYPE_CODE => [
                'entity_model' => 'Reyhan\Sum\Model\ResourceModel\Sum',
                'attribute_model' => 'Reyhan\Sum\Model\ResourceModel\Eav\Attribute',
                'table' => self::ENTITY_TYPE_CODE . '_entity',
                'increment_model' => null,
                'additional_attribute_table' => self::ENTITY_TYPE_CODE . '_eav_attribute',
                'entity_attribute_collection' => 'Reyhan\Sum\Model\ResourceModel\Attribute\Collection',
                'attributes' => $this->getAttributes()
            ]
        ];

        return $entities;
    }
}
