<?php
/**
 * InstallData
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */

namespace Reyhan\Sum\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Sum setup factory
     *
     * @var SumSetupFactory
     */
    protected $sumSetupFactory;

    /**
     * Init
     *
     * @param SumSetupFactory $sumSetupFactory
     */
    public function __construct(SumSetupFactory $sumSetupFactory)
    {
        $this->sumSetupFactory = $sumSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        /** @var SumSetup $sumSetup */
        $sumSetup = $this->sumSetupFactory->create(['setup' => $setup]);

        $setup->startSetup();

        $sumSetup->installEntities();
        $entities = $sumSetup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $sumSetup->addEntityType($entityName, $entity);
        }

        $setup->endSetup();
    }
}
