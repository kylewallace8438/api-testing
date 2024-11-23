<?php
namespace App\Repository;

interface UserInterfaceRepository
{
    public function all($fields);
    public function detail($id, $fields);
    public function list($fields, $options);
    public function update($id, $data);
    public function delete($id);
    public function create($data);
    public function findByEmail($email, $fields);
}
