<?php

namespace LocalbrandingDe\ExtendedProductDetailBundle\Module;

class BundleHandlerModule extends \Module
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

            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/lb_fe_bundleHandler.js';
           
            // fullcalendar 3.9.0
            //$assets_fc = '/fullcalendar-3.9.0';
            // font-awesome 4.7.0
            //$assets_fa = '/font-awesome-4.7.0';
           // if ($objPage->hasJQuery == '1') {
                //  $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/lib/jquery.min.js|static';
           // }
            // Load jQuery if not active
            //if ($objPage->hasJQuery !== '1') {
                //  $GLOBALS['TL_JAVASCRIPT'][] = $assets_path . $assets_fc . '/lib/jquery.min.js|static';
            //}
           
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
    //    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      //  $this->Template->url = $actual_link;
        

            
            
            
        }
        
        
        
        
        
        
        protected function changeQuantity()
        {
            
            if (isset($_POST['item'])&&isset($_POST['quantity'])) {
             
                $item=$_POST['item'];
                $quantity= $_POST['quantity'];
                $isProduct=true;
                $product=\Database::getinstance()->prepare('SELECT id,lb_sellingUnit FROM tl_ls_shop_product WHERE lsShopProductCode = ?')->execute($item);
                if(!($product->numRows > 0))
                {
                    $product=\Database::getinstance()->prepare('SELECT id,pid,lb_sellingUnit FROM tl_ls_shop_variant WHERE lsShopVariantCode = ?')->execute($item);
                    $isProduct=false;
                    if(isset($_SESSION['bundles']['items'][$product->pid.'_'.$product->id]['bundles']))
                    {
                        $bundles = $_SESSION['bundles']['items'][$product->pid.'_'.$product->id]['bundles'];
                        $bundlevals=array_count_values($_SESSION['bundles']['items'][$product->pid.'_'.$product->id]['bundles']);
                        
                        
                        foreach($bundlevals as $key => $value)
                        {
                            $items=\Database::getinstance()->prepare('SELECT id,packageItems FROM tl_lb_productBundle WHERE id = ?')->execute($key);
                            while($items->next())
                            {
                                
                                
                                foreach(unserialize($items->packageItems) as $item)
                                {
                                    if($item['product']==$product->pid."-".$product->id)
                                    {
                                        $minQuan = ($item['quantity'] * $item['sellingUnit'])*$value;
                                        
                                    }
                                }
                            }
                            
                            
                            if($product->lb_sellingUnit > $quantity)
                            {
                                
                                $return = 2;
                            }
                            else
                            {
                                
                                
                                
                                
                                if($minQuan > $quantity)
                                {
                                    
                                    $_SESSION['bundles']['highlighted'][0]=end($_SESSION['bundles']['items'][$product->pid.'_'.$product->id]['bundles']);
                                    
                                    $return = 0;
                                    
                                }
                                else
                                {
                                    $return = 1;
                                }
                                
                            }
                        }
                        
                        
                        
                        
                        
                        
                        
                    }
                    
                    
                    else
                    {
                        
                        if($product->lb_sellingUnit > $quantity)
                        {
                            
                            $return = 2;
                        }
                        else
                        {
                            $return = 3;
                        }
                    }
                }
                else
                {
                if(isset($_SESSION['bundles']['items'][$product->id.'_0']['bundles']))
                {
                    $bundles = $_SESSION['bundles']['items'][$product->id.'_0']['bundles'];
                    $bundlevals=array_count_values($_SESSION['bundles']['items'][$product->id.'_0']['bundles']);
           
                    
                    foreach($bundlevals as $key => $value)
                    {
                        $items=\Database::getinstance()->prepare('SELECT id,packageItems FROM tl_lb_productBundle WHERE id = ?')->execute($key);
                        while($items->next())
                        {
                            
                            
                            foreach(unserialize($items->packageItems) as $item)
                            {
                                if($item['product']==$product->id)
                                {
                                    $minQuan = ($item['quantity'] * $item['sellingUnit'])*$value;
                                    
                                }
                            }
                        }
                        file_put_contents("fe",$product->id."minquan : ".$item['quantity']."  quan:".$item['sellingUnit']);
                        
                        if($product->lb_sellingUnit > $quantity)
                        {
                            
                            $return = 2;
                        }
                        else
                        {
                            
                            
                            
                            
                            if($minQuan > $quantity)
                            {
                                
                                $_SESSION['bundles']['highlighted'][0]=end($_SESSION['bundles']['items'][$product->id.'_0']['bundles']);
                                
                                $return = 0;
                                
                            }
                            else
                            {
                                $return = 1;
                            }
                            
                        }
                    }
                    
                    
                    
                    
   

                
                }
                
                
                else
                {
                   
                        if($product->lb_sellingUnit > $quantity)
                        {
                           
                            $return = 2;
                        }
                        else
                        {
                            $return = 3;
                        }
                }
                }
                echo($return);
                
                exit;
                
            }
   
         }
         
         protected function removeItem()
         {
             if (isset($_POST['item'])) {
                 $isProduct=true;
                 $item=$_POST['item'];

                 $product=\Database::getinstance()->prepare('SELECT id FROM tl_ls_shop_product WHERE lsShopProductCode = ?')->execute($item);
                 
                 if(($product->numRows == 0))
                 {
                     $product=\Database::getinstance()->prepare('SELECT id,pid FROM tl_ls_shop_variant WHERE lsShopVariantCode = ?')->execute($item);
                     $isProduct=false;
                 }
                 if($isProduct)
                 {
                 if(sizeof($_SESSION['bundles']['items'][$product->id.'_0']['bundles'])<1)
                 {
                     echo(1);
                 }
                 else
                 {
                     $_SESSION['bundles']['highlighted'][0]=$_SESSION['bundles']['items'][$product->id.'_0']['bundles'][0];
                     echo(0);
                 }
                 }
                 else
                 {
                     if(sizeof($_SESSION['bundles']['items'][$product->pid.'-'.$product->id]['bundles'])<1)
                     {
                         echo(1);
                     }
                     else
                     {
                         $_SESSION['bundles']['highlighted'][0]=$_SESSION['bundles']['items'][$product->pid.'-'.$product->id]['bundles'][0];
                         echo(0);
                     }
                 }
               
                 exit;
                 
             }
             
         }
        
         protected function removeBundle()
         {

                 
              
                 $bundle = $_SESSION['bundles']['highlighted'][0];
                 $items=\Database::getinstance()->prepare('SELECT id,packageItems FROM tl_lb_productBundle WHERE id = ?')->execute($bundle);
                // $discount=end(unserialize($items->packageItems))['product'];
                 $discounts=unserialize($items->packageItems);
                 foreach($discounts as $disc)
                 {
                     $product=\Database::getinstance()->prepare('SELECT id,lb_isDiscount FROM tl_ls_shop_product WHERE id = ?')->execute($disc['product']);
                     if($product->lb_isDiscount==1){
                         $discount=$disc['product'];
                     }
                 }
                 
                 if($discount){
                 $bundleRemove=$_SESSION['bundles']['items'][$discount.'_0']['bundles'][0];
                 foreach($_SESSION['bundles']['items'] as $key => $item)
                 {
                     if(in_array($bundleRemove,$item['bundles']))
                     {
                         unset($_SESSION['bundles']['items'][$key][array_search($bundleRemove,$item['bundles'])]);
                     }
                 }
                 if($_SESSION['lsShopCart']['items'][$discount."_0_unknownConfiguratorHash"]['quantity']==1)
                 {
                 unset($_SESSION['bundles']['items'][$discount.'_0']);
                 
                 
                 unset($_SESSION['lsShopCart']['items'][$discount."_0_unknownConfiguratorHash"]);
                 }
                 else
                 {
                     unset($_SESSION['bundles']['items'][$discount.'_0']['bundles'][array_key_last($_SESSION['bundles']['items'][$discount.'_0']['bundles'])]);
                     
                     
                     $_SESSION['lsShopCart']['items'][$discount."_0_unknownConfiguratorHash"]['quantity']=$_SESSION['lsShopCart']['items'][$discount."_0_unknownConfiguratorHash"]['quantity']-1;
                     
                     
                 }
                 }
                 foreach($_SESSION['bundles']['items'] as $key=>$item)
                 {
                     if(in_array($bundle,$item['bundles']))
                     {
                         $k= array_search($bundle,$item['bundles']);
                         unset($_SESSION['bundles']['items'][$key]['bundles'][$k]);
                     }
                 }

                 unset(  $_SESSION['bundles']['inCart'][array_search($bundle,$_SESSION['bundles']['inCart'])]);
                 unset($_SESSION['bundles']['highlighted']);
                 exit;
                 
             
             
         }
         protected function removeAllFromCart()
         {
             
             
             unset( $_SESSION['bundles']);
             unset($_SESSION['lsShopCart']['items']);
             exit;
             
             
             
         }
         
         
    
    
}