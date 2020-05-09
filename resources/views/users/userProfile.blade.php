@extends("layouts.app")

@section("content")

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Perfil do Utilizador
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.view.change.profile') }}"
                              enctype="multipart/form-data">
                              {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-group col-md-6">
                                <label for="name">Name:</label>
                                <input type="text" style="width:450px;" name="name"
                                       class="form-control" id="name" value="{{ Auth::user()->name }}">
                            </div>

                            <!-- EMAIL -->
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input type="text" style="width:450px;" class="form-control" id="email" name="email"
                                       value="{{Auth::user()->email}}">
                            </div>

                            <!-- TELEFONE -->

                            <div class="form-group col-md-6">
                                <label for="telefone">Numero de Telefone:</label>
                                <input type="text" style="width:450px;" class="form-control" id="telefone" name="telefone"
                                       value="{{Auth::user()->telefone}}">
                            </div>

                            <!-- foto -->


                            <div class="form-group col-md-6">
                                <label for="usr">Profile Photo:</label>
                                <br>
                                <img src="{{ Storage::url('public/fotos/' . Auth::user()->foto)}}"
                                     style="width:150px; height: 150px;" class="img-thumbnail">
                            </div>

                              <div class="form-group col-md-6">
                                <input
                                type="file" style="width:450px;" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" enctype="multipart/form-data" accept=".jpeg, .jpg, .png, .gif"
                                name="foto" id="inputPhoto"
                                class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" value="{{ old('profile_photo') }}"/>
                               <label for="inputPhoto" </label>
                                @if ($errors->has('foto'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                                @endif
                              </div>

                            <br>
                            <div class="form-group col-md-12">

                                <button type="submit" class="btn btn-dark" href="{{route('user.view.change.profile', Auth::user()->id)}}">
                                    Editar Perfil
                                </button>
                                <a class="btn btn-dark" href="{{route('user.view.change.password')}}">Mudar Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
