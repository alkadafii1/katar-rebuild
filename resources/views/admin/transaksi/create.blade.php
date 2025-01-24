<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                        <label for="produk_id">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control" id="produk_id">
                                    <option value=""> {{ isset($p_detail) ? $p_detail->name : 'Nama Produk' }} </option>
                                    @foreach ($produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->id.'-'.$item->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="/admin/transaksi/detail/create" method="POST">
                    @csrf

                    @if(isset($p_detail))
            <input type="hidden" name="produk_id" value="{{ $p_detail->id }}">
             <input type="hidden" name="produk_name" value="{{ $p_detail->name }}">
            <input type="hidden" name="qty" value="{{ $p_detail->qty }}">
             <input type="hidden" name="subtotal" value="{{ $p_detail->subtotal }}">
               @endif

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                        <label for="">Nama Produk</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ isset($p_detail) ? $p_detail->name : '' }}" class="form-control" disabled name="name_produk">
                    </div>
                </div>

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                        <label for="p">Harga Satuan</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{ isset($p_detail) ? $p_detail->harga : '' }}" class="form-control" disabled name="harga_satuan">
                    </div>
                </div>

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                        <label for="">QTY</label>
                    </div>
                    <div class="col-md-8">
                    <div class="d-flex">
             <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn-primary">
                <i class="fas fa-minus"></i>
             </a>
             <input type="number" value="{{ $qty }}" class="form-control" name="qty" disabled>
             <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn-primary">
              <i class="fas fa-plus"></i>
             </a>
            </div>

            </div>

                </div>

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                    
                    </div>
                    <div class="col-md-8">
                        <h5>Subtotal : Rp.{{ $subtotal }}</h5>
                    </div>
                </div>

                <div class="row p-2 align-items-center">
                    <div class="col-md-4">
                    
                    </div>
                    <div class="col-md-8">
                        <a href="/admin/transaksi/edit" class="btn btn-info"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah<i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>QTY</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @if ($transaksi_detail->isNotEmpty())
            @foreach ($transaksi_detail as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->produk_name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        <a href=""><i class="fas fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">Belum ada detail transaksi.</td>
            </tr>
        @endif
    </tbody>
</table>


        <a href="" class="btn btn-success"><i class="fas fa-check"></i>Selesai</a>
        <a href="" class="btn btn-info"><i class="fas fa-file"></i>Pending</a>
            </div>
        </div>
    </div>

</div>
<div class="row p-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" name="total_belanja" class="form-control" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Dibayar</label>
                        <input type="number" name="bayar" class="form-control" id="">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Hitung</button>

                    <hr>
                    <div class="form-group">
                        <label for="">Uang Kembalian</label>
                        <input type="number" disabled name="kembalian" class="form-control" id="">
                    </div>

                </div>
            </div>
        </div>
    </div>
