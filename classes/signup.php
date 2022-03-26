<?php

//encode russian
$ru_array = array('А' => 'а', 'Б' => 'б', 'В' => 'в', 'Г' => 'г', 'Д' => 'д', 'Е' => 'е', 'Ё' => 'ё', 'Й' => 'й', 'Ж' => 'ж', 'З' => 'з', 'И' => 'и', 'К' => 'к', 'Л' => 'л', 'М' => 'м', 'Н' => 'н', 'О' => 'о', 'П' => 'п', 'Р' => 'р', 'С' => 'с', 'Т' => 'т', 'У' => 'у', 'Ф' => 'ф', 'Х' => 'х', 'Ц' => 'ц', 'Ч' => 'ч', 'Ш' => 'ш', 'Щ' => 'щ', 'Ъ' => 'ъ', 'Ы' => 'ы', 'Ь' => 'ь', 'Э' => 'э', 'Ю' => 'ю', 'Я' => 'я');
function lower($str)
{
    $ru_array = array('А' => 'а', 'Б' => 'б', 'В' => 'в', 'Г' => 'г', 'Д' => 'д', 'Е' => 'е', 'Ё' => 'ё', 'Й' => 'й', 'Ж' => 'ж', 'З' => 'з', 'И' => 'и', 'К' => 'к', 'Л' => 'л', 'М' => 'м', 'Н' => 'н', 'О' => 'о', 'П' => 'п', 'Р' => 'р', 'С' => 'с', 'Т' => 'т', 'У' => 'у', 'Ф' => 'ф', 'Х' => 'х', 'Ц' => 'ц', 'Ч' => 'ч', 'Ш' => 'ш', 'Щ' => 'щ', 'Ъ' => 'ъ', 'Ы' => 'ы', 'Ь' => 'ь', 'Э' => 'э', 'Ю' => 'ю', 'Я' => 'я');
    return strtr($str, $ru_array);
}
//

class Signup
{

    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error = $this->error . "Поле " .  $key . " пустое!<br>";
            }

            if ($key == "first_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . "Имя не может состоять из цифр!<br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . "Имя не может состоять из пробелов!<br>";
                }
            }

            if ($key == "last_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . "Фамилия не может состоять из цифр!<br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . "Фамилия не может состоять из пробелов!<br>";
                }
            }

            if ($key == "email") {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->error = $this->error . "Некорректная электронная почта!<br>";
                }
            }
        }

        if ($this->error == "") {
            //no error
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }

    public function create_user($data)
    {

        $firstname = ucfirst($data['first_name']);
        $lastname = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];

        //url variables
        $low_fn = lower($firstname);
        $low_ln = lower($lastname);

        //create these
        $url_address = $low_fn . "." . $low_ln;
        $userid = $this->create_user_id();

        $query = "insert into users
        (userid, first_name, last_name, gender, email, password, url_address)
        values
        ('$userid', '$firstname', '$lastname', '$gender', '$email', '$password', '$url_address')";

        $DB = new Database();
        $DB->save($query);
    }

    private function create_user_id()
    {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {

            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}
