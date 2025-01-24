<div class="row p-2 justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Judul Form -->
                @isset($staff)
                    <h4><b>Edit Data</b></h4>
                    <hr>
                    <form action="/admin/staff/{{ $staff->id }}" method="POST">
                        @method('PUT')
                @else
                    <h4><b>Tambah Data</b></h4>
                    <hr>
                    <form action="/admin/staff" method="POST">
                @endisset

                @csrf

                <!-- Input Nama Staff -->
                <div class="form-group">
                    <label for="name">Nama Staff</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nama Staff"
                           value="{{ old('name', isset($staff) ? $staff->name : '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email Staff"
                           value="{{ old('email', isset($staff) ? $staff->email : '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Nomor Telepon -->
                <div class="form-group">
                    <label for="no_tlp">Nomor Telepon</label>
                    <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror"
                           placeholder="Nomor Telepon"
                           value="{{ old('no_tlp', isset($staff) ? $staff->no_tlp : '') }}">
                    @error('no_tlp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dropdown Jabatan -->
                <div class="form-group">
                    <label for="jabatan_id">Jabatan</label>
                    <select name="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Jabatan</option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ old('jabatan_id', isset($staff) ? $staff->jabatan_id : '') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol -->
                <a href="/admin/staff" class="btn btn-info mt-2">
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
