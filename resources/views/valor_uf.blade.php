@extends('layouts.app')
@section('page-title','Valor Uf')

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
                <?=$pdocrud->render("chart", array("chart2"));?>
              </div>
            </div>
          </section>
    </div>
</div>
@endsection