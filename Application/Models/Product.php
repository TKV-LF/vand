<?php

use MVC\Model;

class ModelsProduct extends Model
{

    public function getAllProduct()
    {
        $products = $this->db->find('products');
        return $products;
    }

    public function getPaginateProduct($limit, $page)
    {
        $limit = $limit ?? 10;
        $page = $page ?? 1;
        $products = $this->db->paginate('products', $limit, $page);

        return $products ? $products : [];
    }

    public function getProduct($id)
    {
        $product = $this->db->findOne('products', ['id' => $id]);
        if (!$product) {
            return 'Product is not exist';
        }
        return $product;
    }

    public function createProduct($requestBody, $user)
    {
        $name = $requestBody['name'] ?? null;
        $description = $requestBody['description'] ?? '';
        $price = $requestBody['price'] ?? null;
        $quantity = $requestBody['quantity'] ?? null;
        $storeId = $requestBody['storeId'] ?? null;

        $validateName = $this->validate('name', $name);
        if ($validateName !== true) {
            return $validateName;
        }

        $validPrice = $this->validate('price', $price);
        if ($validPrice !== true) {
            return $validPrice;
        }

        $validQuantity = $this->validate('quantity', $quantity);
        if ($validQuantity !== true) {
            return $validQuantity;
        }

        $validStore = $this->validate('storeId', $storeId);
        if ($validStore !== true) {
            return $validStore;
        }

        $product = $this->db->findOne('products', ['name' => $name]);
        if ($product) {
            return 'Product is exist';
        }
        $data = (object) [
            "userId" => $user->id,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "quantity" => $quantity,
            "storeId" => $storeId,
            "since" => date('Y-m-d H:i:s'),
            "lastUpdate" => date('Y-m-d H:i:s'),
        ];
        $this->db->beginTransaction();
        if (!$this->db->insert($data, 'products', $this->attributes())) {
            $this->db->rollback();
            return 'Something went wrong';
        }

        $productId = $this->db->getLastId();
        $this->db->commit();

        return $this->getProduct($productId);
    }

    public function updateProduct($requestBody, $productId)
    {
        $name = $requestBody['name'] ?? null;
        $description = $requestBody['description'] ?? '';
        $price = $requestBody['price'] ?? null;
        $quantity = $requestBody['quantity'] ?? null;
        $storeId = $requestBody['storeId'] ?? null;

        $validateName = $this->validate('name', $name);
        if ($validateName !== true) {
            return $validateName;
        }

        $validPrice = $this->validate('price', $price);
        if ($validPrice !== true) {
            return $validPrice;
        }

        $validQuantity = $this->validate('quantity', $quantity);
        if ($validQuantity !== true) {
            return $validQuantity;
        }

        $validStore = $this->validate('storeId', $storeId);
        if ($validStore !== true) {
            return $validStore;
        }

        $product = $this->db->findOne('products', ['id' => $productId]);
        if (!$product) {
            return 'Product is not exist';
        }
        $data = (object) [
            "storeId" => $storeId,
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "quantity" => $quantity,
            "lastUpdate" => date('Y-m-d H:i:s'),
        ];
        $this->db->beginTransaction();
        if (!$this->db->update($data, 'products', $this->updateAttributes(), "id = {$productId}")) {
            $this->db->rollback();
            return 'Something went wrong';
        }

        $this->db->commit();

        return $this->getProduct($productId);
    }

    public function deleteProduct($productId)
    {
        $product = $this->db->findOne('products', ['id' => $productId]);
        if (!$product) {
            return 'Product is not exist';
        }
        $this->db->beginTransaction();

        $data = (object) [
            'id' => $productId
        ];
        if (!$this->db->delete($data, 'products', ['id'])) {
            $this->db->rollback();
            return 'Something went wrong';
        }
        $this->db->commit();

        return [
            'message' => "Product {$productId} is deleted"
        ];
    }

    public function attributes()
    {
        return [
            'storeId',
            'name',
            'description',
            'price',
            'quantity',
            'userId',
            'since',
            'lastUpdate'
        ];
    }

    public function updateAttributes()
    {
        return [
            'storeId',
            'name',
            'description',
            'price',
            'quantity',
            'lastUpdate'
        ];
    }

    public function validate($field, $value)
    {
        switch ($field) {
            case 'name':
                if (!$value || empty($value)) {
                    return 'Name is required';
                }
                if (strlen($value) < 3) {
                    return 'Name must be at least 3 characters';
                }
                if (strlen($value) > 50) {
                    return 'Name must be less than 50 characters';
                }
                break;
            case 'quantity':
                if (!$value || empty($value)) {
                    return 'Quantity is required';
                }
                if (!is_numeric($value)) {
                    return 'Quantity must be a number';
                }
                if ($value < 0) {
                    return 'Quantity must be greater than 0';
                }
                break;

            case 'price':
                if (!$value || empty($value)) {
                    return 'Price is required';
                }
                if (!is_numeric($value)) {
                    return 'Price must be a number';
                }
                if ($value < 0) {
                    return 'Price must be greater than 0';
                }
                break;
            case 'storeId':
                if (!$value || empty($value)) {
                    return 'Store Id is required';
                }

                if (!is_numeric($value)) {
                    return 'Store Id must be a number';
                }

                break;

            default:
                return true;
        }
        return true;
    }

}