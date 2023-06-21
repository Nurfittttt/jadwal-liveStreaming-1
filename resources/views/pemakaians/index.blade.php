@extends('layouts.app-master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Operasional</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>
                                @can('pemakaian-create')
                                  <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Pemakaian Barang 
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Pemakaian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pemakaians.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf  
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Nama Pemakai</label>
                                                                <input type="text"  class="form-control @error('Nama_Pemakaian') is-invalid @enderror" name="Nama Pemakaian" value="{{ old('Nama_Pemakaian') }}" placeholder="Masukkan Nama_Pemakaian">
                                                                <!-- error message untuk title -->
                                                                @error('Nama_Pemakaian')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputPassword4">Nama Barang</label>
                                                                <select selected="selected" class="js-example-basic-multiple" name="Nama_barang[]" style="width: 100%" name="Nama_barang" multiple="multiple">
                                                                    @foreach ($barang as $b )
                                                                        <option value="{{ $b->nama_barang }}">{{ $b->nama_barang }}</option>
                                                                        {{-- <option>white</option>
                                                                        <option>purple</option> --}}
                                                                    @endforeach
                                                                    
                                                                  </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_pakai">Tanggal Pemakaian</label>
                                                            <input type="date" name="tanggal_pakai" class="form-control" id="tanggal_pakai">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jam Mulai</label>
                                                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai" placeholder="Masukkan Nama">
                            
                                                                <!-- error message untuk title -->
                                                                @error('jam_mulai')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jam Selesai</label>
                                                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai" placeholder="Masukkan Nama">
                            
                                                                <!-- error message untuk title -->
                                                                @error('jam_selesai')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="Keterangan">Keterangan</label>
                                                                <input type="text" name="Keterangan" class="form-control" id="Keterangan">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                    {{-- <form action="{{ route('pemakaians.store') }}" method="POST" enctype="multipart/form-data">

                                                        @csrf                           
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">NAME</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                            
                                                            <!-- error message untuk title -->
                                                            @error('name')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                            
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">DETAIL</label>
                                                            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" rows="5" placeholder="Masukkan Pemakaian">{{ old('detail') }}</textarea>
                            
                                                            <!-- error message untuk content -->
                                                            @error('detail')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>  --}}
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                    
                                            
                                            </div>
                                            </div>
                                        </div>
                                    {{-- <a class="btn btn-success" href="{{ route('pemakaians.create') }}"> Create New pemakaian </a> --}}
                                @endcan
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pakai</th>
                                <th width="280px"></th>
                            </tr>
                        </thead>

                        @foreach ($pemakaian as $product)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $product->Nama_Pemakaian }}</td>
                            <td>{{ $product->Nama_Barang }}</td>
                            <td>{{ $product->Tanggal_Pakai }}</td>
                            <td>
                                <form action="{{ route('pemakaians.destroy',$product->id) }}" method="POST">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#show{{ $product->id }}">
                                        show 
                                     </button>
                                    {{-- @can('pemakaian-edit')
                                    <a class="btn btn-primary" href="{{ route('pemakaians.edit',$product->id) }}">Edit</a>
                                    @endcan


                                    @csrf
                                    @method('DELETE')
                                    @can('pemakaian-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan --}}
                                </form>
                                    
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="show{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Operasional</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pemakaians.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf  
                                                        {{-- <div class="form-group">
                                                            <label for="tanggal_pakai">Tanggal Pakai</label>
                                                            <input type="date" name="tanggal_pakai" class="form-control" id="tanggal_pakai">
                                                        </div> --}}
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jam Mulai</label>
                                                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ $product->jam_selesai }}" name="jam_mulai" placeholder="Masukkan Nama" disabled>
                            
                                                                <!-- error message untuk title -->
                                                                @error('jam_mulai')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jam Selesai</label>
                                                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ $product->jam_selesai }}" name="jam_selesai" placeholder="Masukkan Nama" disabled>
                            
                                                                <!-- error message untuk title -->
                                                                @error('jam_selesai')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" name="keterangan"  value="{{ $product->Keterangan }}" class="form-control" id="keterangan" disabled>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Penanggung jawab Operasional</label>
                                                                <input type="text" name="pj_pemakaian"  value="{{ $product->pj_pemakaian }}" class="form-control" id="pj_pemakaian" disabled>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div> --}}
                                                    </form>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{-- {!! $pemakaian->links() !!} --}}
                </div>
            </div>
        </div>
      
    </div>
      <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2()
        });
      </script>



@endsection
