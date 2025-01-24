<div class="row p-2 justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Judul Form -->
                @isset($produk)
                    <h4><b>Edit Data</b></h4>
                    <hr>
                    <form action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                @else
                    <h4><b>Tambah Data</b></h4>
                    <hr>
                    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
                @endisset

                @csrf

                <!-- Input Nama Produk -->
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nama Produk"
                           value="{{ old('name', isset($produk) ? $produk->name : '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dropdown Kategori -->
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', isset($produk) ? $produk->kategori_id : '') == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Dropdown Merk -->
                <div class="form-group">
                    <label for="merk_id">Merk</label>
                    <select name="merk_id" class="form-control @error('merk_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Merk</option>
                        @foreach ($merks as $merk)
                            <option value="{{ $merk->id }}" {{ old('merk_id', isset($produk) ? $produk->merk_id : '') == $merk->id ? 'selected' : '' }}>{{ $merk->name }}</option>
                        @endforeach
                    </select>
                    @error('merk_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Input Harga -->
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                           placeholder="Harga Produk"
                           value="{{ old('harga', isset($produk) ? $produk->harga : '') }}">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Stok -->
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                           placeholder="Jumlah Stok"
                           value="{{ old('stok', isset($produk) ? $produk->stok : '') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Gambar -->
                <div class="form-group">
                    <label for="gambar">Upload Gambar</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @isset($produk->gambar)
                        <div class="form-group mt-2">
                            <label>Gambar Saat Ini:</label>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" class="img-thumbnail" width="200">
                        </div>
                    @endisset
                </div>

                <!-- Tombol -->
                <a href="/admin/produk" class="btn btn-info mt-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
