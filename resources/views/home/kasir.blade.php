@extends('layouts.app')

@section('title')
  Dashboard
@endsection

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">Selamat Datang</h3>
          </div>
          <div class="card-body">
              <p class="d-flex flex-column">
                Anda login sebagai Kasir
              </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection