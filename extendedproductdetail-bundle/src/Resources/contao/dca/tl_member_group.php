<?php
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\Doctrineinteractions;
/**
 * Table tl_member_group
 */


    $GLOBALS['TL_DCA']['tl_member_group']['config']['onsubmit_callback'][] =  array('lb_tl_membergrp', 'syncRecord');
    
    $GLOBALS['TL_DCA']['tl_member_group']['config']['ondelete_callback'][] =   array('lb_tl_membergrp', 'syncRecordDelete');

    

    class lb_tl_membergrp extends Backend
{
    /**
     * options_callback: Erm�glicht das Bef�llen eines Drop-Down-Men�s oder einer Checkbox-Liste mittels einer individuellen Funktion.
     * @param  $dc
     * @return array
     */
    public function myOptionsCallback(DataContainer $dc)
    {
        $values = array();
        $consultants = $this->Database->prepare("SELECT id,firstname,lastname FROM tl_member WHERE  lb_isContact = 1 ORDER BY lastname ASC")->execute();
        //Array erzeugen
        while($consultants->next())
        {
            $values[$consultants->id] = "<b>".$consultants->firstname." ".$consultants->lastname."</b> ";
        }
        return $values;
}

public function staffOptionsCallback()
{
    $values = array();
    $products = $this->Database->prepare("SELECT id, costType,description FROM tl_lb_costType WHERE isTask=? ORDER BY costType ASC ")->execute(1);
    while($products->next())
    {
        $values[$products->id] = "<b>".$products->costType." | ".$products->description."</b> ";
    }
    return $values;
}


public function syncRecord(DataContainer $dc)
{
    $di = new Doctrineinteractions();
    $db = $di->getConnection();
    $id = $dc->id;
    $stmt2 = $db->prepare("SELECT id FROM tl_member_group WHERE id = ?");
    $success = $stmt2->execute(array($id));
    if ($stmt2->rowCount() > 0) {
        
        
        $rows=$_POST;
        $setstring="";
        foreach($rows as $key=>$value )
            {
                switch($key)
                {
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
                    case 'id':
                        continue 2;
                        break;
                  
                    case 'lsShopPriceAdjustment':
                        continue 2;
                        break;
                        
                    case 'lsShopMinimumOrderValueAddCouponToValueOfGoods':
                        continue 2;
                        break;
                        
                    case 'lsShopMinimumOrderValue':
                        continue 2;
                        break;
                        
                    case 'lsShopOutputPriceType':
                        continue 2;
                        break;
                        
                    case 'lsShopFormConfirmOrder':
                        continue 2;
                        break;
                    case 'saveNclose':
                        continue 2;
                        break;
                    case 'lsShopFormCustomerData
':
                        continue 2;
                        break;
                    case 'lsShopStandardShippingMethod':
                        continue 2;
                        break;
                         
                    case 'lsShopStandardPaymentMethod':
                        continue 2;
                        break;
                    default:
                        if (strpos($key, 'lsShop')!== false)
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
            $stmt =  $db->prepare("UPDATE tl_member_group SET ".$setstring." WHERE id = ?");
            $success = $stmt->execute(array($id));
            file_put_contents("dump.txt",$setstring);
        // $result_req = $stmt2->fetch();
        while ($row = $stmt2->fetch(PDO::FETCH_OBJ)) {
            // $data = $row[0]."\n";
           // $stmt = $db->prepare("SELECT id FROM tl_member WHERE id = ?");
           
            file_put_contents("dump2.txt",print_r($dc->activeRecord->fetchAllAssoc()[0],TRUE),FILE_APPEND);
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
                case 'VERSION_NUMBER':
                    continue 2;
                    break;
                    
                case 'REQUEST_TOKEN':
                    continue 2;
                    break;
                    
                case 'FORM_SUBMIT':
                    continue 2;
                    break;
                case 'saveNclose':
                    continue 2;
                    break;
                case 'FORM_FIELDS':
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
                case 'lsShopPriceAdjustment':
                    continue 2;
                    break;
                    
                case 'lsShopMinimumOrderValueAddCouponToValueOfGoods':
                    continue 2;
                    break;
                    
                case 'lsShopMinimumOrderValue':
                    continue 2;
                    break;
                    
                case 'lsShopOutputPriceType':
                    continue 2;
                    break;
                    
                case 'lsShopFormConfirmOrder':
                    continue 2;
                    break;
                    
                case 'lsShopFormCustomerData':
                    continue 2;
                    break;
                case 'lsShopStandardShippingMethod':
                    continue 2;
                    break;
                    
                case 'lsShopStandardPaymentMethod':
                    continue 2;
                    break;
                default:
                    if (strpos($key, 'lsShop')!== false)
                    {
                       
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
        $stmt =  $db->prepare("INSERT INTO tl_member_group (".$keystring.") VALUES (".$valuestring.") ");
        $success = $stmt->execute();


       
        
    }

}

public function syncRecordDelete(DataContainer $dc,$id)
{
    $di = new Doctrineinteractions();
    $db = $di->getConnection();
    $id = $dc->id;
    $stmt2 = $db->prepare("SELECT id,name FROM tl_member_group WHERE id = ?");
    $success = $stmt2->execute(array($id));
    $rows=$dc->activeRecord->fetchAllAssoc();
$row = $stmt2->fetch(PDO::FETCH_OBJ);
        // $data = $row[0]."\n";
        // $stmt = $db->prepare("SELECT id FROM tl_member WHERE id = ?");
        
  
file_put_contents("delete",$rows[0]['name'].$row->name);
   if($rows[0]['name']== $row->name)
   {
       $stmt =  $db->prepare("DELETE FROM tl_member_group WHERE id=?");
       $success = $stmt->execute(array($id));
       
   }
}
}


