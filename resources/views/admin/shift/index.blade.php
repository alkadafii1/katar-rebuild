<div class="row p-2 ">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <!-- Judul Form -->
                <h4><b>{{ $title }}</b></h4>
                <a href="/admin/shift/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah Shift</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Staff</th>
                        <th>Jam Kerja</th>
                        <th>Jam Pulang</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $shift->staff->name ?? '-' }}</td> <!-- Pastikan relasi staff tersedia -->
                        <td>{{ $shift->jama_kerja }}</td>
                        <td>{{ $shift->jam_pulang }}</td>
                        <td>
                            <div class="d-flex ">
                                <a href="/admin/shift/{{ $shift->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="/admin/shift/{{ $shift->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="d-flex justify-content-center">
                    {{ $shifts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
