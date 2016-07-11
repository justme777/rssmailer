<?php 

class DataManager{
    public $servername="localhost";
    public $database="db_rssmailer";
    public $username="root";
    public $password="";

    function sendEmail(){
        require_once "SendMailSmtpClass.php"; 
        $mailSMTP = new SendMailSmtpClass('ereke_enu@mail.ru', '***', 'ssl://smtp.mail.ru', 'Yerlan', 465); 
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Yerlan <ereke_enu@mail.ru>\r\n"; 
        $result =  $mailSMTP->send('almasmyltykbayev@mail.ru', 'Тема письма', 'Текст письма', $headers); 
        //$result =  $mailSMTP->send('Кому письмо', 'Test', 'Текст письма', 'Заголовки письма');
        if($result === true){
            echo "Письмо успешно отправлено";
        }else{
            echo "Письмо не отправлено. Ошибка: " . $result;
        }
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
        $statement = $this->getPDOStatement("INSERT INTO subscriptions(email, guid) VALUES(:email, :guid);");
        $statement->execute(array(
            ':email' => $email,
            ':guid'=>$guid,
        ));
        if($this->checkForError($statement)){
            echo "Подписка успешно завершена!";
        }
    }

    function checkForError($statement){
        if($statement->errorCode()!="00000"){
            var_dump($statement->errorInfo());
        }else{
            return true;
        }
    }

    function checkSubscriptionForExistance($email){
        return true;
    }

    function checkGUIDForExistance($guid){

    }

}
?>