<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
use Contao\FrontendUser;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\Doctrineinteractions;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\HookHelper;
use LocalbrandingDe\ExtendedProductDetailBundle\Classes\OnBuildQueryHook;
class createNewUserListener// Klassenname = Dateiname (ohne .php)
{
    public function __construct() {} // eventuell nicht nötig, probieren
    
    public function myCreateNewUser($intId, $arrData)
    {
        $results  = \Database::getinstance()->prepare('SELECT MAX(memberNr) FROM tl_member ')->execute();
        
        $newNr = $results->memberNr+1;
        if($newNr<200){
            $newNr=200;
        }
        file_put_contents("usernrr",$newNr);
        \Database::getinstance()->prepare('UPDATE tl_member SET memberNr=? WHERE id =? ')->execute($newNr,$objUser->id);
    }
    

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
    
    


}  

?>
