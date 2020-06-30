<?php
/**
 * InstallData
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */

namespace Reyhan\Sum2\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Sum2 setup factory
     *
     * @var Sum2SetupFactory
     */
    protected $sum2SetupFactory;

    /**
     * Init
     *
     * @param Sum2SetupFactory $sum2SetupFactory
     */
    public function __construct(Sum2SetupFactory $sum2SetupFactory)
    {
        $this->sum2SetupFactory = $sum2SetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        /** @var Sum2Setup $sum2Setup */
        $sum2Setup = $this->sum2SetupFactory->create(['setup' => $setup]);

        $setup->startSetup();

        $sum2Setup->installEntities();
        $entities = $sum2Setup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $sum2Setup->addEntityType($entityName, $entity);
        }

        $setup->endSetup();
    }
}
