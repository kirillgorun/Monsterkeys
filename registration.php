<?php

  if (isset($_POST['email']) && $_POST['email'])
    $email = $_POST['email'];
  else {
    die('Введите email');
  }
  if (isset($_POST['password']) && $_POST['password'])
    $password = $_POST['password'];
  else {
      die('Введите пароль!');
  }
  // подключение к БД
  $mysqli = new mysqli("127.0.0.1", "root", "", "monsterkeys");
  if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
  }

  $res = $mysqli->query("SELECT id FROM user WHERE email='$email'");
  if($row = $res->fetch_assoc()){
    die('Пользователь уже зарегистрирован!');
  };

  $password = md5('QWERTY'.$password.'QWERTY');
  if (!$mysqli->query("INSERT INTO user(email, password) VALUES('$email','$password')")) {
    die("Не удалось выполнить вставку: (" . $mysqli->errno . ") " . $mysqli->error);
  }

  echo "Пользователь $email успешно зарегистрирован";
 
