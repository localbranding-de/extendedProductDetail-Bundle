<?php
namespace LocalbrandingDe\ExtendedProductDetailBundle\EventListener;
class OutputBackendTemplateListener// Klassenname = Dateiname (ohne .php)
{
    public function __construct() {} // eventuell nicht nötig, probieren
    
    public function myCustomClassMethod($intId, $arrData) // Methodenname so wie in config angegeben, Parameterdefinitionen aus dem Entwicklerhandbuch entnehmen
    {
        print_r($intId);     // Print the ID of the new User
        print_r($arrData); // Print out the user's data, which should include the fields you need.
    }
    
    public function myOutputBackendTemplate($strContent, $strTemplate)
    {
        
        if ($strTemplate == 'be_main')
        {
            //file_put_contents("test43ss",$strTemplate);
           // file_put_contents("test43s",$strContent);
        }
        
        return $strContent;
    }
}  

?>
