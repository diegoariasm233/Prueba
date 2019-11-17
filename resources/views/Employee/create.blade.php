

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Empleado</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
 <form <?PHP if(isset($id)){echo "action=' /home/update/employ/".$id."/".$idcomp." '";}else{ echo "action=' /home/store/employe '";} ?> method="POST">
  {{ csrf_field() }}
 <div class="form-row">
  <div class="form-group col-md-6">
      <label for="Firstname">Nombre</label>
      <input type="text" <?php if(isset($firstname)){ echo "value='".$firstname."'";} ?> class="form-control" id="firstname" name="firstname" placeholder="Nombre">
    </div>
       <input  type="hidden" value="<?php echo ''.$idcomp; ?>" class="form-control" id="company_id" name="company_id" placeholder="Nombre">
   
   
  <div class="form-group col-md-6">
    <label for="lastname">Apellidos</label>
    <input type="text" class="form-control" <?php if(isset($lastname)){ echo "value='".$lastname."'";} ?> id="lastname" name="lastname" placeholder="...">
  </div>
  </div>
  <div class="form-group ">
      <label for="email">Email</label>
      <input type="email" class="form-control" <?php if(isset($email)){ echo "value='".$email."'";} ?> id="email" name="email" placeholder="Email">
    </div>
  <div class="form-group">
    <label for="number">Telefono</label>
    <input type="number" class="form-control" <?php if(isset($number)){ echo "value='".$number."'";} ?> id="number" name="number" placeholder="555555555">
  </div>
  <button type="submit" class="btn btn-primary"><?php if(isset($id)){echo 'Actualizar Empleado';}else{ echo 'Crear Empleado';} ?></button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
