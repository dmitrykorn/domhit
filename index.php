<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['delete']) && isset($_POST['photo'])) {
  $photo  = get_post($conn, 'photo');
  $query = "DELETE FROM classics WHERE photo='$photo'";
  $result = $conn->query($query);
  if (!$result) echo "Сбой при удалении данных: $query<br>" .
    $conn->error . "<br><br>";
}

if ( // проверка наличия данных в переданном массиве POST
  isset($_POST['idus']) &&
  isset($_POST['surname']) &&
  isset($_POST['named']) &&
  isset($_POST['patronymic']) &&
  isset($_POST['photo'])
) { // получение данных из массива POST и присваение значений переменным
  $idus  = get_post($conn, 'idus');
  $surname   = get_post($conn, 'surname');
  $named    = get_post($conn, 'named');
  $patronymic = get_post($conn, 'patronymic');
  $photo = get_post($conn, 'photo');
  // добавление данных в базу
  $query    = "INSERT INTO classics VALUES" . "('$idus','$surname', '$named', '$patronymic', '$photo')";
  // проверка успешности добавления данных в базу 
  $result   = $conn->query($query);
  if (!$result) echo "Сбой при вставке данных: $query<br>" .
    $conn->error . "<br><br>";
}

// форма ввода данных
echo <<<_END
<form action="index.php" method="post"><pre>
Фамилия <input type="text" name="surname">
Имя <input type="text" name="named">
Отчество <input type="text" name="patronymic">
Номер <input type="text" name="idus">
Фото <input type="text" placeholder="Имя фото" name="photo">
<input type="submit" value="ADD RECORD">
</pre></form>
_END;

// удаление записей из базы данных    
$query = "SELECT * FROM classics";

$result = $conn->query($query);
if (!$result) die("Сбой при доступе к базе данных: " . $conn->error);
$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
  $result->data_seek($j);
  $row = $result->fetch_array(MYSQLI_NUM);

  // форма вывода данных
  echo <<<_END
<pre>
Номер: $row[0]
Фамилия: $row[1]
Имя: $row[2]
Отчество: $row[3]
Фото (ссылка): $row[4]
</pre>
<form action="index.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="photo" value="$row[4]">
<input type="submit" value="DELETE RECORD"></form>
_END;
}

// проверка данных
function get_post($conn, $var)
{
  return $conn->real_escape_string($_POST[$var]);
}
