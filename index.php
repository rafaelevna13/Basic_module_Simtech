<?php

//Create connection to bd(contact_us) процедурный тип 
    $servername = "localhost";
    $username = "root";
    $db_password = "root";
    $db = "contact_us";  /* bd, в которую будет сохраняться информация о пользователе */
    
    $mysqli = mysqli_connect($servername, $username, $db_password, $db);

//  Check connection - проверка
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
                        // echo '<pre>';
                        // print_r($mysqli);   /* просмотр запроса */
                        // echo '</pre>';

/*    Описание:
Запроса страницы методом POST
$_SERVER- Информация о сервере и среде исполнения (это массив, содержащий информацию, такую как заголовки, пути и местоположения скриптов. Записи в этом массиве создаются веб-сервером)
*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // echo '<pre>';
                        // print_r($_REQUEST); /* просмотр запроса */
                        // echo '</pre>';

/*    Описание:
trim- удаляет пробелы (или другие символы) из начала и конца строки
$_REQUEST — Переменные HTTP-запроса (Ассоциативный массив (array), который по умолчанию содержит данные переменных $_GET, $_POST и $_COOKIE.)
['first_name']- это 'name', который был задан в html файле
*/
    $first_name = trim($_REQUEST['first_name']);
    $last_name = trim($_REQUEST['last_name']);
    $gender = ($_REQUEST['gender']);
    $phone_number = trim($_REQUEST['phone_number']);
    $email_address = trim($_REQUEST['email_address']);
    $notifications = ($_REQUEST['notifications']);
    $problem = trim($_REQUEST['problem']);
    $communication_method = ($_REQUEST['communication_method']);
    $custom_file = ($_FILES['custom_file']['name']) . " " . ($_FILES['custom_file']['tmp_name']);


/*Validation 
        Описание:
empty- пусто(восклицательный знак перед обознает отрицание, а значит не пусто)
&&- and
$mysqli-это мое подключение к базе данных и я через нее делаю запрос query...
query - (это метод) — Выполняет запрос к базе данных и с базами данных  мы общаемся на языке sql
INSERT INTO - Оператор INSERT INTO(вставить в) используется для вставки новых записей в таблицу. будет возвращать id последнего вставленного элемента
customers - название таблицы, в которой нужно смотреть и далее перечисление столбцов, которые есть в этой папке к котороым привязать переменные(в файле query.sql)
VALUES(значение) далее идут переменные из query.sql 
*/
if((!empty($first_name)) && (!empty($phone_number)) && (!empty($email_address)) )     {

    $mysqli->query("INSERT INTO customers (first_name, last_name, gender, phone_number, email_address, notifications, problem, communication_method, custom_file) 
    VALUES ('$first_name', '$last_name', '$gender', '$phone_number', '$email_address', '$notifications', '$problem', '$communication_method', '$custom_file')");

/* alert(оповещения из Bootstrap) */
    $joy = '<div class="alert alert-success" role="alert"> The form has been submitted successfully. Wait for communication with the operator! </div>';
    echo $joy;

    require_once 'email.php';  //для отправки на почту 

    }

else  {

    $loser = '<div class="alert alert-danger" role="alert"> Yours has not been sent. Check that the input fields are filled in correctly! </div>';
    echo $loser;
}

}

/*Pagination
        Описание:
isset — Определяет, была ли установлена переменная значением, отличным от null
:1 - буду задавать уже в отдельном html условия, чтобы это число менялось при пролитывании страницы ['list'- страница]
? - тернарные условия
$limit- это максимальное число строк, которое будет выводится на 1 страницу
$offset — пропускает указанное количество возвращаемых элементов 
result_sql - помещаем запрос в базу данных - вывести все строки 
$total_pages - это сколько всего будет страниц 
mysqli_num_rows- функция посчитать строки из переменной ($result_sql)
ceil-округляет в большую сторону
round- округление(число, до какого знака после запятой идет округление,но в данном случае возникает ошибка так как он округлял в меньшую сторону)
,0 - количество знаков после запятой 
*/
$list = isset($_REQUEST['list']) ? $_REQUEST['list'] :1;
$limit = 7;
$offset = $limit * ($list - 1);
$result_sql = $mysqli->query("SELECT * FROM customers");
$total_list = ceil(mysqli_num_rows($result_sql) / $limit);


/*    Описание:
SELECT(выбрать): вы говорите базе данных, что вам показать
FROM(из): вы даете базе данных местоположение для поиск
WHERE(где): вы сужаетесь/укаждаете местоположени
while - выполнять вложенные выражения повторно до тех пор, пока выражение в самом while является true.
MYSQLI_ASSOC - получить следующую строку результирующего набора в виде ассоциативного, числового массива или обоих
$result - массив созданный мною
query("SELECT * FROM customers" - получаем объект(все строки из базы данных) из полученных строк 
while ($result = mysqli_fetch_array($customers, MYSQLI_ASSOC)); - пробегались по всему объекту и из каждой строки делали ассоциативный массив 
LIMIT $limit OFFSET $offset- для пагинации
*/
$customers = $mysqli-> query("SELECT * FROM customers LIMIT $limit OFFSET $offset");
while ($result = mysqli_fetch_array($customers, MYSQLI_ASSOC)){

    $users[] = $result; 
}
                // echo '<pre>';
                // print_r($users); /* просмотр запроса */
                // echo '</pre>';



/*делаю это после того как данные уже все показались */
if (isset($_REQUEST['list']) ? $_REQUEST['list']: false) {
    require 'users.html';
} else{
    require 'index.html';
  }

?>


