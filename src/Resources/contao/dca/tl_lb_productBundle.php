<?php





$GLOBALS['TL_DCA']['tl_lb_productBundle'] = array
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
                'bundleNr' => 'index'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        
        'default'                     => '{set_legend},bundleNr,bundleName,bundleDescription,packageItems,sumPriceAll,discount;'
        
    ),
    // Fields
    'fields' => array
    (
        
        
        'bundleNr' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['bundleNr'],
            'inputType' => 'text',
            'eval'      =>  array('maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL UNIQUE"
        ),
        'bundleName' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['bundleName'],
            'inputType' => 'text',
            'eval'      => array('tl_class'=>'w50','maxlength'=>255),
            'sql'       => "varchar(256) NOT NULL "
        ),
        'bundleDescription' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['bundleDescription'],
            'exclude' 		=> true,
            'inputType' 	=> 'textarea',
            'eval'      	=> array('tl_class'=>'clr wizard','rte'=>'tinyMCE'),
            'search'		=> true
        ),
        
    'packageItems' => array
        (
            'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productBundle']['packageItems'],
            'exclude' 		=> true,
            'inputType' 	=> 'multiColumnWizard',
            // 'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
            'eval' 			=> array
            (
                'columnFields' => array
                (
                    'product' => array
                    (

                            'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['productSelect'],
                            'exclude'               => true,
                            'inputType'             => 'select',
                        'eval'                  => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...'),
                            //'save_callback'           => array(array('tl_lb_productBundle_class','bundleSaveCallback')),
                            'options_callback'      => array('tl_lb_productBundle_class','bundleOptionsCallback'),
                    ),
                    'quantity' => array
                    (
                        
                        'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['quantity'],
                        'exclude'               => true,
                        'eval'                  => array('tl_class'=>'quantity'),
                        'inputType'             => 'text'

                    ),
                    'sellingUnit' => array
                    (
                        
                        'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['sellingUnit'],
                        'exclude'               => true,
                        'eval'                  => array('tl_class'=>'sUnit'),
                        'inputType'             => 'text'
                    ),
                    'price' => array
                    (
                        
                        'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['price'],
                        'exclude'               => true,
                        'eval'                  => array('tl_class'=>'price'),
                        'inputType'             => 'text'
                    ),
                    'sumprice' => array
                    (
                        
                        'label'                 => &$GLOBALS['TL_LANG']['tl_lb_productBundle']['sumprice'],
                        'exclude'               => true,
                        'eval'                  => array('tl_class'=>'ssumprice'),
                        'inputType'             => 'text'
                    ),
                    
                ),
                'tl_class'=>'needstofix'
            ),
            'sql' => "blob NULL"
        ),
        'sumPriceAll' => array 
        (
            'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productBundle']['sumPriceAll'],
            'exclude' 		=> true,
            'inputType' 	=> 'text',
            'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50 summAll'),
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        ),
        'discount' => array
        (
            'label'			=> &$GLOBALS['TL_LANG']['tl_lb_productBundle']['discount'],
            'exclude' 		=> true,
            'inputType' 	=> 'text',
            'eval'      =>  array('maxlength'=>10, 'rgxp'=>'numberWithDecimals','tl_class'=>'w50'),
            'sql'       => "int(10) unsigned NOT NULL default '0'"
        ),
        'id' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL auto_increment",
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        )
    ),
    // List
    'list' => array
    (
        'sorting' => array
        (
            
            'fields'                  => array('bundleNr','bundleName')
        ),
        'label' => array
        (
            'fields'                  => array('bundleNr','bundleName'),
            'showColumns'             => true
            
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



















class tl_lb_productBundle_class extends Backend
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
        $variant = $this->Database->prepare("SELECT tl_ls_shop_variant.id,tl_ls_shop_variant.lsShopVariantPrice as price,tl_ls_shop_variant.title, tl_ls_shop_variant.lb_sellingUnit,tl_ls_shop_variant.pid,tl_ls_shop_variant.lsShopVariantCode
FROM tl_ls_shop_variant
LEFT JOIN tl_ls_shop_product ON tl_ls_shop_product.id=tl_ls_shop_variant.pid
WHERE tl_ls_shop_product.published = 1 AND tl_ls_shop_variant.published = 1 ORDER BY lsShopVariantCode DESC")->execute();
$variantpid = array(); 
        while($product->next())
        {
    
            $values[$product->id] = $product->title."$".$product->price."$"."§".$product->lb_sellingUnit."§";

        }
        while($variant->next())
        { 
          /*  $insert=array( $variant->id."_".$variant->pid => "<b>".$variant->title."</b> " );
            $key = array_search($variant->pid,$values);
            $pos = array_search($key,array_keys($values));
            
            */
            $insert=array( $variant->pid."-".$variant->id => "Variante: ".$variant->title."$".$variant->price."$"."§".$variant->lb_sellingUnit."§" );

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
    
}