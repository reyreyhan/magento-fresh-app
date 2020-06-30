<?php

/**
 * Uninstall.php
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */
namespace Reyhan\Sum\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    /**
     * @var array
     */
    protected $tablesToUninstall = [
        SumSetup::ENTITY_TYPE_CODE . '_entity',
        SumSetup::ENTITY_TYPE_CODE . '_eav_attribute',
        SumSetup::ENTITY_TYPE_CODE . '_entity_datetime',
        SumSetup::ENTITY_TYPE_CODE . '_entity_decimal',
        SumSetup::ENTITY_TYPE_CODE . '_entity_int',
        SumSetup::ENTITY_TYPE_CODE . '_entity_text',
        SumSetup::ENTITY_TYPE_CODE . '_entity_varchar'
    ];

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();

        foreach ($this->tablesToUninstall as $table) {
            if ($setup->tableExists($table)) {
                $setup->getConnection()->dropTable($setup->getTable($table));
            }
        }

        $setup->endSetup();
    }
}
