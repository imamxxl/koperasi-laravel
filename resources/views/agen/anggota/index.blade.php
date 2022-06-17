@extends('layout.template')
@section('title', 'Anggota')

@section('content')
    <!-- Main content -->

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    {{-- <div class="box-body">
                        <button type="button" class="btn btn-lg btn-success fa fa-plus" data-toggle="modal"
                            data-target="#modal-add">
                            Tambah Data
                        </button>
                    </div> --}}

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>

                        {{-- <div class="card-body box-body table-hover">
                            <table id="datatableid" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No Anggota</th>
                                        <th>JK</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($anggota as $data)
                                        <tr>
                                            <td class="content-header">{{ $no++ }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->jk }}</td>
                                            <td>{{ $data->pekerjaan }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->no_telp }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}

                        <div class="container">
                            <h1>Laravel 8 Crud with Ajax</h1>
                            <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create New Book</a>
                            <table class="table table-bordered data-table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>No Anggota</th>
                                        <th>JK</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>No. Telp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- form ajax -->
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="anggotaForm" name="anggotaForm" class="form-horizontal">
                                       <input type="hidden" name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">nama</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama" value="" maxlength="50" required="">
                                            </div>
                                        </div>
                         
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-12">
                                                <textarea id="email" name="email" required="" placeholder="Enter email" class="form-control"></textarea>
                                            </div>
                                        </div>
                          
                                        <div class="col-sm-offset-2 col-sm-10">
                                         <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                         </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Add -->
                    <div class="modal fade" id="modal-add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Tambah Data Matakuliah</h4>
                                </div>

                                <div class="modal-header">
                                    <div class="callout callout-warning">
                                        <p><b>Peringatan!!!</b><br>
                                            Pastikan input data Matakuliah sudah benar. Data <b>Kode Matakuliah</b>
                                            yang sudah diinputkan merupakan data permanen yang tidak dapat diubah atau
                                            dihapus untuk alasan keamanan.
                                        </p>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <form action="/matakuliah/add/insert" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>ID Anggota</label>
                                                <label class="text-danger">*</label>
                                                <input type="text" name="anggota" class="form-control"
                                                    value="{{ old('anggota') }}" placeholder="Contoh: 123">
                                                <div class="text-danger">
                                                    @error('anggota')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Nama Matakuliah</label>
                                                <label class="text-danger">*</label>
                                                <input type="text" name="nama_mk" class="form-control"
                                                    value="{{ old('nama_mk') }}"
                                                    placeholder="Contoh: Teknik Komputasi">
                                                <div class="text-danger">
                                                    @error('nama_mk')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="position-option">Jurusan</label>
                                                <label class="text-danger">*</label>
                                                @if ($hitung_jurusan == 0)
                                                    <select class="form-control" name="kode_jurusan" disabled>
                                                        <option value="">- Belum Ada Jurusan. Tambahkan Jurusan! -
                                                        </option>
                                                    </select>
                                                @else
                                                    <select class="form-control" name="kode_jurusan">
                                                        @foreach ($jurusan as $data)
                                                            <option value="{{ $data->kode_jurusan }}"
                                                                @if (old('kode_jurusan') == $data->kode_jurusan) {{ 'selected ' }} @endif>
                                                                {{ $data->nama_jurusan }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <div class="text-danger">
                                                    @error('kode_jurusan')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>SKS</label>
                                                <label class="text-danger">*</label>
                                                <select class="form-control" name="sks">
                                                    <option value="">- SKS -</option>
                                                    @for ($i = 1; $i <= 6; $i++)
                                                        <option value="{{ $i }}"
                                                            @if (old('sks') == $i) {{ 'selected ' }} @endif>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <div class="text-danger">
                                                    @error('sks')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <p>Keterangan: <a class="text-danger disabled">(*) Wajib diisi</a> </p>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="anggotaForm" name="anggotaForm" class="form-horizontal">
                                        <input name="id" id="id">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">nama</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="Enter nama" value="" maxlength="50"
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Details</label>
                                            <div class="col-sm-12">
                                                <textarea id="email" name="email" required="" placeholder="Enter email" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Details</label>
                                            <div class="col-sm-12">
                                                <textarea id="email" name="email" required="" placeholder="Enter email" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- /.box-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-block"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-block" id="saveBtn"
                                        value="submit">Simpan
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- <!-- Modal Edit -->
                    @foreach ($matakuliah as $data)
                        <div class="modal fade" id="modal-edit{{ $data->kode_mk }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"> Edit {{ $data->nama_mk }} </h4>
                                    </div>
                                    <form action="/matakuliah/update/{{ $data->kode_mk }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Kode Matakuliah</label>
                                                <label class="text-danger">*</label>
                                                <input type="text" name="kode_mk" class="form-control"
                                                    value="{{ $data->kode_mk }}" readonly placeholder="Contoh: TIK113">
                                                <div class="text-danger">
                                                    @error('kode_mk')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Matakuliah</label>
                                                <label class="text-danger">*</label>
                                                <input type="text" name="nama_mk" class="form-control"
                                                    value="{{ $data->nama_mk }}" placeholder="Contoh: Teknik Komputasi">
                                                <div class="text-danger">
                                                    @error('nama_mk')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Jurusan</label>
                                                <label class="text-danger">*</label>
                                                <select class="form-control" name="kode_jurusan">
                                                    @foreach ($jurusan as $list_jurusan)
                                                        <option value="{{ $list_jurusan->kode_jurusan }}"
                                                            {{ $list_jurusan->kode_jurusan == $data->kode_jurusan ? 'selected' : '' }}>
                                                            {{ $list_jurusan->nama_jurusan }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger">
                                                    @error('kode_jurusan')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>SKS</label>
                                                <label class="text-danger">*</label>
                                                <select name="sks" class="form-control">
                                                    @for ($i = 1; $i <= 6; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $data->sks == $i ? 'selected' : '' }}>
                                                            {{ $i }} </option>
                                                    @endfor
                                                </select>
                                                <div class="text-danger">
                                                    @error('sks')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <p>Keterangan: <a class="text-danger disabled">(*) Wajib diisi</a> </p>
                                            </div>

                                        </div>
                                        <!-- /.box-body -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-block"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary btn-block" value="submit">Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endforeach

                    <!-- Modal Nonaktif -->
                    @foreach ($matakuliah as $data)
                        <div class="modal fade" id="modal-nonaktif{{ $data->kode_mk }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"> Nonaktifkan {{ $data->nama_mk }} ? </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-danger">
                                            <p><b>Peringatan : </b></p>
                                        </div>
                                        <p>Anda yakin ingin <b> menghapus/menonaktifkan </b> data
                                            {{ $data->nama_mk }}?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left"
                                            data-dismiss="modal">Tidak</button>
                                        <a href="/matakuliah/nonaktif/{{ $data->kode_mk }}"
                                            class="btn btn-danger">Ya!</a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endforeach --}}

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>

    <script src="{{ asset('template') }}/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('anggota.index') }}",
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $('#createNewBook').click(function() {
                $('#saveBtn').val("create-book");
                $('#id').val('');
                $('#anggotaForm').trigger("reset");
                $('#modelHeading').html("Create New Book");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editBook', function() {
                var id = $(this).data('id');
                $.get("{{ route('anggota.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#email').val(data.email);
                })
            });
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#anggotaForm').serialize(),
                    url: "{{ route('anggota.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#anggotaForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteBook', function() {
                var id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('anggota.store') }}" + '/' + id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection
