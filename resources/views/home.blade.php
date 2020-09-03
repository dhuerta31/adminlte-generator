@extends('layouts.app')
@section('page-title','Home')

@section('content')

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Panel</li>
  </ol>
</section>


<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
  
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $data[0]['Total'] }}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      <a href="{{route('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $value[0]['Total'] }}</h3>

          <p>User Rol</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{route('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <?=$pdocrud->render("chart", array("chart3"));?>
  </div>
  <!-- /.row (main row) -->

<div style="padding-bottom: 15px; max-width: 100%; overflow: hidden;">
  <script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6272584992356792" data-ad-slot="5657143564" data-ad-format="auto" data-full-width-responsive="true"></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
</section>


@endsection


