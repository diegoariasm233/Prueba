<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Gate;
use App\Employee;
use Illuminate\Support\Facades\Validator;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (! Gate::allows('company_view')) {
            return abort(401);
        }
           $company=Company::orderBy('id','DESC')->paginate(10);
        return view('Companies.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }
        return view('Companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('company_create')) {
            return abort(401);
        }

    $validator = Validator::make($request->all(), [
           'name'=>'required', 'email'=>'required', 'website'=>'required', 'thumbnail'=>'required',
        ]);
                       if ($validator->fails()) {
            return redirect('/home/create/company')
                        ->withErrors($validator)
                        ->withInput();
        }
           $e =    Company::wherewebsite($request->website)->get();
            if($e->count() > 0){
                         return redirect("/home/create/company")->withErrors('Ya existe una empresa con esta pagina web');
            }
             $w =    Company::whereemail($request->email)->get();
            if($w->count() > 0){
                         return redirect("/home/create/company")
                        ->withErrors('Ya existe una empresa con este correo');
            }
    if($request->hasFile('thumbnail')){
    $file = $request->file('thumbnail');
    $name = time().$file->getClientOriginalname();
  $ruta =  $file->move(storage_path().'/app/public/',$name);

          Company::create(['name' => $request->name , 'email' => $request->email,'thumbnail' => $name,'website' => $request->website]);
         return redirect()->route('home')->with('success','Registro creado satisfactoriamente');


    }else{
          return redirect("/home/create/company")
                        ->withErrors('Por favor subir un logo');
    }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
        $company = Company::find($id);
         return view('Companies.create',['id' => $company->id, 'name' => $company->name,'email' => $company->email,'thumbnail' => $company->thumbnail,'website'=>$company->website]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('company_edit')) {
            return abort(401);
        }
    $validator = Validator::make($request->all(), [
           'name'=>'required', 'email'=>'required', 'website'=>'required', 'thumbnail'=>'required',
        ]);
                       if ($validator->fails()) {
                         return view('Companies.create',['id' => $request->id, 'name' => $request->name,'email' => $request->email,'thumbnail' => $request->thumbnail,'website'=>$request->website])->withErrors($validator);

        }
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');

            $name = time().$file->getClientOriginalname();
          $ruta =  $file->move(storage_path().'/app/public/',$name);

                  Company::find($id)->update(['name' => $request->name , 'email' => $request->email,'thumbnail' => $name,'website' => $request->website]);
                 return redirect()->route('home')->with('success','Registro actualizado satisfactoriamente');


            }else{
                  return redirect("/home/create/company")
                                ->withErrors('Por favor subir un logo');
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('company_delete')) {
            return abort(401);
        }
          $compalia =   Company::find($id);
        $employe = $compalia->employees;
        foreach ($employe as $key ) {
            $key->delete();
        }
        $compalia->delete();
     return redirect()->route('home')->with('success','Registro eliminado satisfactoriamente');

    }
}
