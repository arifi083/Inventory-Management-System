<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SaleryController extends Controller
{
    public function saleryInsert(Request $request,$id){
        $validated = $request->validate([
            'salary_month' => 'required', 
        ]);

        $month = $request->salary_month;
        $check = DB::table('saleries')->where('employee_id',$id)->where('salary_month',$month)->first();
        if($check){
            return response()->json('Salary Alrady Paid');
        }
        else{
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->sallery;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');
            DB::table('saleries')->insert($data);

        }

    }//end method

    public function allSalery(){
        $salary = DB::table('saleries')->select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    public function ViewSalary($id){
        $month = $id;
        $viewSalary = DB::table('saleries')
                     ->join('employees','saleries.employee_id','employees.id')
                     ->where('saleries.salary_month',$month)
                     ->select('employees.name','saleries.*')
                     ->get();
        return response()->json($viewSalary);
    }

    public function EditSalary($id){
        
        $viewSalary = DB::table('saleries')
        ->join('employees','saleries.employee_id','employees.id')
        ->where('saleries.id',$id)
        ->select('employees.name','employees.email','saleries.*')
        ->first();
         return response()->json($viewSalary);
    }

    public function SalaryUpdate(Request $request,$id){
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;
        DB::table('saleries')->where('id',$id)->update($data);

    }
}
