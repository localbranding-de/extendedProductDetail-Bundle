<?php
/**
 * Table tl_ls_shop_variant
 */


//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default']=str_replace('flex_contentsLanguageIndependent;','flex_contentsLanguageIndependent;{lb_priceBoxLegend},lb_inPriceHeader1,lb_inPriceText1,lb_inPriceHeader2,lb_inPriceText2,lb_inPriceHeader3,lb_inPriceText3;{lb_Tab1Legend},lb_productTab1,lb_productTab1_text,lb_productTab1_accordList;{lb_Tab2Legend},lb_productTab2,lb_productTab2_text,lb_productTab2_accordList;{lb_Tab3Legend},lb_productTab3,lb_productTab3_text,lb_productTab3_accordList;',$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default'] );


//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default']=str_replace('useScalePrice,','lb_priceComment,lb_sellingUnit,useScalePrice,',$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default'] );





$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default'] = str_replace('{lsShopImages_legend},','{lsShopConsulting},lb_isConsulting,lb_dependantProduct;{lsShopImages_legend},',$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default']=str_replace('lb_dependantProduct','lb_timeContract,lb_revisionLoops,lb_hasMaxOneJob,lb_isDownloadProduct,lb_dependantProduct',$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['default'] );

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['subpalettes']['lb_timeContract'] ='lb_timeContractPeriodInDays,lb_timeContractNoticePeriodInDays';
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['__selector__'][] ='lb_dependantProduct';
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['__selector__'][] ='lb_timeContract';

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['subpalettes']['lb_isConsulting'] ='lb_Duration';
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['subpalettes']['lb_dependantProduct'] ='lb_dependantProductID';
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['palettes']['__selector__'][] ='lb_isConsulting';












// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_hasMaxOneJob'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_hasMaxOneJob'],
    'inputType' => 'checkbox',
    'eval'      => array('feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_isConsulting'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_isConsulting'],
    'inputType' => 'checkbox',
    'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_dependantProduct'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_dependantProduct'],
    'inputType' => 'checkbox',
    'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_timeContract'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_timeContract'],
    'inputType' => 'checkbox',
    'eval'      => array( 'submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'sql'       => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_Duration'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_Duration'],
    'inputType' => 'select',
    'eval'      => array('feGroup'=>'lb_isConsulting','includeBlankOption' => true,'mandatory' => true ,'blankOptionLabel' => 'Bitte wählen ...','feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'options_callback'  => array('lb_productClass', 'myOptionsCallback'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_dependantProductID'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_dependantProductID'],
    'inputType' => 'select',
    'eval'      => array('feGroup'=>'lb_dependantProduct','includeBlankOption' => true,'mandatory' => true ,'blankOptionLabel' => 'Bitte wählen ...','feEditable'=>true, 'feViewable'=>true),
    'foreignKey'=> 'tl_ls_shop_variant.title',
    'sql'       => "int(10) unsigned NOT NULL"
);






// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceHeader1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceHeader1'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header1'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceHeader2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceHeader2'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header2'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceHeader3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceHeader3'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Header3'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceText1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceText1'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceText2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceText2'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_inPriceText3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_inPriceText3'],
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab1'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab1'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Paket-Bestandteile'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab1_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab1_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab1_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab1_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab1_accordHeader' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab1_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab1_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab1_accordContent'],
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


$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab2'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab2'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Alles inklusive'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab2_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab2_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab2_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab2_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab2_accordHeader' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab2_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab2_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab2_accordContent'],
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

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab3'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab3'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'Ablauf'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab3_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab3_text'],
    'exclude' => true,
    'inputType'               => 'textarea',
    'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
    'search'		=> true,
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_productTab3_accordList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab3_accordList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'lb_productTab3_accordHeader' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab3_accordHeader'],
                'inputType' => 'text',
                'eval'      => array('tl_class'=>'wizard accordHeader','maxlength'=>255),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'lb_productTab3_accordContent' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_productTab3_accordContent'],
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

//Legenden hinzuf�gen


$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_timeContractPeriodInDays']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_timeContractPeriodInDays'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_timeContractNoticePeriodInDays']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_timeContractNoticePeriodInDays'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_revisionLoops']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_revisionLoops'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'long'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_isDownloadProduct']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_isDownloadProduct'],
    'exclude' 		=> true,
    'eval'      => array( 'feEditable'=>true, 'feViewable'=>true,'tl_class'=>'long'),
    'inputType' => 'checkbox',
    'sql'       => "char(1) NOT NULL default ''"
);




$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_priceComment'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_priceComment'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default 'priceComment'"
);

$GLOBALS['TL_DCA']['tl_ls_shop_variant']['fields']['lb_sellingUnit'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_ls_shop_variant']['lb_sellingUnit'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50'),
    'sql'       => "int(10) NOT NULL default '1'"
);




class tl_lb_variant_class extends Backend
{
    
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $basetime = 15;
        
        for($i =1; ($i*$basetime)<=180;$i++)
        {
            $time= $i*$basetime;
            $values[$i] = "<b>".$time." Minuten</b> ";
        }
        return $values;
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
