<?php
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\Doctrineinteractions;
/**
 * Table tl_member
 */
//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('{login_legend','{staff_legend},lb_IsStaff;{staff_competence_legend},lb_has_staff_competences,lb_has_staff_costTypes;{login_legend',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );
  
   
//Legenden hinzuf�gen
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('state,country','state,country,lb_brandLogo',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('gender','gender,lb_memberImage',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('language;','language;{contactDomains_legend},lb_antagusHandle;{contactAssigned_legend},lb_clientAssignedToConsultant;',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']=str_replace('{login_legend},login;','{login_legend},login,login_lbTeam,login_lbOne;',$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] );

$GLOBALS['TL_DCA']['tl_member']['subpalettes']['lb_has_staff_costTypes'] ='lb_staff_costTypes';
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['lb_has_staff_competences'] ='lb_staffCompetences';
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['lb_IsStaff'] ='lb_teamCategory,lb_staffCalendar,lb_workstart,lb_workend,lb_location,lb_allocationException,lb_inputTaxDeduction,lb_isInContact,lb_isInFulfilment';
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'lb_IsStaff';
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'lb_has_staff_competences';
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'lb_has_staff_costTypes';



    $GLOBALS['TL_DCA']['tl_member']['config']['onsubmit_callback'][] =  array('lb_tl_membernd', 'syncRecord');
    
    $GLOBALS['TL_DCA']['tl_member']['config']['ondelete_callback'][] =   array('lb_tl_membernd', 'syncRecordDelete');

// Hinzuf�gen der Feld-Konfiguration
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_memberImage'] = array
( 
'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_memberImage'],
'exclude'                 => true,
'inputType'               => 'fileTree',
'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'tl_class'=>'clr', 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_brandLogo'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_brandLogo'],
    'exclude'                 => true,
    'inputType'               => 'fileTree',
    'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'tl_class'=>'clr', 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
    'sql'                     => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['lb_has_staff_competences'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_has_staff_competences'],
    'exclude'                 => true,
    'eval'                    => array('submitOnChange'=>true),
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_has_staff_costTypes'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_has_staff_costTypes'],
    'exclude'                 => true,
    'eval'                    => array('submitOnChange'=>true),
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_antagusHandle'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_antagusHandle'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50','maxlength'=>255),
    'sql'       => "varchar(256) NOT NULL default ''"
);



$GLOBALS['TL_DCA']['tl_member']['fields']['lb_clientAssignedToConsultant'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['lb_clientAssignedToConsultant'],
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => array('includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','submitOnChange'=>true,'feEditable'=>true, 'feViewable'=>true),
    'foreignKey'=> 'tl_member.id',
    'options_callback'  => array('lb_tl_membernd', 'myOptionsCallback'),
    'sql'       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['lb_staff_costTypes']= array
(
    'label'			=> &$GLOBALS['TL_LANG']['tl_member']['lb_staff_costTypes'],
    'exclude' 		=> true,
    'inputType' 		=> 'multiColumnWizard',
    'save_callback'           => array(array('lb_tl_member','mySaveCallback')),
    'eval' 			=> array
    (
        'columnFields' => array
        (
            'costTypes' => array
            (
                'label'                 => &$GLOBALS['TL_LANG']['tl_member']['lb_staff_costTypesSelect'],
                'exclude'               => true,
                'inputType'             => 'select',
                'options_callback'      => array('lb_tl_membernd','staffOptionsCallback'),
                'eval' 			=> array('tl_class'=>'','includeBlankOption' => true,'blankOptionLabel' => 'Bitte wählen ...','style' => 'width:250px', 'chosen'=>true)
            ),
        ),
        'unique'=>true, 'tl_class'=>'long'
    ),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['fax'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['fax'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('placeholder'=>'Nach dem Muster: +49.224286061','maxlength'=>64, 'rgxp'=>'lb_fax', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['phone'] = array
(
    
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['phone'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('placeholder'=>'Nach dem Muster: +49.224286060','maxlength'=>64, 'rgxp'=>'lb_phone', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['mobile'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['mobile'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('placeholder'=>'Nach dem Muster: +49.176986060','maxlength'=>64, 'rgxp'=>'lb_mobile', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['login_lbTeam'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['login_lbTeam'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_member']['fields']['login_lbOne'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['login_lbOne'],
    'exclude'                 => true,
    'filter'                  => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);

    

class lb_tl_membernd extends Backend
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
    if($_POST['SUBMIT_TYPE']=="auto")
    {
        return;
    }
    
    $di = new Doctrineinteractions();
    $db = $di->getConnection();
    $id = $dc->id;

    
    $stmt2 = $db->prepare("SELECT id FROM tl_member WHERE id = ?");
    $success = $stmt2->execute(array($id));
    
    if ($stmt2->rowCount() > 0) {
        
        
        $rows=$_POST;
      
        $setstring="";
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
                    case 'saveNclose':
                        continue 2;
                        break;
                    case 'groups':
                        $val =serialize($value);
                        $setstring = $setstring." ".$key." = '".$val."',";
                        break;
                    case 'password':
                        if(strpos($value,"**"))
                        {
                            continue 2;
                            break;
                        }
                        else
                        {
                            $setstring = $setstring." ".$key." = '".password_hash($value,PASSWORD_BCRYPT )."',";
                        }
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
                    case 'lb_brandLogo':
                            $path = $objFile = \FilesModel::findByUuid($value)->path;
                            $setstring = $setstring." ".$key." = '".$path."',";
                            break;
                    case 'lb_memberImage':
                        $path = $objFile = \FilesModel::findByUuid($value)->path;
                        $setstring = $setstring." ".$key." = '".$path."',";
                        break;
                    case 'lb_has_staff_competences':
                        continue 2;
                        break;
                    case 'lb_inputTaxDeduction':
                        continue 2;
                        break;
                    case 'homeDir':
                        $path = $objFile = \FilesModel::findByUuid($value)->path;
                        $stmt = $db->prepare("SELECT uuid FROM tl_files WHERE path = ?");
                        $success = $stmt->execute(array($path));
                        $user = $stmt->fetch();
                        

                            $setstring = $setstring." ".$key." = '".$user['uuid']."',";
                    

                        break;

                    case 'merconis_favoriteProducts':
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

            $stmt =  $db->prepare("UPDATE tl_member SET ".$setstring." WHERE id = ?");
            $success = $stmt->execute(array($id));
          
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
                case 'password':
                    if(strpos($value,"**"))
                    {
                        continue 2;
                        break; 
                    }
                    else
                    {
                        $keys[] =$key;
                        $values[] ="\"".password_hash($value,PASSWORD_BCRYPT)."\"";
                    }
                    
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
                case 'saveNclose':
                    continue 2;
                    break;
                    
                case 'lb_isContact':
                    continue 2;
                    break;
                case 'lb_memberImage':
                    $path = $objFile = \FilesModel::findByUuid($value)->path;          
                    $keys[] = $key;
                    $values[] ="\"".$path."\"";;
                    break;
                case 'lb_brandLogo':
                    $path = $objFile = \FilesModel::findByUuid($value)->path;
                    $keys[] = $key;
                    $values[] ="\"".$path."\"";;
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
}


