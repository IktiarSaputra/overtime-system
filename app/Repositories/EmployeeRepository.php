<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getEmployee()
    {
        return Employee::all();
    }
    
    public function storeEmployee($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:2|max:255|unique:employees',
            'salary' => 'required|integer|min:2000000|max:10000000',
        ]);
        
        if ($validator->fails()) {
           return ['success' => false, 'message' => $validator->errors()];
        }
        
        $employee = new Employee();
        $employee->name = $data['name'];
        $employee->salary = $data['salary'];
        $employee->save();
        
        return ['success' => true, 'message' => 'Employee created successfully', 'data' => $employee];
    }
}