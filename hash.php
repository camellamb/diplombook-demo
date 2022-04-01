$DB = new Database();
$sql = "select * from users";
$result = $DB->read($sql);

foreach ($result as $row) {
    $id = $row['id'];
    $password = hash("sha1", $row['password']);

    $sql = "update users set password = '$password' where id = '$id' limit 1";
    $DB->save($sql);
}