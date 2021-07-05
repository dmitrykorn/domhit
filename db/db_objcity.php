<?php //Создание таблицы городских объектов 
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query = "CREATE TABLE objcity (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    kadnumber VARCHAR(32) NOT NULL,
    region VARCHAR(32) NOT NULL,
    typead VARCHAR(32) NOT NULL,
    adress VARCHAR(32) NOT NULL,
    map VARCHAR(32) NOT NULL,
    metro VARCHAR(32) NOT NULL,
    district VARCHAR(32) NOT NULL,
    districtmo VARCHAR(32) NOT NULL,
    typeobj VARCHAR(32) NOT NULL,
    area VARCHAR(32) NOT NULL,
    floorobj VARCHAR(32) NOT NULL,
    floors VARCHAR(32) NOT NULL,
    arearoom  VARCHAR(32) NOT NULL,
    areakitch VARCHAR(32) NOT NULL,
    balcony INT NOT NULL,
    lodge VARCHAR(32) NOT NULL,
    toilet VARCHAR(32) NOT NULL,
    repairqual VARCHAR(32) NOT NULL,
    ceilinghi VARCHAR(32) NOT NULL,
    photoobj BLOB,
    descriptobj VARCHAR(32) NOT NULL,
    priceobj VARCHAR(32) NOT NULL,
    objin DATE NOT NULL,
    objshstart DATE NOT NULL,
    objshstop DATE NOT NULL,
    PRIMARY KEY (id)
  )"; 
  $result = $conn->query($query);
  if (!$result) die ("Сбой при доступе к базе данных: " . $conn->error);
?>