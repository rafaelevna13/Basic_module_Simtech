                
                Инструкция по установке и использованию приложения:
0. Так как файл с инструкцией находится внутри архива, предполагается что архив уже распокован.
1. Необходимо содержимое архива "AnzhelaP.zip" вложить в корневую папку сервера.
    Файлы, которые объязательно должны быть перенесены в данную папку:
    "index.html", "users.html", "main.css", "index.php", "mail.php", "pagination.php", папка: PHPMailer.

2. Открыть файл "index.php" и изменить следующие значения на собственные:
    $servername = "localhost"; //имя сервера
    $username = "root";        //логин к СУБД
    $db_password = "root";     //пароль к СУБД

3. Открыть phpMyAdmin и загрузить(импортировать на текущий сервер) базу данных "contact_us.sql". 
Проверить загрузку таблицы "customers" в базе данных "contact_us".

4. Открыть браузер и прописать в нем путь к корневой папке сервера. Ура! Теперь вы можете заносить данные клиентов, а также нажав "to table", браузер перенесет вас на новую страницу, где вы сможете просмотривать список результатов.

5. Также был добавлен функционал в виде возможности отправлять результаты на электронную почту администратора. 
Данные для входа в личный кабинет почты:
    Логин почты = rafaelevna13a@yandex.ru
    Пароль почты = 13rafaelevna
    (Доп: пароль PHPMailer = pftqrewxxlgtyher)


        Работа выполнялась на ноутбуке с операционной системой macOS (Monterey (версия 12.5.1))
Был использован софт mamp, в который уже был включен Apache, MySQL, PHP. 
(тема настройки окружения(на windows и linux) была просмотрена.)

    Сервер баз данных:
Сервер: Localhost via UNIX socket
Тип сервера: MySQL
Соединение сервера: SSL не используется Документация
Версия сервера: 5.7.34 - MySQL Community Server (GPL)
Версия протокола: 10
Пользователь: root@localhost
Кодировка сервера: UTF-8 Unicode (utf8)

    Веб-сервер:
Apache/2.4.46 (Unix) OpenSSL/1.0.2u PHP/7.4.21 mod_wsgi/3.5 Python/2.7.18 mod_fastcgi/mod_fastcgi-SNAP-0910052141 mod_perl/2.0.11 Perl/v5.30.1
Версия клиента базы данных: libmysql - mysqlnd 7.4.21
PHP расширение: mysqli  Документация curl  Документация mbstring  Документация
Версия PHP: 7.4.21 

Bерсия phpMyAdmin: 5.1.1
bootstrap 4.6



		Дополнительная информация, в виде подробного описания выполняемой работы:
Cоздана форма обратной связи находящаяся в файле «index.html» со всеми возможными элементами: reset, input , file, checkbox, select, textarea, button, email, text, radio, в которой используется bootstrap 4.6. 
Для улучшения визуальной составляющей веб-страницы был создан и привязан к html файлам «main.css». В нем используется задание цвета, шрифтов, стилей, расположения отдельных блоков и других аспектов для классов и элементов созданных самостоятельно.

Подключении базы данных:
В программе для управления сервером и базой данных (PHP My Admin) создана пустая база данных под названием «contact_us»,  выбрав 'Создать базу данных’.  Способ кодировки выбран uft8mb4_general_ci.  При подключении базы данных  выбран процедурный тип API.  Первым делом в файле «index.php» указаны переменные, которым присвоено имя сервера, имя, пароль, и название будущей базы данных «contact_us».  С помощью команды mysqli_connect производится соединение с сервером MySQL по указанным данным.

Далее выполнена проверка подключения. В случае возникновения ошибки, благодаря mysqli_connect_error  появляется сообщение об ошибке последней попытки подключения. 

Создание таблиц баз данных:
После установления подключения к базе данных "contact_us" для создания таблицы в базу данных создан SQL запрос он содержит в себе: оператор CREATE TABLE с названием таблицы customers. Данные находятся в файле "query.sql" .
В файле добавлена проверка обязательных полей формы, благодаря команде NOT NULL. А для строчек с возможностью перечисления выбран ENUM, благодаря которому в базу данных будет оправлять один из выбранных клиентом пункт.

Благодаря команде   «if ($_SERVER['REQUEST_METHOD'] === 'POST’)»,  и созданию последующих переменных происходит связь между именами указанными в файле «index.html» и таблицей базы данных.
Выбраный метод -> POST.

Для работы с табличными данными первым делом(теперь и в php) задается условие необходимости проверки обязательных полей формы таких как $first_name, $phone_number, $email_address. Если условия выполняются и клиент заполнил необходимые строки с помощью операции alert будет выпадать текст с информацией о том, что форма успешно отправлена. 
Если же условия будут не выполнены выпадает информация об ошибке.

Следующим этапом было подготовить таблицу и сохранить результаты отправки формы в базу данных с добавлением функционала постраничной навигации для списка с результатами(пагинацию).
Первым делом создан отдельный файл «users.html», который также привязан к «main.css». Благодаря bootstrap 4.6 в нем создана таблица, для вывода списка результатов. 
'pagination.php'

Добавлен файл "mail.php", благодаря которому появляется возможность отправлять результаты на электронную почту администратора (в настройках почты необходимо разрешить доступ к почтовому ящику с помощью почтовых клиентов).
Логин почты = rafaelevna13a@yandex.ru
Пароль почты = 13rafaelevna
Пароль PHPMailer = pftqrewxxlgtyher
