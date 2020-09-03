@extends('layouts.app')
@section('page-title','Users')

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="content">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
              </div>
              <div class="box-body">
              <?=$pdocrud->render();?>
              <?=$pdocrud->loadPluginJsCode("bootstrap-pwstrength",".password",$params);?>
              </div>
            </div>
          </section>
    </div>
</div>
@endsection