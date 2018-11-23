<?php
require_once 'database_conn.php';
require_once 'user_class.php';
require_once 'connection_for_content.php';

$userObj = new User("userinfo");
// $user = $userObj->_getLogin("");


if (isset($_GET['logout'])){
  session_destroy();
  header("location /");
}


if (isset($_POST['authorization'])){
  $login = $_POST['login_auth'];
  $password = $_POST['password_auth'];

  $user = $userObj->_getLogin($login);
  if ($user != 0){
    if ($password == $user[0]['Password']){
      $_SESSION['authUser'] = 1;
      $_SESSION['userLogin'] = $login;
      echo "<script>alert('Авторизация прошла успешно')</script>";
    }else{
      echo "<script>alert('Неверный ввод данных')</script>";
    }
  }else echo "<script>alert('Пользователя не существует')</script>";
}


if (isset($_POST['registration'])){
  $login = $_POST['login_reg'];
  $password = $_POST['password_reg'];
  $r_password = $_POST['repeat_password_reg'];
  $mail = $_POST['mail_reg'];
  $phone = $_POST['phone_reg'];
  $name = $_POST['name_reg'];
  $surname = $_POST['last_name_reg'];
  $veryLastName = $_POST['very_last_name_reg'];
  if (preg_match("/^[0-9]{3,5}$/", $login)){
    $user = $userObj->_getLogin($login);
    if ($user == 0) {
      if (preg_match("/^[0-9]+$/", $password)){
        //if (preg_match("/^[А-Яа-яЁё]*$/", $name)){
          //if (preg_match("/^[А-Яа-яЁё]*$/", $surname)){
            //if (preg_match("/^[А-Яа-яЁё]*$/", $veryLastName)){
              if (preg_match("/^[0-9]{4}$/", $phone)){
                //if (preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email)){
                  if ($password == $r_password){
                    $userObj->addUserToTable($login, $password, $mail, $phone, $name, $surname, $veryLastName);
                    echo "<script>alert('Регистрация прошла успешно')</script>";
                  }else echo "<script>alert('Данные не совпадают')</script>";
                //}else echo "<script>alert('маил')</script>";
              }else echo "<script>alert('Телефон должен состоять из четырёх чисел')</script>";
            //}else echo "<script>alert('отчество')</script>";
          //}else echo "<script>alert('фамилия')</script>";
        //}else echo "<script>alert('имя')</script>";
      }else echo "<script>alert('Табельный номер должен состоять из 3-5 чисел')</script>";
    }else echo "<script>alert('Такой пользователь уже существует')</script>";
  }
}
?>



<html>
<head>
    <meta charset="utf-8" />
    <title>ItSupport</title>
    <link rel="stylesheet" href="ItSupport.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="shortcut icon" href="img/IFNS.ico" type="icon"> 
</html>
<body>
<header>
    <div class="header__logo"><p>It поддержка</p></div>
    <nav>
        <div class="topnav" id="mytopnav">
            <?php if(isset($_SESSION['authUser']) && $_SESSION['authUser'] == 1): ?>
              <a href="?logout">Выход из системы</a>
            <?php else: ?>
              <a href="#" onclick="get_in_form_show();">Вход в систему</a>
            <?php endif ?>
              <a href="#" onclick="form_registration_show();">Регистрация</a>
              <a href="#" id="menu" class="icon">&#9776;</a>
        </div>
    </nav>
</header>
<main>
    <div class="main_welcome" id="page_one">
        <div class="welcome_left">
            <img  class="mw-100"src="img/IFNS.ico" alt="Info">
        </div>
        <div class="welcome_right">
            <h1>ТЕХНИЧЕСКАЯ ПОДДЕРЖКА ОТДЕЛА ИНФОРМАЦИОННЫХ ТЕХНОЛОГИЙ</h1>
            <p>
                Информационный ресурс предоставляет работникам Межрайонной ИНФС№14 
                по Московской области<br>
                необходимую техническую поддержку.
            </p>
        </div>
</div>



<div class="container">
  <div id="blog" class="row"> 
    <h1>Наиболее популярные запросы</h1>
        <div class="blogShort">
          <?php 
            $query = $pdo->query('select * from problemlist where id = 1'); 
            $res = $query->fetchAll(); 
            foreach ($res as $key )
          ?>
        <h2><?php echo $key ['PrName'] ?></h2>
        <h3><?php echo $key ['PrDifficult'] ?></h3>
        <article><p><?php echo $key ['PrContent'] ?></p></article>
        </div>
        <div class="button_change">
            <button type="submit" class="btn-change" name="change1" hidden="true">Изменить</button>
        </div>

        <div class="blogShort">
          <?php 
            $query = $pdo->query('select * from problemlist where id = 2'); 
            $res = $query->fetchAll(); 
            foreach ($res as $key ) 
          ?>
        <h2><?php echo $key ['PrName'] ?></h2>
        <h3><?php echo $key ['PrDifficult'] ?></h3>
        <article><p><?php echo $key ['PrContent'] ?></p></article> 
        </div>
        <div class="button_change">
            <button type="submit" class="btn-change" name="change2" hidden="true">Изменить</button>
        </div>

        <div class="blogShort">
          <?php 
            $query = $pdo->query('select * from problemlist where id = 3'); 
            $res = $query->fetchAll(); 
            foreach ($res as $key ) 
          ?>
        <h2><?php echo $key ['PrName'] ?></h2>
        <h3><?php echo $key ['PrDifficult'] ?></h3>
        <article><p><?php echo $key ['PrContent'] ?></p></article>
        </div>
        <div class="button_change">
            <button type="submit" class="btn-change" name="change3" hidden="true">Изменить</button>
        </div>

        <div class="blogShort">
        <?php 
            $query = $pdo->query('select * from problemlist where id = 4'); 
            $res = $query->fetchAll(); 
            foreach ($res as $key ) 
          ?>
        <h2><?php echo $key ['PrName'] ?></h2>
        <h3><?php echo $key ['PrDifficult'] ?></h3>
        <article><p><?php echo $key ['PrContent'] ?></p></article>
        </div>
        <div class="button_change">
            <button type="submit" class="btn-change" name="change4" hidden="true">Изменить</button>
        </div>

        <div class="blogShort">
        <?php 
            $query = $pdo->query('select * from problemlist where id = 5'); 
            $res = $query->fetchAll(); 
            foreach ($res as $key ) 
          ?>
        <h2><?php echo $key ['PrName'] ?></h2>
        <h3><?php echo $key ['PrDifficult'] ?></h3>
        <article><p><?php echo $key ['PrContent'] ?></p></article>
        </div>
        <div class="button_change">
            <button type="submit" class="btn-change" name="change5" hidden="true">Изменить</button>
        </div>

  <div class="col-md-12 gap10"></div>
  </div>
</div>



<div class="main_mailform" id="page_three">
    <form id="formmail" method="POST" action="mail.php">
        <div class="form-row">
          <div class="_col">
            <label for="exampleInputтName1">Ваше имя</label>
            <input type="text" class="form-control" placeholder="Например, Иван" name="name_mail" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
          </div>
          <div class="_col">
            <label for="exampleInputтLastName1">Ваша фамилия</label>
            <input type="text" class="form-control" placeholder="Например, Иванов" name="last_name_mail" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
          </div>
          <div class="_col">
            <label for="exampleInputтLastName1">Ваше отчество</label>
            <input type="text" class="form-control" placeholder="Например, Иванович" name="very_last_name_mail" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
          </div>
        </div>
        <div class="content_text_mail">
          <div class="form-group00">
            <div class="form-group0">
                <label for="recipient-mail" class="col-form-label">Ваш email:</label>
                <input type="email" name="email_mail" id="recipient-mail" class="form-control" placeholder="Например, ivan.ivanov@gmail.com" required>
            </div>
            <div class="form-group0">
                <label for="recipient-phone" class="col-form-label">Ваш телефон:</label>
                <input type="text" id="recipient-phone" class="form-control" name="phone_mail" placeholder="Напрмиер, 1111" maxlength="4" pattern="[0-9]{4}" required>
            </div>
          </div>
          <div class="_form-group1">
              <textarea name="message_mail" id="message-text" class="form-control" placeholder="Напишите суть вашей проблемы" required></textarea>
          </div>
        </div>
          <button type="submit" class="btn_mail">Отправить отзыв</button>
      </form>
</div>





















<div id="black_form" onclick="form_registration_close();">
</div>

<div class="" id="registration_form">
  <form method="POST"">
    <p class="">Регистрация</p>
    <div class="FI_content">
      <div class="col">
        <label for="exampleInputтName1">Ваше имя</label>
        <input type="text" class="form-control" id="exampleInputтName1" placeholder="Например, Иван" name="name_reg" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
      </div>
      <div class="col">
        <label for="exampleInputтLastName1">Ваша фамилия</label>
        <input type="text" class="form-control" id="exampleInputтLastName1" placeholder="Например, Иванов" name="last_name_reg" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
      </div>
      <div class="col">
        <label for="exampleInputтLastName1">Ваше отчество</label>
        <input type="text" class="form-control" id="exampleInputтLastName1" placeholder="Например, Иванович" name="very_last_name_reg" maxlength="30" pattern="^[А-Яа-яЁё\s]+$" required>
      </div>
    </div>
    <div class="form-group">
      <label for="exampleInputPhone1">Табельный номер</label>
      <input type="text" class="form-control" id="exampleInputPhone1" placeholder="Например, 111" name="login_reg" autocomplete="off" maxlength="5" pattern="[0-9]{3,5}" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPhone1">Внутренний номер телефона</label>
      <input type="text" class="form-control" id="exampleInputPhone1" placeholder="Например, 1111" name="phone_reg" maxlength="4" pattern="[0-9]{4}" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPhone1">Email</label>
      <input type="email" class="form-control" id="exampleInputPhone1" placeholder="Например, ivan.ivanov@gmail.com" name="mail_reg" maxlength="50" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Например, 123456789" name="password_reg" maxlength="10" pattern="^[0-9]+$" required>
    </div>
    <div class="form-group">
      <label for="exampleInputRepeatPassword1">Повторите пароль</label>
      <input type="password" class="form-control" id="exampleInputRepeatPassword1" placeholder="Например, 123456789" name="repeat_password_reg" maxlength="10" pattern="^[0-9]+$" required>
    </div>
    <div class="button_reg">
      <button type="submit" class="btn-1" name="registration">Зарегистрироваться</button>
    </div>
  </form>
</div>




<div id="black_form2" onclick="get_in_form_close();">
</div>

<?php if (!isset($_SESSION['authUser']) || $_SESSION['authUser'] != 1){ ?>
  <div class="" id="get_in_form">
  <form method="POST" action="">
    <p class="">Вход в систему</p>
    <div class="form-group1">
      <label for="exampleInputPhone2">Табельный номер</label>
      <input type="text" class="form-control" id="exampleInputPhone2" placeholder="Например, 111" name="login_auth" autocomplete="off" maxlength="5" pattern="[0-9]{3,5}" required>
    </div>
    <div class="form-group1">
      <label for="exampleInputPassword2">Пароль</label>
      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Например, 123456789" name="password_auth" maxlength="10" pattern="^[0-9]+$" required>
    </div>
    <div class="button_get_in">
      <button type="submit" class="btn-2" name="authorization">Выполнить вход</button>
    </div>
  </form>
</div>
<?php }else{
  echo "<script>alert('Добро пожаловать, $_SESSION[userLogin]')</script>";

 } ?>

</main>
</body> 
  <script src="jQuery.js"></script>
  <script src="registration_menu.js"></script>
  <script src="getin_menu.js"></script>
</html>