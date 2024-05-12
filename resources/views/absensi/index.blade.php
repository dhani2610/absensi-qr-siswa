@extends('layouts.app')

@section('style')
<style>
.buttons-excel{
  background: green;
  color: white!important;
}
.buttons-excel span{
  color: white!important;
}
</style>
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              <i class="far fa-user text-lg"></i> 
              {{ $page_title }}
            </span>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>
      <div class="card-header " >
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-6 mt-1">
            <div class="form-group">
              <form action="" method="get">
                @csrf
                <span>Tanggal Absen</span>
                @php
                    $tanggal_absen = Request::get('tanggal_absen');
                @endphp
                <input type="date" class="form-control" name="tanggal_absen" value="{{ $tanggal_absen ?? date('Y-m-d') }}">
                <div class="col-12 d-flex justify-content-end mt-2">
                  <button type="submit" class="btn btn-md btn-info">
                    Filter
                  </button>
                </div>
              </form>
            </div>
          </div>
          
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
            <table id="absen" class="table table-hover table-bordered ">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Lokasi Prakerin</th>
                  <th>Tanggal Absen</th>
                  <th>Waktu Absen</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($absen as $item)
                <tr>
                  @php
                      $siswa = \App\Models\User::where('id',$item->id_siswa)->first();
                  @endphp
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $siswa->nis ?? '-' }}</td>
                  <td>{{ $siswa->name ?? '-' }}</td>
                  <td>{{ $siswa->lokasi_prakerin ?? '-' }}</td>
                  <td>{{ $item->tanggal_absen }}</td>
                  <td>{{ $item->waktu_absen }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#absen').DataTable({

      dom: 'Bfrtip',
      "buttons": [
        'excel'
      ]
    });
  });
</script>
@endsection