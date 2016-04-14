<?php
/**
 * Ffm_Coupondropdown extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the OSL 3.0 License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * @category       Ffm
 * @package        Ffm_Coupondropdown
 * @copyright      Copyright (c) 2015
 * @license        OSL 3.0 http://opensource.org/licenses/OSL-3.0
 */
/**
 * Default helper
 *
 * @category    Ffm
 * @package     Ffm_Coupondropdown
 * @author      Sander Mangel <sander@sandermangel.nl>
 */
class Ffm_Coupondropdown_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return Mage_SalesRule_Model_Resource_Coupon_Collection
     */
    public function getCouponOptions()
    {
        $storeId = Mage::getSingleton('adminhtml/session_quote')->getStoreId();
        $_store = Mage::getModel('core/store')->load($storeId);

        $customerId = Mage::getSingleton('adminhtml/session_quote')->getCustomerId();
        $_customer = Mage::getModel('customer/customer')->load($customerId);

        $_ruleCollection = Mage::getModel('salesrule/rule')->getCollection()
            ->addWebsiteGroupDateFilter($_store->getWebsiteId(), $_customer->getGroupId());

        $_couponCollection = Mage::getModel('salesrule/coupon')->getCollection()
            ->addRuleIdsToFilter($_ruleCollection->getAllIds());

        return $_couponCollection;
    }
}