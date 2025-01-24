<div class="row p-2 ">
    <div class="col-md-12">
        <div class="card ">

        <div class="card-body">
            <!-- Judul Form -->
            <h4><b>{{ $title }}</b></h4>
            <a href="/admin/produk/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah</a>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($produk as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->kategori->name ?? '-' }}</td> <!-- Pastikan relasi kategori tersedia -->
                        <td>{{ $item->merk->name ?? '-' }}</td> <!-- Pastikan relasi merk tersedia -->
                        <td>{{ $item->stok}}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>
                <div class="d-flex ">
                  <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                  <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                   <form action="/admin/produk/{{ $item->id }}" method="POST">
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
                {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</div>