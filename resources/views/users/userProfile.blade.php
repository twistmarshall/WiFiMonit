@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Perfil de Utilizador
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.view.change.profile') }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="usr">Name:</label>
                                <input type="text" style="width:450px;" name="name"
                                       class="form-control" id="usr" value="{{ Auth::user()->name }}">
                            </div>

                            <!-- EMAIL -->
                            <div class="form-group col-md-6">
                                <label for="usr">Email:</label>
                                <input type="text" style="width:450px;" class="form-control" id="usr"
                                       value="{{Auth::user()->email}}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="usr">Phone Number:</label>
                                <input type="text" style="width:450px;" class="form-control" id="usr"
                                       value="{{Auth::user()->phone}}">
                            </div>


                            <br>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-dark" href="{{route('user.view.change.profile')}}">
                                    Edit
                                    Profile
                                </button>
                                <button class="btn btn-dark" href="{{route('user.view.change.password')}}">Change
                                    Password
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
