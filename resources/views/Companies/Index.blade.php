
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Panel de control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('createcompany') }}" class="btn btn-info" >Añadir Compañia </a>
            </div>
          </div>
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Nombre</th>
               <th>email</th>
               <th>Miniatura</th>
               <th>Pagina web</th>
               <th>Editar</th>
               <th>Eliminar</th>
               <th>Empleados</th>
             </thead>
             <tbody>
              @if($company->count())
              @foreach($company as $compan)
              <tr>
                <td>{{$compan->name}}</td>
                <td>{{$compan->email}}</td>
                <td><img width="100" height="100" src=" <?php echo asset('storage/'.$compan->thumbnail.'') ;?>" ></img></td>
                <td>{{$compan->website}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{action('CompanyController@edit', $compan->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{action('CompanyController@destroy', $compan->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button></form>
                 </td>
                <td><a class="btn btn-warning btn-xs" href="{{route('verempleados', $compan->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
               </tr>
               @endforeach

{{ $company->links() }}
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
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
