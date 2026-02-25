<?php
namespace App\interfaces;

use Symfony\Component\HttpFoundation\Request;

interface AdminServiceInterface
{
    public function index();
    public function createClient();
    public function mange();
    public function storeClient(array $data);
    public function getAllClients();
    public function editClient($id);

    public function updateClient($id,array $data);

    public function deleteClient($id);
}
