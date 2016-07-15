<?


class DataManager{
    
   function __construct() {
        include("config.php");
    } 

    function getNewsHtmlFromRSS($date, $rss){
        $content = file_get_contents($rss);
        $x = new SimpleXmlElement($content);
        $html="";
        foreach($x->item as $entry) {
            $pubDate = $entry->pubDate;
            if($pubDate==$date){
                $title = $entry->title."";
                $description = $entry->description."";
                $link = $entry->link."";

                $str ="<div style='clear: both;'>&nbsp;</div>";
                $str.="<h2>".$title."</h2>";
                $str.="<p>&nbsp;</p><div><p>".$description."</p></div>";
                $str.="<a href='".$link."' target='_blank' rel='noopener'>Читать далее</a>";
                $html.=$str;
            }
        }
        echo $html;
    }

    function sendEmail($email, $subject, $text){
        require_once "SendMailSmtpClass.php"; 
        $mailSMTP = new SendMailSmtpClass('kazakhtvnews@mail.ru', 'qwe123!@#KTV', 'ssl://smtp.mail.ru', 'Kazakh TV Новости', 465); 
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Kazakh TV Новости <kazakhtvnews@mail.ru>\r\n"; 
        $result =  $mailSMTP->send($email, $subject, $text, $headers); 
        //$result =  $mailSMTP->send('Кому письмо', 'Test', 'Текст письма', 'Заголовки письма');
        echo $result;
    }

    function createWidgetSettings($widget_settings){
        
    }

    function getCategories(){
        $feed_url = "http://kazakh-tv.kz/rss-ru.xml";
        $content = file_get_contents($feed_url);
        $x = new SimpleXmlElement($content);
        $categories = array();
        $i=0;
        foreach($x->item as $entry) {
            $cat = $entry->category."";
            if (!in_array($cat, $categories)){
                $categories[$i]=$cat;
                $i++;
            }
        }
		echo "getCategories()";
    }
    
    /*--------------------------------------USER--------------------------------------------------*/
    function createUser($email, $password){
        $statement = $this->getPDOStatement("INSERT INTO users(email, password) VALUES(:email, :password);");
        $statement->execute(array(
            ':email' => $email,
            ':password'=>$password,
        ));
        if($this->checkForError($statement)){
            echo "Регистрация успешно завершена!";
        }    
    }

    function getUser($email, $password){
        $statement = $this->getPDOStatement("select * from users where email=:email and password=:password");
        $statement->execute(array(
            ':email'=>$email,
            ':password'=>$password,
        ));        
        $result =$statement->fetch();
        echo json_encode($result);        
    }

    function getPDOStatement($query){
        $pdo = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        return $pdo->prepare($query);
    }

    function createWidget($rss, $userId){
        $statement = $this->getPDOStatement("INSERT INTO widgets(rss, userId, guid) VALUES(:rss, :userId, :guid);");
        $statement->execute(array(
            ':rss' => $rss,
            ':userId'=>$userId,
            ':guid'=>md5($rss."+".$userId),
        ));

        if($statement->errorCode()!="00000"){
            var_dump($statement->errorInfo());
        }
    }

    function getWidgets($userId){

        $statement = $this->getPDOStatement("select * from widgets where userId=:userId");
        $statement->execute(array(
            ':userId'=>$userId,
        ));        
        $result =$statement->fetchAll();
        echo json_encode($result);
    }

    function createSubscription($email, $guid){
        $isExist = $this->checkSubscriptionForExistance($email,$guid);
        
        if(!$isExist){
            $statement = $this->getPDOStatement("INSERT INTO subscriptions(email, guid) VALUES(:email, :guid);");
            $statement->execute(array(
                ':email' => $email,
                ':guid'=>$guid,
            ));

            if($this->checkForError($statement)){
                echo "Подписка успешно завершена!";
            }    
        }else{
            echo "Вы уже подписаны";
        }
    }

    function checkForError($statement){
        if($statement->errorCode()!="00000"){
            var_dump($statement->errorInfo());
        }else{
            return true;
        }
    }

    function checkSubscriptionForExistance($email,$guid){
        $statement = $this->getPDOStatement("Select * from subscriptions where email=:email and guid=:guid");
        $statement->execute(array(
            ':email' => $email,
            ':guid'=>$guid,
        ));
        $result =$statement->fetchAll();
        if(count($result)==0) return false;
        return true;
    }

    function checkGUIDForExistance($guid){

    }

}
?>