<?php

use MVC\Model;

class ModelsAuth extends Model
{

    public function login($data)
    {
        $email = isset($data['email']) ? $data['email'] : '';
        $user = $this->db->findOne("users", ['email' => $email]);
        $response = [];

        if (!$user) {
            $response['error'] = 'User does not exist with this email';
            return $response;
        }


        if (!isset($data['password']) || $data['password'] != $user->password) {
            $response['error'] = 'Password is incorrect';
            return $response;
        }

        $response['user'] = $user;

        return $response;
    }


}