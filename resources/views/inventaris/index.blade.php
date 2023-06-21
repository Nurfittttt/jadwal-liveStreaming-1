@extends('layouts.app-master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Inventaris</h6>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>
                                @can('inventaris-create')
                                  <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Masukan inventaris  
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Buat Data Inventaris</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf  
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jenis Barang</label>
                                                                <select class="form-select" name="jenis_barang" aria-label="Default select example">
                                                                    <option selected>Open this select menu</option>
                                                                    <option value="kamera">Kamera</option>
                                                                    <option value="tripod">Tripod</option>
                                                                    <option value="mixer">Mixer</option>
                                                                    <option value="kabel">Kabel</option>
                                                                </select>
                                                                
                                                                <!-- error message untuk title -->
                                                                @error('jenis_barang')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputPassword4">Nama Barang</label>
                                                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Masukkan Nama Barang">
                                                                
                                                            </div>
                                                            {{-- <div class="form-group col-md-6">
                                                                <label for="inputPassword4">jumlah Barang</label>
                                                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan Nama Barang">
                                                            </div> --}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- <a class="btn btn-success" href="{{ route('inventaris.create') }}"> Create New inventaris </a> --}}
                                @endcan
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Jenis Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupedData as $jenis => $barang)
                            @php
                                $rowspan = $barang->count();
                                $firstRow = true;
                                $total = 0; // variabel untuk menyimpan total jumlah
                            @endphp
                            @foreach($barang as $index => $data)
                                <tr>
                                    @if($firstRow)
                                        <td rowspan="{{ $rowspan }}">{{ $jenis }}</td>
                                        @php $firstRow = false; @endphp
                                    @endif
                                    <td>{{ $data->nama_barang }}</td>
                                    {{-- <td>{{ $data->jumlah }}</td> --}}
                                    @if($index == 0) {{-- menambahkan kolom baru untuk menampilkan total jumlah pada baris pertama --}}
                                        <td rowspan="{{ $rowspan }}">{{ $rowspan }}</td>
                                    @endif
                                    <td>
                                        <form action="{{ route('inventaris.destroy',$data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @can('inventaris-delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            @endcan
                                            @can('inventaris-edit')
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $data->id }}">
                                                Edit
                                            </button>
                                            @endcan
                                        </form>
                                        <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Data {{ $data->nama_barang }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('inventaris.update',[$data->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf  
                                                        @method('PUT')
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Jenis Barang</label>
                                                                <select class="form-select" name="jenis_barang" aria-label="Default select example">
                                                                    <option selected>{{ $data->jenis_barang }}</option>
                                                                    <option value="kamera">kamera</option>
                                                                    <option value="tripod">tripod</option>
                                                                    <option value="microphone">microphone</option>
                                                                </select>
                                                                {{-- <select selected="selected" class="js-example-basic-multiple" name="jenis_barang[]" style="width: 100%" multiple="multiple">
                                                                    <option>Kamera</option>
                                                                    <option>Mixer</option>
                                                                    <option>purple</option>
                                                                  </select> --}}
                                                                <!-- error message untuk title -->
                                                                @error('jenis_barang')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputPassword4">Nama Barang</label>
                                                                <input type="text" value="{{ $data->nama_barang }}" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Masukkan Nama Barang">
                                                                
                                                            </div>
                                                            {{-- <div class="form-group col-md-6">
                                                                <label for="inputPassword4">jumlah Barang</label>
                                                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan Nama Barang">
                                                            </div> --}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                 
                    {{-- {!! $inventaris->links() !!} --}}
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
