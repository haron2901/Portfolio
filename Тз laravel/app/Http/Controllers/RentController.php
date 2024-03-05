<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * @throws \Exception
     */
    public function create
    (
        Request $request
    )
    {
        $rent = new Rent();
        $now = new \DateTimeImmutable();


        if(Client::find($request->client_id)){
        $rent->client = $request->client_id;
        }else return response()->json(['message'=>'Client not found'], 404);


        if (Inventory::find($request->inventory_id)) {
            $inventory = Inventory::find($request->inventory_id);
            if ($now > new \DateTimeImmutable($inventory->busy_until) || $inventory->busy_until === null){
                $rent->inventory = $request->inventory_id;
            } else {
                return response()->json(['message' => "This Inventory is busy"], 400);
            }
        } else {
            return response()->json(['message' => 'Inventory not found']);
        }

        if(Employee::find($request->employee_id)){
            $employee = Employee::find($request->employee_id);
            $rent->employee = $request->employee_id;
        }else return response()->json(['message' => 'employee not found'], 404);

        $inventory->busy_until = $request->active_to;
        $changedActive = new \DateTimeImmutable($request->active_to);
        $interval = ($changedActive)->diff($now)->days;

        if($interval  % 7 == 0){
            $employee->revenue = $employee->revenue + $inventory->price_for_week * $interval / 7;
        }else $employee->revenue = $employee->revenue + $inventory->price_for_day * $interval;

        $rent->active_to = $request->active_to;
        $inventory->status = "Занят";
        $employee->save();
        $inventory->save();
        $rent->save();

        return response()->json(['message' => 'Rent created successfully'], 201);
    }

}
