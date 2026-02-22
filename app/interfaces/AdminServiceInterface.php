<?php
namespace App\interfaces;

interface AdminServiceInterface
{
    public function index();
    public function createClient();
    public function mange();
    public function storeClient(array $data);
    public function getAllClients();
    public function deleteClient($id);
}
