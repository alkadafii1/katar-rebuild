<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Judul Form -->
                <h4><b>{{ $title }}</b></h4>
                <a href="/admin/staff/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_tlp }}</td>
                            <td>{{ optional($item->jabatan)->name ?? '-' }}</td> <!-- Relasi Jabatan -->
                            <td>
                                <div class="d-flex">
                                    <a href="/admin/staff/{{ $item->id }}/edit" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/admin/staff/{{ $item->id }}" method="POST" class="ml-1">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $staff->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
