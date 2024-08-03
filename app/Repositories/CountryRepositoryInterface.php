<?php

namespace App\Repositories;

interface CountryRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
