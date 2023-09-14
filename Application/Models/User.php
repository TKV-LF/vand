<?php

use MVC\Model;

class ModelsUser extends Model
{

    public function getAllUser()
    {

        $data = $this->db->query("SELECT * FROM " . DB_PREFIX . "users");


        return $data->rows;
    }

    public function createUser($requestBody)
    {

        $email = $requestBody['email'] ?? null;
        $password = $requestBody['password'] ?? null;
        $firstName = $requestBody['firstName'] ?? null;
        $lastName = $requestBody['lastName'] ?? null;

        $validateEmail = $this->validate('email', $email);
        if ($validateEmail !== true) {
            return $validateEmail;
        }

        $validatePassword = $this->validate('password', $password);
        if ($validatePassword !== true) {
            return $validatePassword;
        }

        $validateFirstName = $this->validate('firstName', $firstName);
        if ($validateFirstName !== true) {
            return $validateFirstName;
        }

        $validateLastName = $this->validate('lastName', $lastName);
        if ($validateLastName !== true) {
            return $validateLastName;
        }

        $data = (object) [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'firstName' => $firstName,
            'lastName' => $lastName,
            'since' => date('Y-m-d H:i:s'),
            'lastUpdate' => date('Y-m-d H:i:s'),
        ];
        if ($this->db->insert($data, 'users', self::attributes())) {
            return $data;
        }

        return "Something went wrong";

    }

    public function attributes()
    {
        return ['email', 'password', 'firstName', 'lastName', 'since', 'lastUpdate'];
    }

    private function validate($attr, $value)
    {
        switch ($attr):
            case 'email':
                if (empty($value)) {
                    return 'Email is required';
                }

                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'Email is invalid';
                }

                $findEmail = $this->db->findOne('users', ['email' => $value]);
                if ($findEmail) {
                    return 'Email is already taken';
                }
                break;
            case 'password':
                if (empty($value)) {
                    return 'Password is required';
                }

                if (strlen($value) < 6) {
                    return 'Password is too short';
                }

                if (strlen($value) > 16) {
                    return 'Password is too long';
                }
                break;
            case 'firstName':
                if (empty($value)) {
                    return 'First name is required';
                }

                if (strlen($value) < 2) {
                    return 'First name is too short';
                }
                break;
            case 'lastName':
                if (empty($value)) {
                    return 'Last name is required';
                }

                if (strlen($value) < 2) {
                    return 'Last name is too short';
                }
                break;

            default:
                return 'Invalid attribute';
        endswitch;

        return true;
    }


}