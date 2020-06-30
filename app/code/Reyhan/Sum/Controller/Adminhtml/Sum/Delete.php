<?php
/**
 * Delete
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */
namespace Reyhan\Sum\Controller\Adminhtml\Sum;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Reyhan\Sum\Model\SumFactory;

class Delete extends Action
{
    /** @var sumFactory $objectFactory */
    protected $objectFactory;

    /**
     * @param Context $context
     * @param SumFactory $objectFactory
     */
    public function __construct(
        Context $context,
        SumFactory $objectFactory
    ) {
        $this->objectFactory = $objectFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Reyhan_Sum::sum');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id', null);

        try {
            $objectInstance = $this->objectFactory->create()->load($id);
            if ($objectInstance->getId()) {
                $objectInstance->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
            } else {
                $this->messageManager->addErrorMessage(__('Record does not exist.'));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        
        return $resultRedirect->setPath('*/*');
    }
}
