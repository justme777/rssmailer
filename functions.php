<?
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
    
    function testGet(){
        echo "function testGet()";
    }

    function testPost(){
        echo "function testPost()";
    }

    function testPostParams($login, $pass){
        echo "login=".$login." pass=".$pass;
    }

    //POST
    function createUser($email, $password){
        $servername="localhost";
        $database="rssmailer";
        $username="root";
        $password="";
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        $statement = $pdo->prepare("INSERT INTO `rssmailer`.`users` (`email`) VALUES ( :email)");
        $statement->execute(array(
			'email' => $email,
		));
        $StatusUpdate = $statement->errorCode();
        echo "code=".$StatusUpdate;      
    }

    function getPDOStatement($query){
        $servername="localhost";
        $database="db_rssmailer";
        $username="root";
        $password="";
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        return $pdo->prepare($query);
    }

    function createWidget($rss, $userId){
        $statement = $this->getPDOStatement("INSERT INTO widgets(rss, userId) VALUES(:rss, :userId);");
        $statement->execute(array(
            ':rss' => $rss,
            ':userId'=>$userId,
        ));

        if($statement->errorCode()!="00000"){
            var_dump($statement->errorInfo());
        }
    }
}
?>