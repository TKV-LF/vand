<?php

use MVC\Model;

class ModelsStore extends Model
{

    public function getAllStore()
    {
        $stores = $this->db->find('stores');
        return $stores;
    }

    public function getPaginateStore($limit, $page)
    {
        $limit = $limit ?? 10;
        $page = $page ?? 1;
        $stores = $this->db->paginate('stores', $limit, $page);

        return $stores ? $stores : [];
    }

    public function getStore($id)
    {
        $store = $this->db->findOne('stores', ['id' => $id]);
        if (!$store) {
            return 'Store is not exist';
        }
        return $store;
    }

    public function searchStore($requestBody, $limit, $page)
    {
        $name = $requestBody['name'] ?? '';

        $limit = $limit ?? 10;
        $page = $page ?? 1;
        $stores = $this->db->paginateSearch('stores', [
            'name' => $name
        ], $limit, $page);

        return $stores ? $stores : [];
    }

    public function createStore($requestBody, $user)
    {
        $name = $requestBody['name'] ?? null;
        $description = $requestBody['description'] ?? '';

        $validateName = $this->validate('name', $name);
        if ($validateName !== true) {
            return $validateName;
        }

        $store = $this->db->findOne('stores', ['name' => $name]);
        if ($store) {
            return 'Store is exist';
        }
        $data = (object) [
            "userId" => $user->id,
            "name" => $name,
            "description" => $description,
            "since" => date('Y-m-d H:i:s'),
            "lastUpdate" => date('Y-m-d H:i:s'),
        ];
        $this->db->beginTransaction();
        if (!$this->db->insert($data, 'stores', $this->attributes())) {
            $this->db->rollback();
            return 'Something went wrong';
        }

        $storeId = $this->db->getLastId();
        $this->db->commit();

        return $this->getStore($storeId);
    }

    public function updateStore($requestBody, $storeId)
    {
        $name = $requestBody['name'] ?? null;
        $description = $requestBody['description'] ?? '';

        $validateName = $this->validate('name', $name);
        if ($validateName !== true) {
            return $validateName;
        }

        $store = $this->db->findOne('stores', ['id' => $storeId]);
        if (!$store) {
            return 'Store is not exist';
        }

        $data = (object) [
            "name" => $name,
            "description" => $description,
            "lastUpdate" => date('Y-m-d H:i:s'),
        ];
        $this->db->beginTransaction();
        if (!$this->db->update($data, 'stores', $this->updateAttributes(), "id = {$storeId}")) {
            $this->db->rollback();
            return 'Something went wrong';
        }
        $this->db->commit();

        return $this->getStore($storeId);
    }

    public function deleteStore($storeId)
    {
        $store = $this->db->findOne('stores', ['id' => $storeId]);
        if (!$store) {
            return 'Store is not exist';
        }
        $data = (object) [
            'id' => $storeId
        ];
        $this->db->beginTransaction();
        if (!$this->db->delete($data, 'stores', ["id"])) {
            $this->db->rollback();
            return 'Something went wrong';
        }
        $this->db->commit();

        return [
            'message' => 'Store {$storeId} is deleted'
        ];
    }

    private function attributes()
    {
        return [
            'userId',
            'name',
            'description',
            'since',
            'lastUpdate'
        ];
    }

    private function updateAttributes()
    {
        return [
            'name',
            'description',
            'lastUpdate'
        ];
    }

    private function validate($attr, $value)
    {
        switch ($attr) {
            case 'name':
                if (empty($value)) {
                    return 'Name is required';
                }
                if (strlen($value) < 3) {
                    return 'Name must be at least 3 characters';
                }
                if (strlen($value) > 255) {
                    return 'Name must be less than 255 characters';
                }
            default:
        }
        return true;

    }
}