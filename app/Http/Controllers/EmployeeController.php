<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getAllEmployee = Employee::all();
        return view('employees.index',compact('getAllEmployee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = $request->all();
        Employee::updateOrCreate(['id'=>$request->id],['email'=>$request->email, 'name' => $request->name, 'password' => $request->password]);
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::destroy($id);
    }

    public function checkUserAuth(Request $request){
        if($request->method() == 'POST'){
            if($request->count < 3){
                $emp = Employee::where(['email' => $request->email, 'password' => $request->password])->exists();
                if ($emp) {
                    return response()->json(['message' => 'Employee Signed In', 'status' => '1','count'=>1]);
                } else {
                    return response()->json(['message' => 'Invalid', 'status' => '0', 'count' => $request->count+1]);
                }
            }else{
                return response()->json(['message' => '3 times wrong credentials', 'status' => '0', 'count' => 3]); 
            }
        }else{
            return view('auth/signin');
        }
    }

    public function paymentAction(){
        return view('payment/ccavenue');
    }
}
