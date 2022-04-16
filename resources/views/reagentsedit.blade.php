@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <!--<form action="{{ url('reagents/update') }}" method="POST">-->
        <form action="{{ url('reagents/update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <!-- reagent_name -->
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_name">薬品名</label>
                    <input type="text" name="reagent_name" class="form-control" value="{{$reagent->reagent_name}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">数量</label>
                    <input type="text" name="reagent_number" class="form-control" value="{{$reagent->reagent_number}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">薬品容量</label>
                    <input type="text" name="reagent_capcity" class="form-control" value="{{$reagent->reagent_capcity}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">薬品のバーコード</label>
                    <input type="text" name="reagent_barcode" class="form-control" value="{{$reagent->reagent_barcode}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">保護具</label>
                    <input type="text" name="reagent_epuipment" class="form-control" value="{{$reagent->reagent_epuipment}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">救急対応</label>
                    <input type="text" name="reagent_correspondence" class="form-control" value="{{$reagent->reagent_correspondence}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6" style="padding:5px 0; padding-left:20px;">
                    <label for="reagent_number">薬品保管方法</label>
                    <input type="text" name="reagent_storage" class="form-control" value="{{$reagent->reagent_storage}}">
                </div>
            </div>
            
            <div class="form-group" style="padding:5px 0; padding-left:20px;">	
                <div class="col-sm-6">
                    <label for="reagent_name">SDS</label>	
                    <!--typeをtextからfileに変えた。-->	
                    <input type="file" name="reagent_document" class="form-control" value="{{$reagent->reagent_document}}">	
                </div>
            </div>

            
            <!--/ reagent_name -->
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm" style="padding:5px 0; padding-left:20px;">
                <button type="submit" class="btn btn-primary">変更</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}">戻る</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$reagent->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>

@endsection