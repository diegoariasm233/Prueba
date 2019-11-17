
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Panel de control</div>

                <div class="card-body">
                    @if (session('status.'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('crearempleado',$id) }}" class="btn btn-info" >Añadir Empleado </a>
                
            </div>
            <div class="btn-group">
               <a href="{{ route('home') }}" class="btn btn-info" >Volver </a>
           
            </div>
          </div>
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Nombre</th>
               <th>Apellidos</th>
               <th>Email</th>
               <th>Numero</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($employe->count())  
              @foreach($employe as $employ)  
              <tr>
                <td>{{$employ->firstname}}</td>
                <td>{{$employ->lastname}}</td>
                <td>{{$employ->email}}</td>
                <td>{{$employ->number}}</td>
  <td><a class="btn btn-primary btn-xs" href="{{route('editemplo', array($employ->id,$id) )}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{route('del', array($employ->id,$id) ) }}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
 
                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button></form>
                 </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro de empleados en la empresa !!</td>
              </tr>
              @endif
            </tbody>
 
          </table>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
