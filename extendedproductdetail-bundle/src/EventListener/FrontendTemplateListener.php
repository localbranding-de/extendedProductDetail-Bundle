<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
use Contao\FrontendUser;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\Doctrineinteractions;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\HookHelper;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\OnBuildQueryHook;
class FrontendTemplateListener// Klassenname = Dateiname (ohne .php)
{
    public function __construct() {} // eventuell nicht nötig, probieren
   
    public function myCustomClassMethod($intId, $arrData) // Methodenname so wie in config angegeben, Parameterdefinitionen aus dem Entwicklerhandbuch entnehmen
    {
        print_r($intId);     // Print the ID of the new User
        print_r($arrData); // Print out the user's data, which should include the fields you need.

    }
    
    

   public function setSecureFlag($objCookie) {
        $objCookie->blnSecure = true;
        file_put_contents("testr","");
        
        return $objCookie;
    }
    
    public function myOutputFrontendTemplate($strContent, $strTemplate)
    {
       $dc= new Doctrineinteractions();
        $db = $dc->getConnection();
        
        //Hook erstellen
        $objMyHook = new OnBuildQueryHook();
        $objMyHook->setRessource('tl_member');
        $objMyHook->setId(1);
        
        // run the Hook
       HookHelper::dispatch($objMyHook::HOOKNAME, $objMyHook);
        // oder für Leute, die den Namen nicht exta übergeben möchten:
        // \esit\esithook\classes\helper\HookHelper::run($objMyHook);
        
        // get the Query
        $strQuery = $objMyHook->getQuery();
        
        
        
        
        if ($strTemplate == 'fe_page')
        {
            if(strpos($strContent,'id="variable"')!== false)
            {
                $start=strpos($strContent,'variant-selector');
                $substr=substr($strContent,$start,2000);

                $end=strpos($substr,'<!-- indexer::continue -->');
                $priceBoxHtml=substr($strContent,$start,$end);
                
                $strContent=str_replace("replaceAnchor","replaceAnchor2313123",$strContent);
               // $strContent=str_replace($priceBoxHtml,"",$strContent);
                //$strContent=str_replace('<div id="replaceAnchor"></div>',$priceBoxHtml,$strContent);
                //$strContent=substr_replace($strContent,$priceBoxHtml,strrpos(substr($strContent,0,strpos($strContent,'id="ajax-reload-by-put')),"<div"),0);
                //$strContent=str_replace('<div class="lsfwk-fullwidth variant-selector"',$priceBoxHtml.'<div class="lsfwk-fullwidth variant-selector"',$strContent);
                $strContent=substr_replace($strContent,$priceBoxHtml,strrpos(substr($strContent,0,strpos($strContent,'col-left')),"<div"),0);
                

            }
            
           
            
        }
         
        return $strContent;
    }
    
    public function myParseFrontendTemplate($objTemplate)
    {
        
        if($objTemplate->getName() == 'template_cart_big_1')
        {
            // // file_put_contents('test', "");
                      
        }
        
        
        
        
       if ($objTemplate->getName() == 'template_productIncludes_price_01' OR $objTemplate->getName() == 'template_productDetails_domain')
        {
            
            $table="tl_ls_shop_product";
            if($objTemplate->objProduct->ls_currentVariantID !=0)
            {
                
                $prodId = $objTemplate->objProduct->ls_currentVariantID;
                $table = "tl_ls_shop_variant";
                
            }
            else
            {
                
                $prodId = $objTemplate->objProduct->ls_ID;
            }
            $results  = \Database::getinstance()->prepare('SELECT lb_priceComment FROM '.$table.' WHERE id = ?')->execute($prodId);
            $objTemplate->objProduct->lb_priceComment = $results->lb_priceComment;

        }
    
    
            if ($objTemplate->getName() == 'template_productDetails_02_leistung' OR $objTemplate->getName() == 'template_productDetails_01' OR $objTemplate->getName() == 'template_productDetails_domain')
        {

            $assets_path = '/bundles/extendedproductdetail';
            // JS files
            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/headlinefixer.js';

            $objUser = FrontendUser::getInstance();
            $table="tl_ls_shop_product";
            if($objTemplate->objProduct->ls_currentVariantID !=0)
            {
                
                $prodId = $objTemplate->objProduct->ls_currentVariantID;
                $table = "tl_ls_shop_variant";
                
            }
            else
            {
                
                $prodId = $objTemplate->objProduct->ls_ID;
            }

            $buyButton = '<div id="variable" class="pre-select quantityInput lsfwk-alignCenter lsfwk-mgt-l">
            <form action="" method="post" enctype="application/x-www-form-urlencoded">
            <div>
            <input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
            <input type="hidden" name="FORM_SUBMIT" value="product_form_">
            <input type="hidden" name="productVariantID" value="">
            <div class="inputQuantity">
            <div class="quantityWrapper lsfwk-sameLine"><div class="flexWidget flexWidget_default">
            
            <label for="quantity_">Menge</label>
            <input name="quantity_" id="quantity_" type="number" min="1" value="1">
            
            </div></div>
            <button type="submit" class="submit lsfwk-submit lsfwk-sameLine" disabled><i class="lsfwk-txs-l-all lsfwk-txc-inverted-all lsfwk-fi lsfwk-fi-cart lsfwk-mgr-10"></i>In den Warenkorbs</button>
            </div>
            </div>
            </form>
            </div>';
            $objTemplate->objProduct->buyButtonDisabled=$buyButton;
            $results  = \Database::getinstance()->prepare('SELECT lb_inPriceHeader1,lb_inPriceText1,lb_inPriceHeader2,lb_inPriceText2,lb_inPriceHeader3,lb_inPriceText3,lb_productTab1,lb_productTab1_text,lb_productTab1_accordList,lb_productTab2,lb_productTab2_text,lb_productTab2_accordList,lb_productTab3,lb_productTab3_text,lb_productTab3_accordList,lb_priceComment,lb_sellingUnit FROM '.$table.' WHERE id = ?')->execute($prodId);
            $accordeons= array();
            $accordeons1=unserialize($results->lb_productTab1_accordList);
            $accordeons2=unserialize($results->lb_productTab2_accordList);
            $accordeons3=unserialize($results->lb_productTab3_accordList);
            $objTemplate->lb_inPriceHeader1 = $results->lb_inPriceHeader1;
            $objTemplate->lb_inPriceHeader2 = $results->lb_inPriceHeader2;
            $objTemplate->lb_inPriceHeader3 = $results->lb_inPriceHeader3;
            $objTemplate->lb_inPriceText1 = $results->lb_inPriceText1;
            $objTemplate->lb_inPriceText2 = $results->lb_inPriceText2;
            $objTemplate->lb_inPriceText3 = $results->lb_inPriceText3;
            $objTemplate->lb_productTab1 = $results->lb_productTab1;
            $objTemplate->lb_productTab2 = $results->lb_productTab2;
            $objTemplate->lb_productTab3 = $results->lb_productTab3;
            $objTemplate->lb_productTab1_text = $results->lb_productTab1_text;
            $objTemplate->lb_productTab2_text = $results->lb_productTab2_text;
            $objTemplate->lb_productTab3_text = $results->lb_productTab3_text;
            $objTemplate->lb_priceComment = $results->lb_priceComment;
            $objTemplate->objProduct->lb_priceCommentMoin=$results->lb_priceComment;
            $objTemplate->lb_sellingUnit = $results->lb_sellingUnit;
            $objTemplate->objProduct->lb_priceComment = $results->lb_priceComment;
            $accordeons[]=$accordeons1;
            $accordeons[]=$accordeons2;
            $accordeons[]=$accordeons3;
            $holder=1;
            foreach($accordeons as $accordeonlist)
            {
                 $accords = array();
                 $counter=0;
                foreach($accordeonlist as $accordeon)
                {
                    
                    $title =$accordeon['lb_productTab'.$holder.'_accordHeader'];
                    $content = $accordeon['lb_productTab'.$holder.'_accordContent'];
                    if($title =="" OR $content=="")
                    {
                        continue;
                    }
                    $accords[]='<!-- Accordion -->
			<section data-lsjs-component="elementFolder" data-lsjs-elementFolderOptions="
                        {
                           str_initialCookieStatus: \'closed\'
                        }
                        " id="description-tab-'.$holder.'_'.$counter.'_'.$objTemplate->objProduct->_id.'" class="lsfwk-mgb-10">
				<div data-lsjs-element="elementFolderToggler" class="lsfwk-mgb-5 lsfwk-bdb lsfwk-pointer product-accordion-header">
					<span class="lsfwk-txs-m-all"><h4>'.$title.'</h4></span>
				</div>
				<div data-lsjs-element="elementFolderContent" class="product-accordion-content">
					<p>'.$content.'</p>
				</div>
			</section>';
                    
                    $counter++;
                   
                    
                    
                }
                $atrName="accordsTab".$holder;
                $objTemplate->{$atrName}=$accords;
                $holder=$holder+1;
                
                
                
            }
            
            
            
            if (FE_USER_LOGGED_IN === true) {
                
                foreach($groups as $group)
                {
                }

                //$user_name = $this->User->username; 
                // es gibt einen authentifizierten Frontend-Benutzer
            } else {

                // es gibt keinen authentifizierten Frontend-Benutzer
               
            }
           


           // // // file_put_contents("username",  $userfn);
        }
    }
    
    public function myBeforeAddToCart($arrItemInfoToAddToCart, $objProductOrVariant) {
        
        /*
        
        * Example: Add the product code to the cart item information. This
        
        * could be used in the hook "getScalePriceQuantity" to change the way
        
        * the scale price quantity is calculated. For example, all cart items
        
        * with the same product code prefix could be grouped.
        
        */
        //// // file_put_contents("ItemInfo",print_r($arrItemInfoToAddToCart,true));
        $prodId = $objProductOrVariant->ls_ID;
        
        $results  = \Database::getinstance()->prepare('SELECT lb_sellingUnit FROM tl_ls_shop_product WHERE id = ?')->execute($prodId);
        
        
        $arrItemInfoToAddToCart['quantity'] =  $results->lb_sellingUnit-1;
        
        return $arrItemInfoToAddToCart;
        
    }
    
    public function myAfterCheckout($orderID, $order) {
        foreach($_SESSION['orderIDs'] as $id)
        {
            \Database::getinstance()->prepare("UPDATE tl_calendar_events SET `order`=? WHERE id=?")->execute(array($orderID,$id));
        }
        unset($_SESSION['orderIDs']);
        unset($_SESSION['bundles']);
        
    }
    
    public function myOutputTemplate($strContent, $strTemplate) {
        
        $result=\Database::getinstance()->prepare("SELECT id,updated from tl_calendar_events WHERE bought=0 AND NOT updated=0")->execute();
        while($result->next())
        {
            
            $updated=intval($result->updated);
            $time= time();
            $diff = $time - $updated;
            if($diff>=600)
            {
                
                
                \Database::getinstance()->prepare("DELETE FROM tl_calendar_events WHERE id =?")->execute($result->id);
                
                foreach($_SESSION['cal'] as $key => $val)
                {
                    $storeEvent = unserialize($_SESSION['cal'][$key]);
                    $storeEvent=json_encode($storeEvent);
                    $storeEvent=json_decode($storeEvent);
                    if($storeEvent->id==$result->id)
                    {
                        unset($_SESSION['cal'][$key]);
                    }
                }
            }
        }
        return $strContent;
        
        
    }
    public function myStoreCartItemInOrder($arr_item, $obj_product) {
        
        setlocale(LC_TIME, "de_DE");
        


        $domain=\Database::getinstance()->prepare("SELECT id,title_de,lb_isDomain FROM tl_ls_shop_product WHERE title=?")->execute($arr_item['extendedInfo']['_productTitle_customerLanguage'])->lb_isDomain;
        if($domain)
        {
            return $this->storeDomain($arr_item,$obj_product);
           
            
        }

        
        foreach($_SESSION['cal'] as $key => $val)
        {
            $storeEvent = unserialize($_SESSION['cal'][$key]);
            $storeEvent=json_encode($storeEvent);
            $storeEvent=json_decode($storeEvent);
            $title=\Database::getinstance()->prepare("SELECT id,title_de FROM tl_ls_shop_product WHERE alias=?")->execute($storeEvent->product)->title_de;
            

            if($arr_item['extendedInfo']['_productTitle_customerLanguage']==$title)
            {
                $start= strToTime($storeEvent->start);
                $end= strToTime($storeEvent->end);
                \Database::getinstance()->prepare("UPDATE tl_calendar_events SET bought=1 WHERE id=?")->execute($storeEvent->id);
                //OVerviewMail
                $arr_item['extendedInfo']['_deliveryTimeMessageInCart_customerLanguage'] = utf8_encode("Der Termin ist am ".strftime('%a',$start).", ".strftime('%d.',$start)." ".strftime('%B',$start)." ".strftime('%Y',$start)." von ".strftime('%H:%M',$start)." bis ".strftime('%H:%M',$end));
                //BackendOverview
                $arr_item['extendedInfo']['_deliveryTimeMessageInCart'] =utf8_encode("Der Termin ist am ".strftime('%a',$start).", ".strftime('%d.',$start)." ".strftime('%B',$start)." ".strftime('%Y',$start)." von ".strftime('%H:%M',$start)." bis ".strftime('%H:%M',$end));
                unset($_SESSION['cal'][$key]);
                $_SESSION['orderIDs'][]=$storeEvent->id;
            }
        }

        
        
        
        return $arr_item;
        
    }
    protected function adjustPhonenumber($str,$country)
    {
        $countrys=["de"=>"49","at"=>"43","ch"=>"41","be"=>"32","dk"=>"45","es"=>"34","fr"=>"33","li"=>"423","en"=>"44","it"=>"39","nl"=>"31"];
        $result =str_replace(' ', '', $str);
        $result = ltrim($result,0);
        $result  = "+".$countrys[$country].".".$result;
        return $result;
        
    }
    protected function storeDomain($arr_item, $obj_product)
    {
        if (FE_USER_LOGGED_IN)
        {
            $objUser = FrontendUser::getInstance();
            $userid = $objUser->id;
            $userfn = $objUser->firstname;
            $userln = $objUser->lastname;
            $usersx =strtoupper($objUser->gender);
            $usercp = $objUser->company;
            $userst = $objUser->street;
            $userps = $objUser->postal;
            $userct = $objUser->city;
            $usercn =strtoupper($objUser->country);
            $userpn = adjustPhonenumber($objUser->phone,$objUser->country);
            $userfx=$objUser->fax;
            if(!$userfx)
            {
                $userfx=$userpn;
            }
            $userfx = $userpn;
            $userem = $objUser->email;
            $usercp = $objUser->company;
            if(!$userpn)
            {
                $userpn=adjustPhonenumber($objUser->mobile,$objUser->country);
            }

        }
        if ( preg_match('/([^\d]+)\s?(.+)/i', $userst, $result) )
        {
            // $result[1] will have the steet name
            $userst = $result[1];
            // and $result[2] is the number part.
            $usernm = $result[2];
        }
        $handle=\Database::getinstance()->prepare("SELECT lb_antagusHandle from tl_member WHERE id=?")->execute($userid)->lb_antagusHandle;
        $xmlstr = file_get_contents("http://backend.antagus.de/bdom/contact/status/".$handle."/100064/");
        $xml=simplexml_load_string($xmlstr);
        $handle= (string)$xml->handle;
        if(!$handle)
        {
            $input_xml ='<?xml version="1.0" encoding="UTF-8"?>
<request xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <type>PERS</type>
  <sex>'.$usersx.'</sex>
  <first-name>'.$userfn.'</first-name>
  <last-name>'.$userln.'</last-name>
  <organisation>'.$usercp.'</organisation>
  <street>'.$userst.'</street>
  <number>'.$usernm.'</number>
  <postcode>'.$userps.'</postcode>
  <city>'.$userct.'</city>
  <country>'.$usercn.'</country>
  <phone>'.$userpn.'</phone>
  <fax>'.$userfx.'</fax>
  <email>'.$userem.'</email>
</request>';
            
            $url = 'http://backend.antagus.de/bdom/contact/create/-/100064';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
            $response = curl_exec($ch);
            $xml=simplexml_load_string($response);
            $handle=(string)$xml->handle;
            curl_close($ch);
            \Database::getinstance()->prepare("UPDATE tl_member SET lb_antagusHandle = ? WHERE id=?")->execute($handle,$userid);

        }
        

       
        
        $key=  substr($arr_item['extendedInfo']['_productVariantID'], 0, -2);
        

         
        foreach($_SESSION['lsShopCart']['items'][$key]['domains'] as $name)
        { 
            

        $domain = explode(".",$name);
        $sld= str_replace(".".end($domain),"",$name);
       $tld= end($domain);

       
       // DNS
       $zone_xml = '<?xml version="1.0" encoding="UTF-8"?>
<zone xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNameSpaceSchemaLocation="DnsZone.xsd">
  <name>'.$name.'</name>
  <user_id>100064</user_id>
  <record_list>
    <record_item>
      <content>ns1.localbranding.domains</content>
      <name>'.$name.'</name>
      <ttl>86400</ttl>
      <type>NS</type>
    </record_item>
    <record_item>
      <content>ns2.localbranding.domains</content>
      <name>'.$name.'</name>
      <ttl>86400</ttl>
      <type>NS</type>
    </record_item>
    <record_item>
      <content>37.202.5.94</content>
      <name>'.$name.'</name>
      <ttl>86400</ttl>
      <type>A</type>
    </record_item>
    <record_item>
      <content>37.202.5.94</content>
      <name>www.'.$name.'</name>
      <ttl>86400</ttl>
      <type>A</type>
    </record_item>
    <record_item>
      <content>37.202.5.94</content>
      <name>*.'.$name.'</name>
      <ttl>86400</ttl>
      <type>A</type>
    </record_item>
    <record_item>
      <content>mx1.agenturserver.de</content>
      <name>'.$name.'</name>
      <priority>10</priority>
      <ttl>86400</ttl>
      <type>MX</type>
    </record_item>
    <record_item>
      <content>mx2.agenturserver.de</content>
    <name>'.$name.'</name>
      <priority>10</priority>
      <ttl>86400</ttl>
      <type>MX</type>
    </record_item>
    <record_item>
      <content>mx3.agenturserver.de</content>
      <name>'.$name.'</name>
      <priority>20</priority>
      <ttl>86400</ttl>
      <type>MX</type>
    </record_item>
    <record_item>
      <content>mx4.agenturserver.de</content>
     <name>'.$name.'</name>
      <priority>50</priority>
      <ttl>86400</ttl>
      <type>MX</type>
    </record_item>
  </record_list>
  <soa>
    <mname>ns1.localbranding.domains</mname>
    <rname>root@ns1.localbranding.domains</rname>
    <serial>'.time().'</serial>
    <ttl>86400</ttl>
  </soa>
</zone>';
       
       
       
       $url = 'http://backend.antagus.de/bdom/dns/domain/-/100064/';
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
       curl_setopt($ch, CURLOPT_POSTFIELDS, $zone_xml);
       $response = curl_exec($ch);
       $xml=simplexml_load_string($response);
       // // file_put_contents("DNSZone.xml",$zone_xml);
       curl_close($ch);
       // // file_put_contents("responseDNS.txt",$response,FILE_APPEND);
      
       if(!$xml->error)
       {
           // Domain
           $input_xml='<?xml version="1.0" encoding="UTF-8"?>
<request xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <sld>'.$sld.'</sld>
  <contact-ids>
                <owner>'.$handle.'</owner>
                <admin>LOHOC0005</admin>
                <tech>LOHOC0005</tech>
                <zone>LOHOC0005</zone>
        </contact-ids>
        <nameservers>
                <ns>
                <hostname>ns1.localbranding.domains</hostname>
                </ns>
                <ns>
                <hostname>ns2.localbranding.domains</hostname>
                </ns>
        </nameservers>
</request>';
           
           $url = 'http://backend.antagus.de/bdom/domain/create/'.$tld.'/'.$sld.'/100064';
           $ch = curl_init($url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
           curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
           $response = curl_exec($ch);
           curl_close($ch);
           // // file_put_contents("responseDomain.txt",$response,FILE_APPEND);
       }

       
        
       
  
        
        }
        
        $arr_item['extendedInfo']['domains']=$_SESSION['lsShopCart']['items'][$key]['domains'];
        return $arr_item;
        
    }
    
    
    public function myAddToCart($objProduct, $desiredQuantity, $quantityPutInCart) {
        
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
        
    }
    public function myInitializeCartController($cart, $itemsExtended, $calculation) {
        
        foreach($itemsExtended as $item)
        {
            if($item['objProduct']->ls_data['de']['lb_isDiscount'])
            {
                
                // // file_put_contents('calc',print_r($item['objProduct']->ls_currentVariantID."\r\n",TRUE),FILE_APPEND);
                //// file_put_contents('calc',"yes",FILE_APPEND);
            }
        }
        
        
    }
    
}

 

?>
