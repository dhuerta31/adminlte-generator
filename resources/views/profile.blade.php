@extends('layouts.app')
@section('page-title','Perfil')

@section('content')
<div class="container-fluid">
    <div class="row">

        <section class="content">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
              </div>
              <div class="box-body">
                <?=$pdocrud->render("EDITFORM", array("id"=>Auth::user()->id));?>  
             <?=$pdocrud->loadPluginJsCode("bootstrap-pwstrength",".password",$params);?>
              </div>
            </div>
          </section>
    </div>
</div>
@endsection