<?php
/**
 * Save
 *
 * @copyright Copyright © 2019 Reyhan. All rights reserved.
 * @author    newrey9227@gmail.com
 */
namespace Reyhan\Sum\Controller\Adminhtml\Sum;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Reyhan\Sum\Model\SumFactory;

class Save extends Action
{
    /** @var SumFactory $objectFactory */
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
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $storeId = (int)$this->getRequest()->getParam('store_id');
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $params = [];
            $objectInstance = $this->objectFactory->create();
            $objectInstance->setStoreId($storeId);
            $params['store'] = $storeId;
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            } else {
                $objectInstance->load($data['entity_id']);
                $params['entity_id'] = $data['entity_id'];
            }
            $objectInstance->addData($data);

            $this->_eventManager->dispatch(
                'reyhan_sum_sum_prepare_save',
                ['object' => $this->objectFactory, 'request' => $this->getRequest()]
            );

            try {

                if($objectInstance->getData('identifier') == null)
                    $objectInstance->setIdentifier($this->generateRandomString());

                $objectInstance->save();
                $this->messageManager->addSuccessMessage(__('You saved this record.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $params['entity_id'] = $objectInstance->getId();
                    $params['_current'] = true;
                    return $resultRedirect->setPath('*/*/edit', $params);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the record.'));
            }

            $this->_getSession()->setFormData($this->getRequest()->getPostValue());
            return $resultRedirect->setPath('*/*/edit', $params);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
