<?php



$GLOBALS['TL_DCA']['tl_lb_productCalculation'] = array
(
    
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),
//Palettes

    
    'palettes' => array
    (
        
        'default'                     => '{lbcostTypeProduct_legend},product,lb_consultantShare;{lbcostType_legend},lb_expensesOnce,lb_expensesRecurr,lb_sumPurchasePriceOnce,lb_sumPurchasePriceRecurr;'
        
    ),
    'subpalettes' => array
    (
        
        'lb_expensesOnce'                     => 'lb_costTypeOnceList',
        'lb_expensesRecurr'                     => 'lb_costTypeRecurrList'
        
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            
            'fields'                  => array('product')
        ),
        'label' => array
        (
            'fields'                  => array('product'),
            'showColumns'             => true,
            'label_callback'   => array('tl_lb_productCalculation_class','label_callback')
            
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_costType']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_costType']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.svg'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_lb_fontAdmission']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.svg',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    )
    
    
    
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_expensesOnce'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_expensesOnce'],
    'exclude'                 => true,
    'eval'                    => array('submitOnChange'=>true),
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_expensesRecurr'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_expensesRecurr'],
    'exclude'                 => true,
    'eval'                    => array('submitOnChange'=>true),
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['tstamp']= array
(
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['id']= array
( 'sql'                 => "int(10) unsigned NOT NULL auto_increment",
);
$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['product']= array
(
    
    'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['product'],
    'exclude'               => true,
    'inputType'             => 'select',
    'eval'                  => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...'),
    //'save_callback'           => array(array('tl_lb_productBundle_class','bundleSaveCallback')),
    'options_callback'      => array('tl_lb_productCalculation_class','bundleOptionsCallback'),
    'sql'       => "int(10) NOT NULL UNIQUE"
);


$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_costTypeOnceList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_costTypeOnceList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'costTypeOnce' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['costTypeOnce'],
                'inputType' => 'select',
                'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'costType_select wizard','maxlength'=>255),
                'options_callback' => array('tl_lb_productCalculation_class', 'getCostTypeOptions'),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'costTypeOnceDescription' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['costTypeOnceDescription'],
                'exclude' 		=> true,
                'inputType' 	=> 'textarea',
                'eval'      	=> array('tl_class'=>'costType_description wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
            'revisionLoops' => array
            (
                'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['revisionLoops'],
                'exclude' 		=> true,
                'inputType' 	=> 'text',
                'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'costType_revisionLoops'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePriceOnce' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchasePriceOnce'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'price','maxlength'=>10, 'rgxp'=>'numberWithDecimals'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchaseQuantityOnce' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchaseQuantityOnce'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'quantity','maxlength'=>10, 'rgxp'=>'natural'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePrice' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchasePrice'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'endPrice','maxlength'=>10, 'rgxp'=>'numberWithDecimals','disabled'=>true),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),

        ),
    ),
    'sql' => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_costTypeRecurrList']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_costTypeRecurrList'],
    'exclude' 		=> true,
    'inputType' 	=> 'multiColumnWizard',
    // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'tl_class'  => '',
        'columnFields' => array
        (
            'costTypeRecurr' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['costTypeRecurr'],
                'inputType' => 'select',
                'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','tl_class'=>'costType_select wizard','maxlength'=>255),
                'options_callback' => array('tl_lb_productCalculation_class', 'getCostTypeOptions'),
                'sql'       => "varchar(256) NOT NULL default 'Accordeon Label'"
            ),
            'costTypeRecurrDescription' => array
            (
                'label'     	=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['costTypeRecurrDescription'],
                'exclude' 		=> true,
                'inputType' 	=> 'textarea',
                'eval'      	=> array('tl_class'=>'costType_description wizard','rte'=>'tinyMCE'),
                'search'		=> true
            ),
            'revisionLoops' => array
            (
                'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['revisionLoops'],
                'exclude' 		=> true,
                'inputType' 	=> 'text',
                'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'costType_revisionLoops'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePriceRecurr' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchasePriceRecurr'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'price','maxlength'=>10, 'rgxp'=>'numberWithDecimals'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchaseQuantityRecurr' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchaseQuantityRecurr'],
                'inputType' => 'text',
                'eval'      =>  array('maxlength'=>10,'tl_class'=>'quantity', 'rgxp'=>'natural'),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),
            'purchasePrice' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['purchasePrice'],
                'inputType' => 'text',
                'eval'      =>  array('tl_class'=>'endPrice','maxlength'=>10, 'rgxp'=>'numberWithDecimals','disabled'=>true),
                'sql'       => "int(10) unsigned NOT NULL default '0'"
            ),

        ),
    ),
    'sql' => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_sumPurchasePriceOnce']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_sumPurchasePriceOnce'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_sumPurchasePriceRecurr']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_sumPurchasePriceRecurr'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 text','disabled'=>true),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);




$GLOBALS['TL_DCA']['tl_lb_productCalculation']['fields']['lb_consultantShare']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productCalculation']['lb_consultantShare'],
    'exclude' 		=> true,
    'inputType' 	=> 'text',
    'eval'      =>  array('maxlength'=>10,'tl_class'=>'w50 text','rgxp'=>'numberWithDecimals'),
    'sql'       => "varchar(256)  NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_lb_productCalculation']['palettes']['__selector__'][] = 'lb_expensesOnce';
$GLOBALS['TL_DCA']['tl_lb_productCalculation']['palettes']['__selector__'][] = 'lb_expensesRecurr';









class tl_lb_productCalculation_class extends Backend
{
    public function array_splice_assoc(&$input, $offset, $length, $replacement = array()) {
        $replacement = (array) $replacement;
        $key_indices = array_flip(array_keys($input));
        if (isset($input[$offset]) && is_string($offset)) {
            $offset = $key_indices[$offset];
        }
        if (isset($input[$length]) && is_string($length)) {
            $length = $key_indices[$length] - $offset;
        }
        
        $input = array_slice($input, 0, $offset, TRUE)
        + $replacement
        + array_slice($input, $offset + $length, NULL, TRUE);
    }
    
    
    
   
    

    
    
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function bundleOptionsCallback()
    {
        $values = array();
        $product = $this->Database->prepare("SELECT id,title,lsShopProductCode,lsShopProductPrice as price,lb_sellingUnit FROM tl_ls_shop_product WHERE published = ? ORDER BY lsShopProductCode ASC")->execute(1);
        $variant = $this->Database->prepare("SELECT tl_ls_shop_variant.id,tl_ls_shop_variant.title,tl_ls_shop_variant.pid,tl_ls_shop_variant.lsShopVariantCode
FROM tl_ls_shop_variant
LEFT JOIN tl_ls_shop_product ON tl_ls_shop_product.id=tl_ls_shop_variant.pid
WHERE tl_ls_shop_product.published = 1 AND tl_ls_shop_variant.published = 1 ORDER BY lsShopVariantCode DESC")->execute();
$variantpid = array(); 
        while($product->next())
        {
    
            $values[$product->id] = $product->title;

        }
        while($variant->next())
        { 
          /*  $insert=array( $variant->id."_".$variant->pid => "<b>".$variant->title."</b> " );
            $key = array_search($variant->pid,$values);
            $pos = array_search($key,array_keys($values));
            
            */
            $insert=array( $variant->pid."-".$variant->id => "Variante: ".$variant->title);

            $pos = array_search($variant->pid,array_keys($values));
            $this->array_splice_assoc($values,$pos+1,0,$insert);
            if(!in_array($variant->pid,$variantpid) )
            {
            $variantpid[]=$variant->pid;
            }
           // $values[$variant->id."_".$variant->pid] = "<b>".$variant->title."</b> ";
           
        }
        foreach($variantpid as $pid)
        {
            $values[$pid]= $values[$pid]."/_/";
        }
        return $values;
    }
    
    
    public function label_callback($arr,$label, DataContainer $dc)
    {
        
       $title= $this->Database->prepare("SELECT title FROM tl_ls_shop_product WHERE id=?")->execute($label)->title;
        
        //$this->Database->prepare("INSERT INTO tl_lb_member_00_shop_products(lb_memberid, lb_productid) VALUES (?,?)")->execute($dc->id,$varValue);
        //$vals= $dc->getAttributesFromDca($dc);
        //foreach($vals as $val)
        //{
        //   file_put_contents("cache_file",$val."\n",FILE_APPEND);
        //}
        $label=$title;
        return $label;
    }

    public function bundleSaveCallback($varValue, MultiColumnWizard $dc)
    {
        //$this->Database->prepare("INSERT INTO tl_lb_member_00_shop_products(lb_memberid, lb_productid) VALUES (?,?)")->execute($dc->id,$varValue);
        //$vals= $dc->getAttributesFromDca($dc);
        //foreach($vals as $val)
        //{
        //   file_put_contents("cache_file",$val."\n",FILE_APPEND);
        //}
        return $varValue;
    }
    public function getCostTypeOptions()
    {
        $values = array();
        $costType = $this->Database->prepare("SELECT id, costType,measure,costPerMinute FROM tl_lb_costType ORDER BY costType ASC ")->execute(1);
        while($costType->next())
        {
            if($costType->costPerMinute != 0)
            {
                $values[$costType->id] = "<b>".$costType->costType." | ".$costType->measure." ".$costType->costPerMinute."</b>";
            }
           else
           {
               $values[$costType->id] = "<b>".$costType->costType." | ".$costType->measure."</b>";
           }
        }
        return $values;
    }
    
}