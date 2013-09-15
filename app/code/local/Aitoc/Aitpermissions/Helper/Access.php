<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467520
 * Purchase ID: JlNeBKBvSqsIsT7whc80ZpBA38zH86mwW38f4D7p5H
 * Generated:   2013-01-14 03:56:09
 * File path:   app/code/local/Aitoc/Aitpermissions/Helper/Access.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ dsdojYNyoukBZejl('1d2f8779075e70019b6e2ebc32e40d31'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Helper_Access extends Mage_Core_Helper_Abstract
{
    // Sets store_id's for cms object, keeping in mind that unavailable stores are
    // not visible in multiselect, but should not dissapear after save
    public function setCmsObjectStores($object)
    {
        if (!Mage::getSingleton('aitpermissions/role')->isPermissionsEnabled())
        {
            return;
        }

        $origData = $object->getOrigData();
        $saveData = $object->getData();
        
        $objectIsNew = empty($origData);
        
        $allowedStoreviewIds = Mage::getSingleton('aitpermissions/role')->getAllowedStoreviewIds();

        if ($object instanceof Mage_Cms_Model_Page)
        {
            $tosaveStoreIds = $saveData['stores'];

            if (!$objectIsNew)
            {
                $originalStoreIds = $origData['store_id'];
                $preserveStoreIds = array_diff($originalStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_intersect($tosaveStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_unique(array_merge($preserveStoreIds, $tosaveStoreIds));
            }

            $object->setData('stores', $tosaveStoreIds);
        }
        else if ($object instanceof Mage_Cms_Model_Block)
        {
            $tosaveStoreIds = $saveData['stores'];

            if (!$objectIsNew)
            {
                $originalStoreIds = $origData['store_id'];
                $preserveStoreIds = array_diff($originalStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_intersect($tosaveStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_unique(array_merge($preserveStoreIds, $tosaveStoreIds));
            }

            $object->setData('stores', $tosaveStoreIds);
        }
        else if ($object instanceof Mage_Widget_Model_Widget_Instance)
        {
            $tosaveStoreIds = explode(',', $saveData['store_ids']);

            if (!$objectIsNew)
            {
                $originalStoreIds = explode(',', $origData['store_ids']);
                $preserveStoreIds = array_diff($originalStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_intersect($tosaveStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_unique(array_merge($preserveStoreIds, $tosaveStoreIds));
            }

            $object->setData('store_ids', implode(',', $tosaveStoreIds));
        }
        else if ($object instanceof Mage_Poll_Model_Poll)
        {
            $tosaveStoreIds = $saveData['store_ids'];

            if (!$objectIsNew)
            {
                $originalStoreIds = Mage::getModel('poll/poll')->load($object->getPollId())->getStoreIds();
                $preserveStoreIds = array_diff($originalStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_intersect($tosaveStoreIds, $allowedStoreviewIds);
                $tosaveStoreIds = array_unique(array_merge($preserveStoreIds, $tosaveStoreIds));
            }

            $object->setData('store_ids', $tosaveStoreIds);
        }
    }
    
    // If a product is assigned to website(s) not available for current role, we should preserve these assignments
    public function setProductWebsites($product)
    {
        if (!Mage::getSingleton('aitpermissions/role')->isPermissionsEnabled())
        {
            return;
        }

        $originalProduct = Mage::getModel('catalog/product')->load($product->getId());

        $allowedWebsites = Mage::getSingleton('aitpermissions/role')->getAllowedWebsiteIds();
        $originalWebsiteIds = $originalProduct->getWebsiteIds();
        $toSaveWebsiteIds = $product->getWebsiteIds();
        
        $preserveWebsiteIds = array_diff($originalWebsiteIds, $allowedWebsites);
        $toSaveWebsiteIds = array_unique(array_merge($preserveWebsiteIds, $toSaveWebsiteIds));
        
        $product->setWebsiteIds($toSaveWebsiteIds);
    }
} } 