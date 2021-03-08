<?php

namespace LocalbrandingDe\ExtendedProductDetailBundle\Module;

class BundleButtonModule extends \Module
{
    /**
     * @var string
     */
    protected $strTemplate = 'lb_bundleButton';
    
    /**
     * Displays a wildcard in the back end.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $template = new \BackendTemplate('be_wildcard');
            
            $template->wildcard = '### '.utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['helloWorld'][0]).' ###';
            //$template->title = $this->headline;
            $template->title = "yeez";
            $template->id = $this->id;
            $template->link = $this->name;
            $template->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;
            
            return $template->parse();
        }
        
        return parent::generate();
    }
    
    /**
     * Generates the module.
     */
    protected function compile()
    {
        /** @var \PageModel $objPage */
        global $objPage;

        if (isset($_POST['type'])) {
            /**
             * if $_POST['type']) is set then we have to handle ajax calls from fullcalendar
             *
             * We check if the given $type is an existing method
             * - if yes then call the function
             * - if no just do nothing right now (for the moment)
             */
            $type = $_POST['type'];
            if (method_exists($this, $type)) {
                $this->$type();
            }
        } else {
            
            // calendar-extended-bundel assets
            $assets_path = '/bundles/extendedproductdetail';
            // JS files
            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/lb_fe_bundleButton.js';
            // fullcalendar 3.9.0
            //$assets_fc = '/fullcalendar-3.9.0';
            // font-awesome 4.7.0
            //$assets_fa = '/font-awesome-4.7.0';
            if ($objPage->hasJQuery == '1') {
                //  $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/lib/jquery.min.js|static';
            }
            // Load jQuery if not active
            if ($objPage->hasJQuery !== '1') {
                //  $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/lib/jquery.min.js|static';
            }
           
            /*
             // CSS files
             $GLOBALS['TL_CSS'][] = $assets_path . $assets_fa . '/css/font-awesome.min.css';
             $GLOBALS['TL_CSS'][] = $assets_path . $assets_fc . '/fullcalendar.min.css';
             
             
             $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/fullcalendar.min.js';
             $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/gcal.min.js';
             $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/locale-all.js';
             
             
             
             
             
             // Set the formular
             // $objTemplate->event_formular = \Form::getForm(1);
             
             // Render the template
             $this->Template->fullcalendar = $objTemplate->parse();
             */
        }
        
        // Set Url
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->Template->url = $actual_link;
        

            
            
            
        }
        
        
        
        
        
        
        protected function bundleToCart()
        {
            if (isset($_POST['bundleNr'])) {
       
                $bundle=$_POST['bundleNr'];
                $bundleIds=array();
                $items=\Database::getinstance()->prepare('SELECT id,packageItems FROM tl_lb_productBundle WHERE id = ?')->execute($bundle);
                if(isset($_SESSION['bundles']['inCart']))
                {
                    if(in_array($bundle,$_SESSION['bundles']['inCart']))
                    {
                        echo 0;
                        exit;
                    }
                }
             
                while($items->next())
                {
                    
                    if(isset($_SESSION['bundles']['items'][$prodId]['bundles']))
                    {
                        if(in_array($bundle,$_SESSION['bundles']['items'][$prodId]['bundles']))
                        {
                            echo 0;
                            exit;
                        }
                    }
                    foreach(unserialize($items->packageItems) as $item)
                    {
                       
                        $prodId=$item['product'];
                        $quantity=$item['quantity'];
                        $sellingUnit=$item['sellingUnit'];
                        $isProduct=strpos($prodId,'-');
                      
                        if($isProduct)
                        {
                           // $varId= explode("-",$prodId)[0];
                           $varId = substr($prodId,-strpos($prodId,"-"));
                            $prod = \Database::getinstance()->prepare('SELECT id,pid,title,lb_sellingUnit FROM tl_ls_shop_variant WHERE id = ?')->execute($varId);
                        
                            
                        }
                        else
                        {
                            
                        $prod = \Database::getinstance()->prepare('SELECT id,title,lb_sellingUnit,lb_isDiscount FROM tl_ls_shop_product WHERE id = ?')->execute($prodId);
                        $prodId=$prodId."_0";
                        
                        }
    
        
                        
                        if(isset($_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]))
                        {
                            $_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['quantity']=$_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['quantity']+($prod->lb_sellingUnit*$quantity);
                        }
                        else
                        {
                            $_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]= ['quantity'=>($prod->lb_sellingUnit*$quantity),'scalePriceKeyword'=>"" ];
                        }
                        if($prod->lb_isDiscount)
                        {
                            $_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['isDiscount'] = 1;
                        }
                        $bundleIds[]=$prodId;
                        if(!isset($_SESSION['bundles']['items'][$prodId]['bundles']))
                        {
                            $_SESSION['bundles']['items'][$prodId]['bundles']= array();
                        }
                        
                        array_push($_SESSION['bundles']['items'][$prodId]['bundles'],$bundle);
                       // file_put_contents('test', print_r($item,TRUE),FILE_APPEND);
                        continue;
                    }
                    
                } 

                $_SESSION['bundles']['inCart'][]=$bundle;
                    
                    
                    
                    
                
                
                $discounts=array();
              foreach($_SESSION['lsShopCart']['items'] as $itemID => $item)
                {
                    if($item['isDiscount'])
                    {
                        $discounts[$itemID]=$item;
                        unset($_SESSION['lsShopCart']['items'][$itemID]);
                        
                        $_SESSION['lsShopCart']['items'][$itemID]=$item;
                       
                    }
                }
                
                echo(json_encode($_SESSION['bundles']));
                
                exit;
                
            }
   
         }
    
    
}