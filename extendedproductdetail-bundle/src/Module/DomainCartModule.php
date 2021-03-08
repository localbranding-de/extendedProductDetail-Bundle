<?php

namespace LocalbrandingDe\ExtendedProductDetailBundle\Module;

class DomainCartModule extends \Module
{
    /**
     * @var string
     */
    protected $strTemplate = 'apiCheck';
    
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
         //   $template->title = "yeez";
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
            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/lb_fe_domainCart.js';
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
           
            /* |cg|com\.bo|com\.do|com\.nr|com\.pe|com\.pr|com\.tt|co\.gg|co\.je|co\.tt|cz|ec|gg|gm|gr|gs|gt|info\.gg|info\.nr|info\.tt|je|ki|mn|ms|name\.gg|name\.tt|net\.bo|net\.do|net\.gg|net\.je|net\.nr|net\.pr|net\.tt|nr|org\.bo|org\.do|org\.gg|org\.je|org\.nr|org\.pe|org\.pr|org\.tt|pro\.tt|r
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

       
        /*
        $string="";
        $obj = new httpRequest("http://backend.antagus.de",80);
        $uri = "backend.antagus.de/bdom/domain/check/de/catpark/100064/";
        
        $string=$string."Unparsed response:\n";
        $string=$string.$obj->get($uri);
        $xml = file_get_contents("http://backend.antagus.de/bdom/domain/check/de/catpark/100064/");
        $resp = new httpResponse($obj->get($uri));
        $string=$string."Response Code: ".$resp->code()."\n";
        $string=$string."Response Body:\n";
        $string=$string.$resp->body()."\n";
        file_put_contents("api",$string);
       */
            
            
    }
    
    protected function domainToCart()
    {
        $group=$_POST['group'];
        $name=$_POST['name'];
        $prod = \Database::getinstance()->prepare('SELECT id,title,lb_sellingUnit,lb_isDiscount FROM tl_ls_shop_product WHERE alias = ?')->execute("domain-".$group);
        $prodId=$prod->id;
        $prodId=$prodId."_0";
        if(isset($_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]))
        {
            if(in_array($name.".".$group,$_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['domains']))
            {
                
            }
            else
            {
            $_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['quantity']=$_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['quantity']+$prod->lb_sellingUnit;
            array_push($_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]['domains'],$name.".".$group);
            }
        }
        else
        {
            $_SESSION['lsShopCart']['items'][$prodId."_unknownConfiguratorHash"]= ['quantity'=>$prod->lb_sellingUnit,'scalePriceKeyword'=>"","domains"=>[$name.".".$group]];
        }
       
        echo "1";
        exit;
        
    }
    protected function removeDomainFromCart()
    {
       
        $name=$_POST['name'];
        $domains=explode(".",$name);
        $group=end($domains);
        $prod = \Database::getinstance()->prepare('SELECT id,title,lb_sellingUnit,lb_isDiscount FROM tl_ls_shop_product WHERE alias = ?')->execute("domain-".$group);
        $prodId=$prod->id;
        $prodId=$prodId."_0";
        foreach($_SESSION['lsShopCart']['items'] as $key1 => $item){
            foreach($item['domains'] as $key2 => $domain)
            {
                if($domain==$name)
                {
                    if(1>=count($_SESSION['lsShopCart']['items'][$key1]['domains']))
                    {
                        unset($_SESSION['lsShopCart']['items'][$key1]);
                    }
                    else
                    {
                        unset($_SESSION['lsShopCart']['items'][$key1]['domains'][$key2]);
                        $_SESSION['lsShopCart']['items'][$key1]['quantity'] = $_SESSION['lsShopCart']['items'][$key1]['quantity']-12;
                    }
                   
                }
            }
            
        } 
        echo 1;
        exit;
        }
       
        

          
    
}
