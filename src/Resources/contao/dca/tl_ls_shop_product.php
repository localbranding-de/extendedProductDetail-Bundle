<?php
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\SyncFields;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\Doctrineinteractions;
/**
 * Table tl_ls_shop_product


$GLOBALS['TL_DCA']['tl_ls_shop_product']['config']['onsubmit_callback'][] =  array('tl_lb_product_class', 'syncRecord');

$GLOBALS['TL_DCA']['tl_ls_shop_product']['config']['ondelete_callback'][] =   array('tl_lb_product_class', 'syncRecordDelete');
 */
//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']=str_replace('alias;','alias;{lb_priceBoxLegend},lb_inPriceHeader1,lb_inPriceText1,lb_inPriceHeader2,lb_inPriceText2,lb_inPriceHeader3,lb_inPriceText3;{lb_Tab1Legend},lb_productTab1,lb_productTab1_text,lb_productTab1_accordList;{lb_Tab2Legend},lb_productTab2,lb_productTab2_text,lb_productTab2_accordList;{lb_Tab3Legend},lb_productTab3,lb_productTab3_text,lb_productTab3_accordList;',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] );


//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']=str_replace('useScalePrice,','lb_priceComment,lb_sellingUnit,useScalePrice,',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] );


//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default']=str_replace('{lsShopPublishAndState_legend},','{lbcostTypeContact_legend},lb_costTypeOnceListContact,lb_costTypeRecurrListContact,lb_summPurchasePriceOnceContact,lb_summPurchasePriceRecurrContact,lb_consultantShare;{lbcostType_legend},lb_costTypeOnceList,lb_costTypeRecurrList,lb_summPurchasePriceOnce,lb_summPurchasePriceRecurr;{lsShopPublishAndState_legend},',$GLOBALS['TL_DCA']['tl_ls_shop_product']['palettes']['default'] );


// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceHeader1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceHeader1'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header1'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceHeader2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceHeader2'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header2'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceHeader3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceHeader3'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header3'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceText1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceText1'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceText2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceText2'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_inPriceText3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_inPriceText3'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab1'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Paket-Bestandteile'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab1_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab1_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab1_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab1_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab1_accordHeader' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab1_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab1_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab1_accordContent'],
                'exclude'   => true,
                'inputType' => 'textarea',
                'eval'      => array('tl_class'=>'test wizard','rte'=>'tinyMCE'),
                'search'	=> true
            ),
        ),
        'tl_class'=>'needstofix'
    ),
    'sql' => "blob NULL"
);


$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab2'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Alles inklusive'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab2_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab2_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab2_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab2_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab2_accordHeader' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab2_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab2_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab2_accordContent'],
                'exclude' => true,
                'inputType'               => 'textarea',
                'eval'                    => array('tl_class'=>'test wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
        ),
        'tl_class'=>'needstofix'
    ),
    'sql' => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab3'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Ablauf'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab3_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab3_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_productTab3_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab3_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab3_accordHeader' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab3_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab3_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_productTab3_accordContent'],
                'exclude' => true,
                'inputType'               => 'textarea',
                'eval'                    => array('tl_class'=>'test wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
        ),
        'tl_class'=>'needstofix'
    ),
    'sql' => "blob NULL"
);


$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_priceComment'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_priceComment'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'priceComment'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_sellingUnit'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_sellingUnit'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50'),
    'sql'       => "int(10) NOT NULL default '1'"
);


//Legenden hinzuf�gen


$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_timeContractPeriodInDays']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_timeContractPeriodInDays'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_timeContractNoticePeriodInDays']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_timeContractNoticePeriodInDays'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_revisionLoops']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_revisionLoops'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'long'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_isDownloadProduct']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_isDownloadProduct'],
    'exclude' 		=> true,
    'eval'      => array( 'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

/*
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_summPurchasePriceOnce']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_summPurchasePriceOnce'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_summPurchasePriceRecurr']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_summPurchasePriceRecurr'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);



$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_costTypeOnceListContact']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_costTypeOnceListContact'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'costTypeOnceContact' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['costTypeOnceContact'],
                'inputType' => 'select',
                'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'wizard','maxlength'=>255),
                'options_callback' => array('tl_lb_product_class', 'getCostTypeOptions'),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'costTypeOnceDescriptionContact' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['costTypeOnceDescriptionContact'],
                'exclude' 		=> true,
                'inputType' 	=> 'textarea',
                'eval'      	=> array('tl_class'=>'wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
            'purchasePriceOnceContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchasePriceOnceContact'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'price','maxlength'=>10, 'rgxp'=>'numberWithDecimals'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchaseQuantityOnceContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchaseQuantityOnceContact'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'quantity','maxlength'=>10, 'rgxp'=>'natural'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePriceContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchasePriceContact'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'endPrice','maxlength'=>10, 'rgxp'=>'numberWithDecimals','disabled'=>true),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
        ),
    ),
    'sql' => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_costTypeRecurrListContact']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_costTypeRecurrListContact'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'tl_class'  => '',
        'columnFields' => array
        (
            'costTypeRecurrContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['costTypeRecurrContact'],
                'inputType' => 'select',
                'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'wizard','maxlength'=>255),
                'options_callback' => array('tl_lb_product_class', 'getCostTypeOptions'),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'costTypeRecurrDescriptionContact' => array
            (
                'label'     	=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['costTypeRecurrDescriptionContact'],
                'exclude' 		=> true,
                'inputType' 	=> 'textarea',
                'eval'      	=> array('tl_class'=>'wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
            'purchasePriceRecurrContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchasePriceRecurrContact'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'price','maxlength'=>10, 'rgxp'=>'numberWithDecimals'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchaseQuantityRecurrContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchaseQuantityRecurrContact'],
                'inputType' => 'text',
                'eval'      =>  array('maxlength'=>10,'tl_class'=>'quantity', 'rgxp'=>'natural'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePriceContact' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_product']['purchasePriceContact'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'endPrice','maxlength'=>10, 'rgxp'=>'numberWithDecimals','disabled'=>true),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
        ),
    ),
    'sql' => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_summPurchasePriceOnceContact']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_summPurchasePriceOnceContact'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_summPurchasePriceRecurrContact']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_summPurchasePriceRecurrContact'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);


$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_consultantShare']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_consultantShare'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10,'tl_class'=>'w50 text','rgxp'=>'numberWithDecimals'),
    'sql'       => "varchar(256) unsigned NOT NULL default '0'"
);*/
$GLOBALS['TL_DCA']['tl_ls_shop_product']['fields']['lb_isDiscount']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_product']['lb_isDiscount'],
    'exclude' 		=> true,
    'eval'      => array( 'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);

class tl_lb_product_class extends Backend
{public function syncRecord(DataContainer $dc)
{
    
    $di = new Doctrineinteractions();
    $db = $di->getConnection();
    $id = $dc->id;
    file_put_contents("worked",$dc->id);
    file_put_contents("worked1",print_r($_POST,TRUE));
    $stmt2 = $db->prepare("SELECT id FROM tl_ls_shop_product WHERE id = ?");
    $success = $stmt2->execute(array($id));
    $fields= array("id","lsShopProductCode","published","lsShopProductAttributesValues","lsShopProductPrice",
        "useScalePrice","scalePriceType","scalePrice","lsShopProductDeliveryInfoSet","lb_isConsulting","lb_Duration","tstamp","lsShopProductQuantityUnit","title_de",
        "shortDescription_de","alias_de","lsShopProductQuantityUnit_de","lb_timeContract",
        "lb_sellingUnit","lb_isDownloadProduct","lb_revisionLoops","lb_timeContractNoticePeriodInDays",
        "lb_timeContractPeriodInDays","lb_isDiscount","lb_limitation","lb_domainType","lb_isTopDomain",
        "lb_domainText","lb_isDomain","lb_isManualDomain","lb_recurringContract","lb_hasMaxOneJob");
    if ($stmt2->rowCount() > 0) {
        
        
        $rows=$_POST;
        
        $setstring="";
        $t = new SyncFields();
        print_r($t->getFields("tl_lb_costType"));
        foreach($rows as $key=>$value )
        {
            switch($key)
            {
                
                
                case 'login':
                    continue 2;
                    break;
                case 'password_confirm':
                    continue 2;
                    break;
                    
                case 'VERSION_NUMBER':
                    continue 2;
                    break;
                    
                case 'REQUEST_TOKEN':
                    continue 2;
                    break;
                    
                case 'FORM_SUBMIT':
                    continue 2;
                    break;
                    
                case 'FORM_FIELDS':
                    continue 2;
                    break;
                    
                case 'lastLogin':
                    continue 2;
                    break;
                    
                case 'currentLogin':
                    continue 2;
                    break;
                    
                case 'loginCount':
                    continue;
                    break;
                    
                case 'locked':
                    continue 2;
                    break;
                    
                case 'session':
                    continue 2;
                    break;
                    
                case 'autologin':
                    continue 2;
                    break;
                    
                case 'lb_isFulfilment':
                    continue 2;
                    break;
                    
                case 'lb_isFulfilmentSL':
                    continue 2;
                    break;
                    
                case 'lb_isContact':
                    continue 2;
                    break;
                    
                case 'login_lbTeam':
                    $setstring = $setstring." login = '".$value."',";
                    continue 2;
                    break;
                    
                case 'login_lbOne':
                    continue 2;
                    break;
                    
                case 'lb_isContactSL':
                    continue 2;
                    break;
                    
                case 'lb_staff_costTypes':
                    continue 2;
                    break;
                case 'save':
                    continue 2;
                    break;
                case 'start':
                    continue 2;
                    break;
                case 'stop':
                    continue 2;
                    break;
                case 'disable':
                    continue 2;
                    break;
                case 'lb_has_staff_costTypes':
                    continue 2;
                    break;
                    
                case 'lb_staff_competences':
                    continue 2;
                    break;
                    
                case 'lb_has_staff_competences':
                    continue 2;
                    break;
                case 'lb_inputTaxDeduction':
                    continue 2;
                    break;
                case 'homeDir':
                    continue 2;
                    break;
                case 'assignDir':
                    continue 2;
                    break;
                case 'merconis_favoriteProducts':
                    continue 2;
                    break;
                case 'VATID':
                    continue 2;
                    break;
                default:
                    if (strpos($key, 'alternative'))
                    {
                        continue 2;
                        break;
                    }
                    elseif (strpos($key, 'merconis'))
                    {
                        continue 2;
                        break;
                    }
                    else
                    {
                        $setstring = $setstring." ".$key." = '".$value."',";
                    }
                    
                    
            }
            
            
            
            
        }
        
        $setstring = rtrim($setstring, ", ");
        file_put_contents("dump2.txt",$id);
        $stmt =  $db->prepare("UPDATE tl_member SET ".$setstring." WHERE id = ?");
        $success = $stmt->execute(array($id));
        file_put_contents("dump.txt","UPDATE tl_member SET ".$setstring." WHERE id = ?");
        // $result_req = $stmt2->fetch();
        while ($row = $stmt2->fetch(PDO::FETCH_OBJ)) {
            // $data = $row[0]."\n";
            // $stmt = $db->prepare("SELECT id FROM tl_member WHERE id = ?");
            
            // file_put_contents("dump2.txt",print_r($dc->activeRecord->fetchAllAssoc()[0],TRUE),FILE_APPEND);
        }
        //file_put_contents("memver",$dc->activeRecord->username." : ".$dc->activeRecord->lastLogin." : ".$dc->activeRecord->id." : ".$dc->id);
        
        
    } else {
        
        
        $rows=$_POST;
        $keys=[];
        $values=[];
        foreach($rows as $key=>$value )
        {
            switch($key)
            {
                case 'id':
                    continue 2;
                    break;
                    
                case 'login':
                    continue 2;
                    break;
                case 'VERSION_NUMBER':
                    continue 2;
                    break;
                case 'password_confirm':
                    continue 2;
                    break;
                    
                    
                case 'REQUEST_TOKEN':
                    continue 2;
                    break;
                    
                case 'FORM_SUBMIT':
                    continue 2;
                    break;
                    
                case 'FORM_FIELDS':
                    continue 2;
                    break;
                    
                case 'lastLogin':
                    continue 2;
                    break;
                    
                case 'currentLogin':
                    continue 2;
                    break;
                    
                case 'loginCount':
                    continue;
                    break;
                    
                case 'locked':
                    continue 2;
                    break;
                    
                case 'session':
                    continue 2;
                    break;
                    
                case 'autologin':
                    continue 2;
                    break;
                    
                case 'lb_isFulfilment':
                    continue 2;
                    break;
                    
                case 'lb_isFulfilmentSL':
                    continue 2;
                    break;
                    
                case 'lb_isContact':
                    continue 2;
                    break;
                    
                case 'login_lbTeam':
                    
                    $keys[] ="login";
                    $values[] ="\"".$value."\"";;
                    continue 2;
                    break;
                    
                case 'save':
                    continue 2;
                    break;
                case 'start':
                    continue 2;
                    break;
                case 'stop':
                    continue 2;
                    break;
                case 'disable':
                    continue 2;
                    break;
                case 'login_lbOne':
                    continue 2;
                    break;
                    
                case 'lb_isContactSL':
                    continue 2;
                    break;
                    
                case 'lb_staff_costTypes':
                    continue 2;
                    break;
                    
                case 'lb_has_staff_costTypes':
                    continue 2;
                    break;
                    
                case 'lb_staff_competences':
                    continue 2;
                    break;
                    
                case 'lb_has_staff_competences':
                    continue 2;
                    break;
                case 'lb_inputTaxDeduction':
                    continue 2;
                    break;
                    
                case 'merconis_favoriteProducts':
                    continue 2;
                    break;
                case 'VATID':
                    continue 2;
                    break;
                default:
                    if (strpos($key, 'alternative'))
                    {
                        continue 2;
                        break;
                    }
                    elseif (strpos($key, 'merconis'))
                    {
                        continue 2;
                        break;
                    }
                    else
                    {
                        if(!empty($key)&&!empty($value)){
                            $keys[] =$key;
                            $values[] ="\"".$value."\"";
                        }
                    }
                    
                    
            }
            
            
            
            
        }
        $keystring = implode(",",$keys);
        $valuestring = implode(",",$values);
        $keystring = rtrim($keystring, ", ");
        $valuestring = rtrim($valuestring, ", ");
        $stmt =  $db->prepare("INSERT INTO tl_member (".$keystring.") VALUES (".$valuestring.") ");
        $success = $stmt->execute();
        
        
        
        
    }
    
}

public function syncRecordDelete(DataContainer $dc,$id)
{
    $di = new Doctrineinteractions();
    $db = $di->getConnection();
    $id = $dc->id;
    $stmt2 = $db->prepare("SELECT id,email FROM tl_member WHERE id = ?");
    $success = $stmt2->execute(array($id));
    $rows=$dc->activeRecord->fetchAllAssoc();
    $row = $stmt2->fetch(PDO::FETCH_OBJ);
    // $data = $row[0]."\n";
    // $stmt = $db->prepare("SELECT id FROM tl_member WHERE id = ?");
    
    
    file_put_contents("delete",$rows[0]['email'].$row->email);
    if($rows[0]['email']== $row->email)
    {
        $stmt =  $db->prepare("DELETE FROM tl_member WHERE id=?");
        $success = $stmt->execute(array($id));
        
    }
}
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function getCostTypeOptions()
    {
        $values = array();
        $costType = $this->Database->prepare("SELECT id, costType,measure FROM tl_lb_costType ORDER BY costType ASC ")->execute(1);
        while($costType->next())
        {
            $values[$costType->id] = "<b>".$costType->costType." | ".$costType->measure."</b> ";
        }
        return $values;
    }
    
    
}
