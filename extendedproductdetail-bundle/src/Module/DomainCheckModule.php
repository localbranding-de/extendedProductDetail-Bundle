<?php

namespace LocalbrandingDe\ExtendedProductDetailBundle\Module;

class httpRequest {
    var $host;
    var $port;
    
    //constructor
    function httpRequest($host,$port){
        $this->host = $host;
        $this->port = $port;
    }
    
    //uri to get
    function get($uri) {
        return $this->request('GET',$uri,'');
    }
    
    //uri to put body(xml)
    function put($uri,$body) {
        return $this->request('PUT',$uri,$body);
    }
    
    //uri to post body(xml)
    function post($uri,$body) {
        return $this->request('POST',$uri,$body);
    }
    
    //uri to delete
    function delete($uri) {
        return $this->request('DELETE',$uri,'');
    }
    
    // private methods
    //make request to server
    function request($method, $uri, $body){
        //open socket
        $sd = fsockopen($this->host, $this->port, $errno,$errstr);
        if (!$sd) {
            $result = "Error: $errstr ($errno)";
        }else{
            //send request to server
            fputs($sd,$this->make_string($method, $uri, $body));
            
            //read answer
            $nl = 0;//new line detector
            
            //initialize body length on a high value
            $count = 65535;
            while ($str = fgets($sd, 1024)){
                $result .= $str;
                $count = $count - strlen($str);
                if ($nl == 1) {
                    //set count to actual body length
                    $count = hexdec($str);
                    $nl = 0;
                }
                
                //remove CR/LF
                $str = preg_replace('/\015\012/', '',$str);
                if ($str == '') {
                    $nl = 1;
                }
                if ($count <= 0) {
                    break;
                }
            }
        }
        
        //close socket
        if($sd) {
            fclose($sd);
        }
        
        $this->response = $result;
        return $result;
    }
    
    //create request
    function make_string($method, $uri, $body){
        //header: method + host
        $str = strtoupper($method)." ".$uri." HTTP/1.1\nHOST: ".$this->host;
        
        //header: ...
        $str .= "\nConnection: Keep-Alive\nUser-Agent: bdomHTTP\nContent-Type: text/xml; charset=iso-8859-1";
        
        //header: body size ... if any
        if ($body) {
            $str .= "\nContent-Length: ".strlen($body);
        }
        
        $str .= "\n\n";
        
        //append body ... if any
        if ($body) {
            $str .= $body ;
        }
        return $str;
    }
    
}

class httpResponse {
    var $resp;
    
    function httpResponse($resp) {
        $this->resp = $resp;
    }
    
    //extract response code
    function code() {
        preg_match('/HTTP\/[10\.]+\s+([0-9]+)/', $this->resp, $code);
        return $code[1];
    }
    
    //extract response body
    function body() {
        //body is between two empty lines for "chunked" encoding
        $chunk = preg_split('/(?=^\r)/m',$this->resp);
        $body = "";
        if ($chunk[1]){
            //extract body from \nsize(body)\n0
            $body = ereg_replace("\n[0-9a-fA-F]+", "", $chunk[1]);
        }
        
        return trim($body);
    }
}
class DomainCheckModule extends \Module
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
            $template->title = "yeez";
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
            $GLOBALS['TL_JAVASCRIPT'][] = $assets_path. '/js/lb_fe_domainCheck.js'; 
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
        protected function allCheck($name)
        {
            $allDomains =["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop","at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk","bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien","academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
            $arr=[];
            foreach($allDomains as $domain)
            {
                $status = $this->topCheck($name,$domain);
                $arr[$domain]= $status;
            }
                        
            file_put_contents($name,print_r($arr,TRUE));
        } 
        
        protected function topCheck($name,$dm)
        {
            
            $xmlstr = file_get_contents("http://backend.antagus.de/bdom/domain/check/".$dm."/".$name."/100064/");
            $xml=simplexml_load_string($xmlstr);
            $status=$xml->status;

            return (string) $status;
        } 
        
        protected function adomainCheck()
        {
            $allDomains =["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop","at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk","bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien","academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
            $topDomains = ["de","com","eu","org","net","blog","club","info","koeln","me","one","online","shop"];
            $euDomains= ["at","be","bg","ch","cz","de","dk","es","eu","fr","gi","gr","im","is","it","li","lt","lu","lv","me","nl","pl","ro","se","si","sk","uk"];
            $regionDomains = ["bayern","berlin","cologne","hamburg","koeln","nrw","ruhr","saarland","wien"];
            $newDomains = ["academy","accountant","actor","agency","associates","auction","band","bar","bid","bike","bingo","bio","biz","blog","boutique","build","builders","business","cab","cafe","camera","camp","cards","care","casa","catering","center","chat","church","city","cleaning","click","clinic","cloud","club","coach","codes","coffee","cologne","com","community","company","computer","construction","cooking","cool","cz","dance","date","dating","de","dental","design","digital","direct","directory","discount","dk","dog","domains","download","earth","education","email","equipment","es","estate","eu","events","exchange","expert","exposed","express","family","fan","fans","farm","fashion","feedback","film","fish","fit","fitness","florist","football","forsale","fr","fund","furniture","gallery","garden","gift","glass","global","gmbh","gold","golf","gr","graphics","gratis","group","guide","hamburg","haus","help","holiday","horse","host","house","im","immo","immobilien","industries","info","ink","institute","international","is","it","jetzt","kaufen","kitchen","koeln","land","legal","li","life","lighting","limo","link","live","lol","love","lt","ltd","lu","lv","management","market","marketing","me","media","memorial","men","menu","mobi","moda","name","net","network","ninja","nl","nrw","one","online","org","partners","parts","party","photo","photography","photos","pics","pictures","pizza","pl","plus","press","productions","properties","pub","racing","reise","reisen","rentals","repair","report","rest","restaurant","review","reviews","rip","ro","rocks","ruhr","run","saarland","sale","salon","school","schule","science","se","services","shoes","shop","show","si","singles","site","sk","ski","social","software","solar","solutions","space","store","stream","studio","study","style","supplies","supply","support","surf","systems","tattoo","taxi","team","tech","technology","tel","tennis","theater","tips","tirol","today","tools","tours","town","toys","trade","training","uk","vacations","ventures","video","vip","vision","watch","webcam","website","wedding","wien","wiki","win","work","works","world","wtf","xyz","yoga","zone"];
            
            $name=\Input::post('name');
            
          
            if(\Input::post('id')!=0)
            {
                $result=\Database::getinstance()->prepare('SELECT alias FROM tl_ls_shop_product WHERE id = ?')->execute(\Input::post('id'))->alias;
                $result=explode("-",$result);
                $tld=end($result);
                
                $var = explode('.',$name);
                $var = end($var);
     
                if($var!==$tld)
                {
                    if(!in_array($var,$allDomains))
                    {
                    $name=$name.".". $tld;
                   
                    }
                }
                
                
            }
            
            
           $domains=explode(".",$name);
           $manual= ["ac","af","ag","am","as","bg","bi","bo","bs","bt","by","bz","cd","cg","cn","co","cr","cx","dk","dm","ec","fm","fo","gd","gg","gi","gl","gm","gp","gr","gs","gy","hk","hn","ie","im","in","io","is","ir","je","ki","kz","la","lt","lu","lv","md","mg","mn","ms","nr","nu","pl","ro","ru","rw","se","si","sh","sk","sl","st","su","tc","tk","tm","to","ug","vg","ws"];           
           $status;
           $msg;
           if(in_array(end($domains),$manual))
           {
               
               $url = \Contao\PageModel::findById(696)->getFrontendUrl();
              //Controller::redirect($url);
             //  header('Location: '.$url);
             
               echo($url);
               exit;
           }
           elseif(count($domains)>2)
           {
               $url = \Contao\PageModel::findById(697)->getAbsoluteUrl();
             //  header('Location: '.$url);
             // \Controller::redirect($url);
                echo($url);
               
               exit;
               
           }
           
           $flag=0;
            if(in_array(end($domains),$allDomains)&& count($domains)>1)
            {
                $dmName= str_replace(".".end($domains),"",$name); 
                $_SESSION['domains']['lastSearched']['value']=$dmName;
                file_put_contents("xmls",$dmName.":".end($domains).":".$name);
                $_SESSION['domains']['lastSearched']['value']=$dmName;
                $status=$this->topCheck($dmName,end($domains));
                $msg= $dmName.".".end($domains);
                $_SESSION['domains']['lastSearched']['tld']=end($domains);
            }
            elseif(count($domains)==1)
            {
                $flag=1;
              $status= $this->topCheck($name,"de");
              $_SESSION['domains']['lastSearched']['value']=$name;
              $msg=$name.".de";
              $_SESSION['domains']['lastSearched']['tld']="de";
            }
            else
            {
                $url = \Contao\PageModel::findById(697)->getAbsoluteUrl();

                echo($url);
                exit;
            }
            $url = \Contao\PageModel::findById(687)->getFrontendUrl();
            //Controller::redirect($url);
            //header('Location: '.$url);
            
            $_SESSION['domains']['lastSearched']['name']= $msg;
            $_SESSION['domains']['lastSearched']['av']= $status;
            //echo($msg." ".$status);
            echo($url);
            
            exit;
              // return [$status,$msg];
            
            
        }
        
        protected function domainCheck()
        {
            $name= \Input::post('name');
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
        
        
        protected function check()
        {
           
            $name=\Input::post('name');
            file_put_contents("precheck","");
            //$xml = file_get_contents("http://backend.antagus.de/bdom/domain/check/de/".$name."/100064/");
            $status=$this->adomainCheck();
            file_put_contents("postcheck",""); 
            //$status=$this->domainCheck(); 
            //echo($status[1]." ".$status[0]);
            //$xml=simplexml_load_string($xmlstr);
            //$status=$xml->response->status;
          //  file_put_contents("xml",print_r($xml,TRUE));
            //file_put_contents("status",$status);

            exit;
        }
        
        
        
    
}
