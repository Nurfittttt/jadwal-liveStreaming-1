@extends('layouts.app-master')


@section('content')

    @if ($message = Session::get('masuk'))
      <div class="alert alert-success">
          <a class="close" data-dismiss="alert">×</a>
          <p>{{ $message }}</p>
          <img src="close.soon" style="display:none;" onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },2000 ); })(this);" />
      </div>
    @endif

      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        <p>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </p>
      </div>
      @endif

      <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Users Management</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>
                                @can('pemakaian-create')
                                <a class="btn btn-success" data-toggle="modal" data-target="#create"> Create New User</a>
                                @endcan
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                  <table id="datablepemakaian" class="table table-bordered text-center">
                    <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px"></th>
                          </tr>
                    </thead>
                    <tbody>
                          @foreach ($data as $key => $user)
                            <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @if(!empty($user->getRoleNames()))
                                  @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                  @endforeach
                                @endif
                              </td>
                              <td>
                                @can('pemakaian-list')
                                  <a class="btn btn-info"  data-toggle="modal" data-target="#details{{$user->id}}">Show</a>
                                @endcan
                                @can('pemakaian-list')
                                  <a class="btn btn-primary" data-toggle="modal" data-target="#update{{$user->id}}">Edit</a>
                                @endcan
                                @can('pemakaian-list')
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#Delete{{$user->id}}">Delete</button>
                                @endcan
                              </td>
                            </tr>
                            {{-- Modal delete --}}
                            <div id="Delete{{$user->id}}" class="modal fade primary" role="dialog">
                              <div class="modal-dialog modal-xl">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                      <div class="modal-header bg-danger">
                                          <h4 class="modal-title">Delete Data Akun User</h4>    
                                      </div>
                                      <div class="modal-body">
                                          <p class="text-center">apakah ada yakin untuk menghapus Data Akun User ini?</p>
                                          <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                              <div class="modal-footer center">
                                                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      @csrf
                                                      @method('DELETE')
                                                      {{-- @can('dtks-delete') --}}
                                                          <button type="submit" class="btn btn-danger">Delete</button>
                                                      {{-- @endcan --}}
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          {{-- Modal delete --}}
                            {{-- Modal create --}}
                            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Membuat Akun User</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form id="quickForm" action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                          <div class="row">
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <strong>Name:</strong>
                                                      <input class="form-control" name="name" placeholder="Masukan Nama">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">Email address</label>
                                                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                      <small id="emailHelp" class="form-text text-muted">email hanya di gunakan satu kali pendaftaran</small>
                                                  </div>
                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <strong>Password:</strong>
                                                      <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <strong>Confirm Password:</strong>
                                                      <input type="password" class="form-control" name="confirm-password" id="inputPassword4" placeholder="Password">
                                                  </div>
                                              </div>
                                              <div class="col-xs-12 col-sm-12 col-md-12">
                                                  <div class="form-group">
                                                      <strong>Role:</strong>
                                                      <select class="form-control" name="roles" id="exampleFormControlSelect1">
                                                        <option selected>
                                                          {{-- @if(!empty($user->getRoleNames()))
                                                            @foreach($user->getRoleNames() as $v)
                                                                <label class="badge badge-success">{{ $v }}</label>
                                                            @endforeach
                                                          @endif --}}
                                                        </option>
                                                        @foreach ($roles as $role )
                                                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select> 
                                                      
                                                      {{-- {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','option')) !!} --}}
                                                  </div>
                                              </div>
                                          </div>
                                
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            {{-- Modal create --}}
                            {{-- Modal detail --}}
                            <div id="details{{$user->id}}" class="modal fade primary" role="dialog">
                              <div class="modal-dialog modal-xl">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                      <div class="modal-header bg-primary">
                                          <h4 class="modal-title">Detail User</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="card card-primary card-outline">
                                          <div class="card-body box-profile">
                                            <div class="text-center">
                                              <img class="profile-user-img img-fluid img-circle"
                                                  src="{{asset('images/pp.png')}}"
                                                  alt="User profile picture">
                                            </div>
                                      
                                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                      
                                            <ul class="list-group list-group-unbordered mb-3">
                                              <li class="list-group-item">
                                                <b>nama</b> <a class="float-right">{{ $user->name }}</a>
                                              </li>
                                              <li class="list-group-item">
                                                <b>email</b> <a class="float-right">{{ $user->email }}</a>
                                              </li>
                                              <li class="list-group-item">
                                                <b>Sebagai</b> <a class="float-right">
                                                  @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                  @endif
                                                </a>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            {{-- Modal detail --}}
                              {{-- Modal update --}}
                            <div class="modal fade" id="update{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Edit Akun </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                  
                                      {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                              <div class="form-group">
                                                  <strong>Name:</strong>
                                                  {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                              </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                              <div class="form-group">
                                                  <strong>Email:</strong>
                                                  {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                              </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                              <div class="form-group">
                                                  <strong>Password:</strong>
                                                  {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                              </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                              <div class="form-group">
                                                  <strong>Confirm Password:</strong>
                                                  {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                              </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                              <div class="form-group">
                                                  <strong>Role:</strong>
                                                  <select class="form-control" name="roles" id="exampleFormControlSelect1">
                                                    <option selected>
                                                      @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $v)
                                                            <label class="badge badge-success">{{ $v }}</label>
                                                        @endforeach
                                                      @endif
                                                    </option>
                                                    @foreach ($roles as $role )
                                                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select> 
                                              </div>
                                          </div>
                                          {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                          </div> --}}
                                      </div>
                                  
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                  {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                            {{-- Modal update --}}
                          @endforeach
                    <tbody>
                  </table>
                </div>
            </div>
        </div>
    
    </div>
         


@endsection