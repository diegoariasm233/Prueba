
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear compañia</div>

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
 <form <?PHP if(isset($id)){echo "action=' /home/update/com/".$id." '";}else{ echo "action=' /home/create/com '";} ?> method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
 <div class="form-row">
  <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" <?php if(isset($name)){ echo "value='".$name."'";} ?> class="form-control" id="name" name="name" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" <?php if(isset($email)){ echo "value='".$email."'";} ?> id="email" name="email" placeholder="Email">
    </div>

  </div>
  <?php//  ?>
  <div class="form-group">
    <label for="thumbnail">Miniatura </label>
    <input type="file" id="thumbnail"  name="thumbnail"  accept="image/*" onchange="loadFile(event)">
    <img width="100" height="100" src="<?php if(isset($thumbnail)) {echo asset('storage/'.$thumbnail.'');} ?>"  id="output"/>
</div>
<script type="text/javascript">
 var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
 /*  $("#thumbnail").fileinput({


  }); */

  </script>

  <div class="form-group">
    <label for="website">Pagina web</label>
    <input type="text" class="form-control" <?php if(isset($website)){ echo "value='".$website."'";} ?> id="website" name="website" placeholder="www.example.com">
  </div>
  <button type="submit" class="btn btn-primary"><?php if(isset($id)){echo 'Actualizar compañia';}else{ echo 'Crear Compañia';} ?></button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
