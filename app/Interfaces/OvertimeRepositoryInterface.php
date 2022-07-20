<?php 

namespace App\Interfaces;

interface OvertimeRepositoryInterface
{
    public function getOvertime();
    public function storeOvertime($data);
    public function getOvertimePay($data);
}