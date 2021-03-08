<?php 
namespace LocalbrandingDe\ExtendedProductDetailBundle\Classes;
use \PDO;
class Doctrineinteractions 
{
    function __construct() {
       
    }
    public function getConnection()
    {
        $db = \System::getContainer()->get('doctrine')->getConnection('team');
        //$result = $db->prepare("Insert INTO tl_user (username,email) VALUES ('test','test@test.de')")->execute();
        /*$result = $db->prepare("SELECT * FROM tl_user where id = 1 ")->execute();
     
        
        
        
        $stmt2 = $db->prepare("SELECT * FROM tl_user");
        $success = $stmt2->execute();
        
        // $result_req = $stmt2->fetch();
        while ($row = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            file_put_contents("dump.txt",$data,FILE_APPEND);
        }
        */
        return $db;
    }
    
    
    

}
