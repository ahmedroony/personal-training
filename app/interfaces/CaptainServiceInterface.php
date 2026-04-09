<?php

namespace App\interfaces;

interface CaptainServiceInterface
{
    public function getAllCaptains();
    public function storeCaptain(array $data);
    public function getCaptainById($id);
    public function updateCaptain($id, array $data);
    public function deleteCaptain($id);
}
