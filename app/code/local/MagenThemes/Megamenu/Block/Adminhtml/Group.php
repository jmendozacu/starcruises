<?php
/******************************************************
 * @package Megamenu module for Magento 1.4.x.x and Magento 1.5.x.x
 * @version 1.5.0.4
 * @author http://www.9magentothemes.com
 * @copyright (C) 2011- 9MagentoThemes.Com
 * @license PHP files are GNU/GPL
*******************************************************/
?>
<?php
class MagenThemes_Megamenu_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_group';
    $this->_blockGroup = 'megamenu';
    $this->_headerText = Mage::helper('megamenu')->__('Menu Manager');
    $this->_addButtonLabel = Mage::helper('megamenu')->__('Add Menu');
    parent::__construct();
  }
}