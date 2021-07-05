<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


// $result = $conn->query($query);
// if (!$result) die ($conn->error);

// if (isset($_POST['delete']) && isset($_POST['email']))
//   {
//     $email  = get_post($conn, 'email');
//     $query = "DELETE FROM classics WHERE email='$email'";
//     $result = $conn->query($query); 
//     if (!$result) echo "Сбой при удалении данных: $query<br>" .
//           $conn->error . "<br><br>";
//   }

if (isset($_POST['surname']) &&
    isset($_POST['named']) &&
    isset($_POST['patronymic']) &&
    isset($_POST['idus'])
    )

  {
    $surname   = get_post($conn, 'surname');
    $named    = get_post($conn, 'named');
    $patronymic = get_post($conn, 'patronymic');
    $idus  = get_post($conn, 'idus');
    $photo = get_post($conn, 'photo');
    $query    = "INSERT INTO classics VALUES" . "('$idus','$surname', '$named', '$patronymic', '$photo')";

    $result   = $conn->query($query); 
if (!$result) echo "Сбой при вставке данных: $query<br>" .
    $conn->error . "<br><br>";
  }
echo <<<_END
<form action="index.php" method="post"><pre>
Фамилия <input type="text" name="surname">
Имя <input type="text" name="named">
Отчество <input type="text" name="patronymic">
Номер <input type="text" name="idus">
Фото <input type="url" placeholder="Имя фото" name="site" required>
<input type="submit" value="ADD RECORD">
</pre></form>
_END;

function get_post($conn, $var)
{
  return $conn->real_escape_string($_POST[$var]);
}
?>