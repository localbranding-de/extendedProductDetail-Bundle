<?php 
namespace LocalbrandingDe\ExtendedProductDetailBundle\Classes;

class SyncFields
{
    private  $tl_ls_shop_product =  array("id","lsShopProductCode","published","lsShopProductAttributesValues","lsShopProductPrice",
        "useScalePrice","scalePriceType","scalePrice","lsShopProductDeliveryInfoSet","lb_isConsulting","lb_Duration","tstamp","lsShopProductQuantityUnit","title_de",
        "shortDescription_de","alias_de","lsShopProductQuantityUnit_de","lb_timeContract",
        "lb_sellingUnit","lb_isDownloadProduct","lb_revisionLoops","lb_timeContractNoticePeriodInDays",
        "lb_timeContractPeriodInDays","lb_isDiscount","lb_limitation","lb_domainType","lb_isTopDomain",
        "lb_domainText","lb_isDomain","lb_isManualDomain","lb_recurringContract","lb_hasMaxOneJob");
    
    private $tl_lb_costType = array("id","tstamp","isTask","costType","measure","description");
    private $tl_lb_productCalculation = array("id","tstamp","lb_costTypeOnceList","lb_costTypeRecurrList","lb_consultantShare","product","lb_expensesRecurr","lb_expensesOnce","lb_sumPurchasePriceRecurr","lb_sumPurchasePriceOnce");
    function __construct() {
        
    }
    
    
    public function getFields($table)
    {
        return $this->$table;
        
    }
    
    
}
