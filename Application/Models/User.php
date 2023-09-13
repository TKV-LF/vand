<?php

use MVC\Model;

class ModelsUser extends Model
{

    public function getAllUser()
    {

        $data = $this->db->query("SELECT * FROM " . DB_PREFIX . "users");


        return $data->rows;
    }

    public function createUser($data)
    {

        if (!isset($data['email'])) {
            return 'Email is required';
        }
        return [
            'name' => 'Thuy',
            'email' => 'Thuy@mail.com',
        ];
    }
}