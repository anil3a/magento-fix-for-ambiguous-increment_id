<?php 
/**
 * Overwrite default Adminhtml Block Sales Grid to fix ambigious increment_id
 */
class AnilPrz_Salesgrid_Block_Adminhtml_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $collection->getSelect()->join('sales_flat_order', 'main_table.entity_id = sales_flat_order.entity_id', array('customer_email'));
        $collection->addFilterToMap('increment_id', 'main_table.increment_id');
        $this->setCollection($collection);
        //return parent::_prepareCollection();
        // Pass _prepareCollection() directly to 2 parent up,
        // i.e. skipping Mage_Adminhtml_Block_Sales_Order_Grid to Mage_Adminhtml_Block_Widget_Grid
        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }
}


