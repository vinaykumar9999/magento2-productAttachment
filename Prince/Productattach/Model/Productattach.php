<?php

/**
 * Mageprince
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @package Prince_Productattach
 */

namespace Prince\Productattach\Model;

/**
 * Class Productattach
 * @package Prince\Productattach\Model;
 */
class Productattach extends \Magento\Framework\Model\AbstractModel
{
    
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'pt_products_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'pt_products_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'pt_products_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Prince\Productattach\Model\ResourceModel\Productattach');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getProducts(\Prince\Productattach\Model\Productattach $object)
    {
        $tbl = $this->getResource()->getTable("prince_productattach");
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['products']
        )
        ->where(
            'productattach_id = ?',
            (int)$object->getId()
        );

        $products = $this->getResource()->getConnection()->fetchCol($select);
        
        if ($products) {
            $products = explode('&', $products[0]);
        }

        return $products;
    }
}
