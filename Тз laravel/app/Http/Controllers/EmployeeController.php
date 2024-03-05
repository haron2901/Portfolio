<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    #Принимаемые данные: только name(имя пусть будет уникальным)
    public function create
    (
        Request $request
    )
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:employees'
        ]);

        $employee = Employee::firstOrNew(['name' => $validatedData['name']]);

        if (!$employee->exists) {
            $employee->save();
            return response()->json([], 200);
        } else {
            return response()->json([
                'error' => 'Employee with the same name already exists'
            ], 409);
        }
    }

    #Принимает Только ID
    public function delete
    (
        Request $request
    )
    {
        $data = $request->toArray();

        $employee = Employee::find($data['id']);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
    public function putRevenue(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'revenue' => 'required|numeric'
        ]);

        $employee = Employee::where('name', $validatedData['name'])->first();

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $previousRevenue = $employee->revenue;
        $newRevenue = $previousRevenue + $validatedData['revenue'];

        $employee->revenue = $newRevenue;
        $employee->save();

        return response()->json(['message' => 'Revenue updated successfully'], 200);
    }
    public function searchByName
    (
        Request $request
    )
    {
        $searchTerm = $request->input('name');

        $employees = Employee::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        return view('employee', ['employees' => $employees]);
    }
}
