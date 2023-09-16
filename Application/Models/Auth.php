<?php
use MVC\Model;

class ModelsAuth extends Model
{
    public function login($requestBody)
    {
        $email = $requestBody['email'] ?? null;
        $password = $requestBody['password'] ?? null;

        $validateEmail = $this->validate('email', $email);
        if ($validateEmail !== true) {
            return $validateEmail;
        }

        $validatePassword = $this->validate('password', $password);
        if ($validatePassword !== true) {
            return $validatePassword;
        }

        $user = $this->db->findOne('users', ['email' => $email]);
        if (!$user) {
            return 'Email is not exist';
        }

        if (!password_verify($password, $user->password)) {
            return 'Password is incorrect';
        }

        $accessToken = $this->generateToken();
        $access = (object) [
            'userId' => $user->id,
            'tokenType' => 'access',
            'tokenValue' => $accessToken,
            'expiryDate' => date('Y-m-d H:i:s', strtotime('+1 day')),
        ];

        $this->db->beginTransaction();
        if (!$this->db->insert($access, 'tokens', ['userId', 'tokenType', 'tokenValue', 'expiryDate'])) {
            $this->db->rollback();
            return 'Something went wrong';
        }
        $result = $this->db->findOne('tokens', ['userId' => $user->id, 'tokenType' => 'refresh']);
        if ($result) {
            $refreshToken = $result->tokenValue;
        } else {
            $refreshToken = $this->generateToken();
            $refresh = (object) [
                'userId' => $user->id,
                'tokenType' => 'refresh',
                'tokenValue' => $refreshToken,
                'expiryDate' => '9999-12-31 23:59:59',
            ];

            if (!$this->db->insert($refresh, 'tokens', ['userId', 'tokenType', 'tokenValue', 'expiryDate'])) {
                $this->db->rollback();
                return 'Something went wrong';
            }
        }

        $this->db->commit();

        return [
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'expiryDate' => $access->expiryDate,
        ];
    }

    public function refresh($token)
    {
        $refresh = $this->db->findOne('tokens', ['tokenValue' => $token, 'tokenType' => 'refresh'], 'userId, tokenValue');
        if (!$refresh) {
            return 'Refresh token is invalid';
        }

        $accessToken = $this->generateToken();
        $access = (object) [
            'userId' => $refresh->userId,
            'tokenType' => 'access',
            'tokenValue' => $accessToken,
            'expiryDate' => date('Y-m-d H:i:s', strtotime('+1 day')),
        ];

        $this->db->beginTransaction();
        if (!$this->db->insert($access, 'tokens', ['userId', 'tokenType', 'tokenValue', 'expiryDate'])) {
            $this->db->rollback();
            return 'Something went wrong';
        }

        $this->db->commit();

        return [
            'accessToken' => $accessToken,
            'refreshToken' => $token,
            'expiryDate' => $access->expiryDate,
        ];
    }

    public function getUserByToken($token)
    {
        $access = $this->db->findOne('tokens', ['tokenValue' => $token, 'tokenType' => 'access'], 'userId, expiryDate');
        if (!$access) {
            return 'Access token is invalid';
        }

        if (strtotime($access->expiryDate) < strtotime(date('Y-m-d H:i:s'))) {
            return 'Access token is expired';
        }

        $user = $this->db->findOne('users', ['id' => $access->userId], 'id, email, firstName, lastName, since, lastUpdate');
        if (!$user) {
            return 'User is not exist';
        }

        return (object) [
            'user' => $user,
            'expiryDate' => $access->expiryDate,
        ];
    }

    private function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    private function validate($attr, $value)
    {

        switch ($attr) {
            case 'email':
                if (empty($value)) {
                    return 'Email is required';
                }

                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'Email is invalid';
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

            default:
                # code...
                break;
        }
        return true;
    }


}