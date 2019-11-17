<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (! Gate::allows('employee_access')) {
            return abort(401);
        }
         $employe=Employee::wherecompany_id($id)->orderBy('id','DESC')->paginate(10);
        return view('Employee.index',compact('employe','id')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        return view('Employee.create',['idcomp'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
              $validator = Validator::make($request->all(), [
           'firstname'=>'required', 'email'=>'required', 'lastname'=>'required', 'company_id'=>'required', 'number'=>'required',
        ]);
                       if ($validator->fails()) {
            return redirect("/home/create/employe/".$request->company_id."")
                        ->withErrors($validator)
                        ->withInput();
        }
           $e =    Employee::wherenumber($request->number)->get();
            if($e->count() > 0){
                         return redirect("/home/create/employe/".$request->company_id."")
                        ->withErrors('Ya existe un empleado con este numero');
            }
             $w =    Employee::whereemail($request->email)->get();
            if($w->count() > 0){
                         return redirect("/home/create/employe/".$request->company_id."")
                        ->withErrors('Ya existe un empleado con este correo');
            } 

              Employee::create($request->all());
            
         return redirect()->route('verempleados',['id' => $request->company_id])->with('success','Registro creado satisfactoriamente');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$es)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
             $employe = Employee::find($id);
         return view('Employee.create',['id' => $id,'idcomp' => $es, 'firstname' => $employe->firstname,'email' => $employe->email,'number' => $employe->number,'lastname'=>$employe->lastname]); 
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$idcomp)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
       $validator = Validator::make($request->all(), [
           'firstname'=>'required', 'email'=>'required', 'lastname'=>'required', 'company_id'=>'required', 'number'=>'required',
        ]);
                       if ($validator->fails()) {
                        return redirect("/home/edit/employe/".$id."/".$idcomp."")
                        ->withErrors($validator)
                        ->withInput(); 
 
        }  
          Employee::find($id)->update($request->all());
        return redirect()->route('verempleados', $idcomp)->with('success','Registro actualizado satisfactoriamente');
 
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$idcomp)
    {

        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
             $compalia =   Employee::find($id);
             $compalia->delete();
     return redirect()->route('verempleados',$idcomp)->with('success','Registro eliminado satisfactoriamente');
  
    }
}
