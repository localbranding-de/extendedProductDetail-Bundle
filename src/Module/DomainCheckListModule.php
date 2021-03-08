<?php

namespace LocalbrandingDe\ExtendedProductDetailBundle\Module;

class DomainCheckListModule extends \Module
{
    /**
     * @var string
     */
    protected $strTemplate = 'apiCheckList';
    
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
            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/lb_fe_domainCheckList.js';
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
        $name=$_SESSION['domains']['lastSearched']['name'];
        $av=$_SESSION['domains']['lastSearched']['av'];
        $value= $_SESSION['domains']['lastSearched']['value'];
        $tld= $_SESSION['domains']['lastSearched']['tld'];
        $this->Template->searchedDomainName =$name;
        $this->Template->searchedDomainValue =$value;
        $this->Template->searchedDomainStatus =$av;
        $this->Template->searchedDomainTld =$tld;
        $result=\Database::getinstance()->prepare('SELECT id,lsShopProductPrice,lb_limitation,lb_sellingUnit FROM tl_ls_shop_product WHERE alias = ?')->execute("domain-".$tld);
        $this->Template->searchedDomainPrice=str_replace('.',',',substr($result->lsShopProductPrice,0,  - 2));
        $this->Template->searchedDomainSellingUnit=$result->lb_sellingUnit;
        if($result->lb_limitation)
        {
            $this->Template->searchedDomainNote=$result->lb_limitation;
        }
       
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
             echo(2);
             exit;
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
    
        protected function allCheck($name,$domains)
        {
            
            $arr=[];
            foreach($domains as $domain)
            {
                $status = $this->topCheck($name,$domain);
                $arr[$domain]["status"]= (string) $status;
            }
            file_put_contents("api",print_r($arr,TRUE)); 
            return $arr;
            
        } 
        
        protected function topCheck($name,$dm)
        {
            
            $xmlstr = file_get_contents("http://backend.antagus.de/bdom/domain/check/".$dm."/".$name."/100064/");
            $xml=simplexml_load_string($xmlstr);
            $status=$xml->status;
            file_put_contents("xml",print_r($xml,TRUE));
            file_put_contents("status",$status);
            return $status;
        } 
        protected function loadMore()
        {

            $name=$_SESSION['domains']['lastSearched']['value'];
            $msg=0;
           $skip = 5;
           $group = $_POST['group'];
           $c = $_POST['c'];
           $topDomains = ["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop"];
           $euDomains= ["at","be","ch","de","dk","es","eu","fr","it","li","me","nl","uk"];
           $regionDomains = ["bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien"];
           $newDomains = ["academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
           switch($group)
           {
               case "top":
                   $arr= array_slice($topDomains,$skip*$c,$skip);
                   $thisarr=$topDomains;
                   break;
               case "eu":
                   $arr= array_slice($euDomains,$skip*$c,$skip);
                   $thisarr=$euDomains;
                   break;
               case "region":
                   $arr=array_slice($regionDomains,$skip*$c,$skip);
                   $thisarr=$regionDomains;
                   break;
               case "new":
                   $arr= array_slice($newDomains,$skip*$c,$skip);
                   $thisarr=$newDomains;

                   break;
                   
                   
           }
           array_slice($arr,$skip*$c);
           if(intval($skip*$c+$skip)>=count($thisarr))
           {
               $msg=1;
           }
           file_put_contents("xmml",intval($skip*$c+$skip).count($thisarr));
           $result=$this->allCheck($name,$arr);
           foreach($arr as $item)
           {
               
               $price=\Database::getinstance()->prepare('SELECT id,lsShopProductPrice,lb_limitation  FROM tl_ls_shop_product WHERE alias = ?')->execute("domain-".$item);
               $result[$item]["price"]=str_replace('.',',',substr( $price->lsShopProductPrice,0, - 2));
               $result[$item]['value']=$name;
               $result[$item]['limitation']=$price->lb_limitation;
           }
           $result['msg']=$msg;
           echo(json_encode($result));
           exit; 
        }
        protected function domainGroupCheck()
        {
            $skip = 5;
            $allDomains =["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop","at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk","bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien","academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
            $topDomains = ["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop"];
            $euDomains= ["at","be","ch","de","dk","es","eu","fr","it","li","me","nl","uk"];
            $regionDomains = ["bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien"];
            $newDomains = ["academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
            $name=$_SESSION['domains']['lastSearched']['value'];
            $group=$_POST['group'];
            switch($group)
            {
                case "top":
                    $arr=array_slice($topDomains,0,$skip);
                    $return= $this->allCheck($name, $arr);
                    
                    break;
                case "eu":
                    $arr=array_slice($euDomains,0,$skip);
                    $return= $this->allCheck($name,$arr);
                    break;
                case "region":
                    $arr=array_slice($regionDomains,0,$skip);
                    $return=$this->allCheck($name,$arr);
                    break;
                case "new":
                    $arr=array_slice($newDomains,0,$skip);
                    $return= $this->allCheck($name,$arr);
                    break;
                    
                    
            }

            foreach($arr as $item)
            { 
                
                $price=\Database::getinstance()->prepare('SELECT id,lsShopProductPrice,lb_limitation  FROM tl_ls_shop_product WHERE alias = ?')->execute("domain-".$item);
                $return[$item]["price"]=str_replace('.',',',substr($price->lsShopProductPrice,0,  - 2));
                $return[$item]['value']=$name;
                $return[$item]['limitation']=$price->lb_limitation;
            }
           
            echo(json_encode($return));
          
            
            exit;
              // return [$status,$msg];
            
            
        }
        
        protected function domainCheck()
        {
            $name=$_POST['name'];
            $allDomains =["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop","at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk","bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien","academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning"];
            $topDomains = ["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop"];
            $euDomains= ["at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk"];
            $regionDomains = ["bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien"];
            $newDomains = ["academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning"];
            $domains=explode(".",$name);
            $status;
            $msg;
            $flag=0;
            if(in_array(end($domains),$allDomains)&& count($domains)>1)
            {
                $dmName= str_replace(".".end($domains),"",$name);


                $msg= $dmName.".".end($domains);
                
            }
            else
            {
                $flag=1;

                $msg=$name.".de";
            }
           
            if($flag==1)
            {
                $this->allCheck($name);
            }
            else
            {
                $this->allCheck($dmName);
            }
            
            
            exit;
            // return [$status,$msg];
            
            
        }
        
       
        
          
    
}
