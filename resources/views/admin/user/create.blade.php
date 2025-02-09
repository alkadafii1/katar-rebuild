<div class="container-fluid pt-2 ">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                @isset($user)
                <h4><b>Edit Data</b></h4>
                    <hr>
                    <form action="/admin/user/{{ $user->id }}" method="POST">
                        @method('PUT')
                @else
                    <form action="/admin/user" method="POST">
                    <h4><b>Tambah Data</b></h4>
                    <hr>
                @endisset

                    @csrf 
                    <div class="form-group">
                        <label for=""><b>Nama Lengkap</b></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama Lengkap" value="{{ isset($user) ? $user->name : '' }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for=""><b>Email</b></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : '' }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for=""><b>Password</b></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for=""><b>Roles</b></label>
                    <select class="form-control @error('roles') is-invalid @enderror" name="roles">
                        <option value="" disabled {{ !isset($user) ? 'selected' : '' }}>Pilih Roles</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ isset($user) && $user->roles == $role ? 'selected' : '' }}>
                     {{ ucfirst($role) }}
                         </option>
                         @endforeach
                    </select>

    @error('roles')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


                    <a href="/admin/user" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>