<div class="row p-2 justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Judul Form -->
                <h4><b>{{ $title }}</b></h4>
                <hr>
                <form action="/admin/shift" method="POST">
                    @csrf

                    <!-- Dropdown Staff -->
                    <div class="form-group">
                        <label for="staff_id">Staff</label>
                        <select name="staff_id" class="form-control @error('staff_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Staff</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Jam Kerja -->
                    <div class="form-group">
                        <label for="jama_kerja">Jam Kerja</label>
                        <input type="time" name="jama_kerja" class="form-control @error('jama_kerja') is-invalid @enderror" value="{{ old('jama_kerja') }}">
                        @error('jama_kerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Jam Pulang -->
                    <div class="form-group">
                        <label for="jam_pulang">Jam Pulang</label>
                        <input type="time" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror" value="{{ old('jam_pulang') }}">
                        @error('jam_pulang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <a href="/admin/shift" class="btn btn-info mt-2">
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
