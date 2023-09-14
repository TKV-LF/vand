<?php

use MVC\Model;

class ModelsProduct extends Model
{

    public function getAllUser()
    {

        // $this->db->query( write your sql syntax: "SELECT * FROM " . DB_PREFIX . "user");

        return [
            'name' => 'Thuy',
            'email' => 'tkv@gmail.com',
        ];
    }
}