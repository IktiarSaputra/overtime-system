<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getEmployee();
    public function storeEmployee($data);
}