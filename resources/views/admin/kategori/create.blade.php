<div class="row p-2 justify-content-center">
    <div class="col-md-6">
        <div class="card">

        <div class="card-body">
            <!-- Judul Form -->
            @isset($kategori)
                <h4><b>Edit Data</b></h4>
                    <hr>
                    <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
                        @method('PUT')
                @else
                    <form action="/admin/kategori" method="POST">
                    <h4><b>Tambah Data</b></h4>
                    <hr>
                @endisset
        
        @csrf    
        <label for="">Nama Kategori</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kategori" value="{{ isset($kategori) ? $kategori->name : '' }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

        <a href="/admin/kategori" class="btn btn-info mt-2"><i class="fas fa-arrow-left"></i>Kembali</a>
        <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-save"></i>Simpan</button>
        </form>
            </div>
        </div>
    </div>
</div>