@extends('layouts.app')

@section('style')

@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Data Siswa Edit</h3>
            </div>
            <form action="{{ route('edit-siswa', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    @include('components.form-message')

                    <div class="form-group mb-3">
                        <label for="username">NIS</label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror"
                            id="nis" name="nis" value="{{ old('nis') ?? $user->nis }}"
                            placeholder="Masukan NIS">
                        @error('nis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') ?? $user->name }}" placeholder="Masukan name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') ?? $user->username }}"
                            placeholder="Masukan username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

        
                    <div class="form-group mb-3">
                        <label for="email">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" id="no_tlp" name="no_tlp" value="{{ old('no_tlp')  ?? $user->no_tlp }}"  placeholder="Masukan Nomor Pegawai">
                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Lokasi Prakerin</label>
                        <textarea name="lokasi_prakerin" id="" cols="30" rows="10" class="form-control @error('lokasi_prakerin') is-invalid @enderror" >{{ $user->lokasi_prakerin }}</textarea>
                        @error('lokasi_prakerin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <input type="hidden" name="role" value="Siswa">
                    

                    <div class="form-group mb-3">
                        <label for="avatar">Avatar :</label>
                        <img src="{{ asset('img/users/'.($user->avatar ?? 'user.png')) }}" width="110px"
                            class="image img" />

                        <div class="input-group mt-3">
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                        {{-- <div class="small text-secondary">Kosongkan jika tidak mau diisi</div> --}}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Save</button>
                    <a href="{{ route('siswa') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Change Password</h3>
            </div>
            <form action="{{ route('users.change-password') }}" method="POST">
                @method('patch')
                @csrf
                <div class="card-body">

                    @include('components.flash-message')

                    <div class="form-group mb-3">
                        <label for="password">Old Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password" name="new_password" value="{{ old('new_password') }}"
                            placeholder="New Password">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-warning">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Fungsi untuk menampilkan atau menyembunyikan inputan koordinator
    function toggleKoordinatorInput() {
        var roleSelect = document.getElementById("role");
        var koordinatorInput = document.getElementById("koordinatorInput");

        console.log('====================================');
        console.log(roleSelect.value);
        console.log('====================================');

        if (roleSelect.value === "Anggota") {
            koordinatorInput.style.display = "block";
        } else {
            koordinatorInput.style.display = "none";
        }
    }

    // Panggil fungsi toggle saat halaman dimuat dan saat perubahan pada dropdown role
    window.addEventListener("load", toggleKoordinatorInput);
    document.getElementsByName("role")[0].addEventListener("change", toggleKoordinatorInput);
</script>
@endsection