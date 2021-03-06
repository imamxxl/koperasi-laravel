@extends('layout.template')
@section('title', 'Pinjaman')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">

                    <div class="box-body">
                        <button type="button" class="btn btn-lg btn-success fa fa-plus" data-toggle="modal"
                            data-target="#modal-add">
                            Tambah Data
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>

                        <div class="card-body box-body table-hover">
                            <table id="datatableid" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Anggota</th>
                                        <th>Jmlh Pinjaman</th>
                                        <th>Tenor</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($pinjaman as $data)
                                        <tr>
                                            <td class="content-header">{{ $no++ }}</td>
                                            <td>{{ $data->no_pinjaman }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->jumlah_pinjaman }}</td>
                                            <td>{{ $data->tenor }}</td>
                                            <td>{{ $data->total_angsuran }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <!-- Status Pinjaman -->
                                            @if ($data->status == 'diterima')
                                                <td>
                                                    <span class="label label-success" data-id="{{ $data->status }}">Di
                                                        terima</span>
                                                </td>
                                            @elseif ($data->status == 'ditolak')
                                                <td>
                                                    <span class="label label-danger" data-id="{{ $data->status }}">Di
                                                        tolak</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="label label-warning" data-id="{{ $data->status }}">Di
                                                        proses</span>
                                                </td>
                                            @endif
                                            {{-- <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#modal-edit{{ $data->kode_mk }}">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#modal-nonaktif{{ $data->kode_mk }}">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-block"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-block" value="submit">Simpan
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

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

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>

    <script src="{{ asset('template') }}/bower_components/jquery/dist/jquery.min.js"></script>

    {{-- <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('books.index') }}",
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'author',
                        name: 'author'
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
                $('#book_id').val('');
                $('#bookForm').trigger("reset");
                $('#modelHeading').html("Create New Book");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editBook', function() {
                var book_id = $(this).data('id');
                $.get("{{ route('books.index') }}" + '/' + book_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#book_id').val(data.id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                })
            });
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#bookForm').serialize(),
                    url: "{{ route('books.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#bookForm').trigger("reset");
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

                var book_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('books.store') }}" + '/' + book_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script> --}}

@endsection
