<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
use Contao\FrontendUser;
class activateAccountListener// Klassenname = Dateiname (ohne .php)
{
    public function __construct() {} // eventuell nicht nötig, probieren
    
    public function myActivateAccount($objUser)
    {
        $results  = \Database::getinstance()->prepare('SELECT MAX(memberNr) FROM tl_member ')->execute();
        
        $newNr = $results->memberNr+1;
        if($newNr<300){
            $newNr=300;
        }
        file_put_contents("usernr",$newNr);
        $userId=$objUser->id;
        \Database::getinstance()->prepare('UPDATE tl_member SET memberNr=? WHERE id =? ')->execute($newNr,$userId);
    }
    


}  

?>
