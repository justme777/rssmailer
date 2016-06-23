<?php



/*
// пример использования
require_once "SendMailSmtpClass.php"; // подключаем класс
  
$mailSMTP = new SendMailSmtpClass('ereke_enu@mail.ru', '***', 'ssl://smtp.mail.ru', 'Yerlan', 465); // создаем экземпляр класса
// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');
  
// заголовок письма
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
$headers .= "From: Yerlan <ereke_enu@mail.ru>\r\n"; // от кого письмо !!! тут e-mail, через который происходит авторизация
$result =  $mailSMTP->send('almasmyltykbayev@mail.ru', 'Тема письма', 'Текст письма', $headers); // отправляем письмо
// $result =  $mailSMTP->send('Кому письмо', 'Test', 'Текст письма', 'Заголовки письма');
if($result === true){
    echo "Письмо успешно отправлено";
}else{
    echo "Письмо не отправлено. Ошибка: " . $result;
}
*/

$feed_url = "http://kazakh-tv.kz/rss-ru.xml";
$content = file_get_contents($feed_url);
$x = new SimpleXmlElement($content);

$categories = array();
$i=0;

foreach($x->item as $entry) {
     $cat = $entry->category."";
     if (!in_array($cat, $categories)){
         $categories[$i]=$cat;
         echo "cat=".$cat."<br/>";
         $i++;
     }
}



?>