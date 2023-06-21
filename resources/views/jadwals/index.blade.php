@extends('layouts.app-master')

@section('content')


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{-- modal --}}
    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <head>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
                </head>
                <div class="container">
                    <div id='calendar'></div>
                </div>
                <script>
                $(document).ready(function () {
                var SITEURL = "{{ url('/') }}";
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var calendar = $('#calendar').fullCalendar({
                                    editable: true,
                                    events: SITEURL + "/fullcalender",
                                    displayEventTime: false,
                                    editable: true,
                                    eventRender: function (event, element, view) {
                                        if (event.allDay === 'true') {
                                                event.allDay = true;
                                        } else {
                                                event.allDay = false;
                                        }
                                    },
                                    selectable: true,
                                    selectHelper: true,
                                    select: function (start, end, allDay) {
                                        var title = prompt('Event Title:');
                                        if (title) {
                                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                            $.ajax({
                                                url: SITEURL + "/fullcalenderAjax",
                                                data: {
                                                    title: title,
                                                    start: start,
                                                    end: end,
                                                    type: 'add'
                                                },
                                                type: "POST",
                                                success: function (data) {
                                                    displayMessage("Event Created Successfully");
                                                    calendar.fullCalendar('renderEvent',
                                                        {
                                                            id: data.id,
                                                            title: title,
                                                            start: start,
                                                            end: end,
                                                            allDay: allDay
                                                        },true);
                                                    calendar.fullCalendar('unselect');
                                                }
                                            });
                                        }
                                    },
                                    eventDrop: function (event, delta) {
                                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                                           $.ajax({
                                            url: SITEURL + '/fullcalenderAjax',
                                            data: {
                                                title: event.title,
                                                start: start,
                                                end: end,
                                                id: event.id,
                                                type: 'update'
                                            },
                                            type: "POST",
                                            success: function (response) {
                                                displayMessage("Event Updated Successfully");
                                            }
                                        });
                                    },
                                    eventClick: function (event) {
                                        var deleteMsg = confirm("Do you really want to delete?");
                                        if (deleteMsg) {
                                            $.ajax({
                                                type: "POST",
                                                url: SITEURL + '/fullcalenderAjax',
                                                data: {
                                                        id: event.id,
                                                        type: 'delete'
                                                },
                                                success: function (response) {
                                                    calendar.fullCalendar('removeEvents', event.id);
                                                    displayMessage("Event Deleted Successfully");
                                                }
                                            });
                                        }
                                    }
                                });
                });
                function displayMessage(message) {
                    toastr.success(message, 'Event');
                }
                </script>
            </div>
        </div>
      </div>

    </div>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form>
                        <fieldset disabled>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Tanggal Mulai Acara</label>
                            <input type="text" id="disabledTextInput" class="form-control start" placeholder="Disabled input">
                          </div>
                          {{-- <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Tanggal Selesai Acara</label>
                            <input type="text" id="disabledTextInput" class="form-control end" placeholder="Disabled input">
                          </div> --}}
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Jam Acara</label>
                            <input type="text" id="disabledTextInput" class="form-control jam_acara" placeholder="Disabled input">
                          </div>
                          <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Keterangan Acara</label>
                            <input type="text" id="disabledTextInput" class="form-control description" placeholder="Disabled input">
                          </div>
                       
                        </fieldset>
                      </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Jadwal</h6>
            </div>
            <div class="col d-flex justify-content-center mt-2">
                <div id='calendar' style="width:50%"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMd">
                                    Kalender Jadwal
                                  </button>
                                <h1 class="h3 mb-0 text-gray-800"></h1>
                                {{-- @can('jadwal-create') --}}
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800"></h1>
                                    @can('inventaris-create')
                                      <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                Tambahkan Jadwal 
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('jadwals.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf  
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4">Judul Acara</label>
                                                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Acara">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4">Tanggal Mulai Acara</label>
                                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" placeholder="Masukkan Nama Barang">
                                                                </div>
                                                                {{-- <div class="form-group col-md-6">
                                                                    <label for="inputPassword4">Tanggal Selesai Acara</label>
                                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" placeholder="Masukkan Nama Barang">
                                                                </div> --}}
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4">Keterangan Acara</label>
                                                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="Masukkan keterangan Acara">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputPassword4">Jam Acara</label>
                                                                    <input type="time" class="form-control @error('jam_acara') is-invalid @enderror" name="jam_acara" value="{{ old('jam_acara') }}" placeholder="Masukkan keterangan Acara">
                                                                </div>
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
                                {{-- @endcan --}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Judul Acara</th>
                                <th>keterangan Acara</th>
                                <th width="280px"></th>
                            </tr>
                        </thead>

                        @foreach ($jadwals as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                            
                                <form action="{{ route('jadwals.destroy',$product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('jadwal-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan
                                    @can('jadwal-edit')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $product->id }}">
                                        Edit
                                    </button>
                                    @endcan
                                </form>
                                <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('jadwals.update',[$product->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf  
                                                @method('PUT')
                                                {{-- <form action="{{ route('jadwals.update',[$product->id]) }}" method="POST" enctype="multipart/form-data"> --}}
                                                    @csrf  
                                                        <div class="form-group ">
                                                            <label for="inputPassword4">Judul Acara</label>
                                                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $product->title }}" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Acara">
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="inputPassword4">Tanggal Mulai Acara</label>
                                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"  value="{{ $product->start_date }}" name="start_date" value="{{ old('start_date') }}" placeholder="Masukkan Nama Barang">
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="inputPassword4">Tanggal Selesai Acara</label>
                                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $product->end_date }}"  name="end_date" value="{{ old('end_date') }}" placeholder="Masukkan Nama Barang">
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="inputPassword4">Jam Acara</label>
                                                            <input type="time" class="form-control @error('jam_acara') is-invalid @enderror" value="{{ $product->jam_acara }}" name="jam_acara" value="{{ old('description') }}" placeholder="Masukkan keterangan Acara">
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="inputPassword4">keterangan Acara</label>
                                                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $product->description }}" name="description" value="{{ old('description') }}" placeholder="Masukkan keterangan Acara">
                                                        </div>
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
                    </table>
                    {{-- {!! $jadwals->links() !!} --}}
                </div>
            </div>
        </div>

    </div>



@endsection
