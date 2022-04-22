
 @extends('layouts.app')
 @section('content')
 @if($flag == 1) 
     <!-- Bootstrapの定形コード… -->
     <div class="card-body">
         <!--<div class="card-title">-->
         <!--    薬品名-->
         <!--</div>-->

         <!-- バリデーションエラーの表示に使用-->
     	@include('common.errors')
         <!-- バリデーションエラーの表示に使用-->
         <!-- 本登録フォーム -->
         <form action="{{ url('reagents') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             {{ csrf_field() }}
             <!-- 本のタイトル -->
             <div class="card-title">
                 薬品名
             </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_name" class="form-control" placeholder="薬品名 / 未開封容量を入力してください">
                 </div>
             </div>

              <div class="card-title" style="padding-top:10px;">
                  未開封薬品数(本)
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_number" class="form-control" placeholder="数量を入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  開封済薬品重量(g)
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_capcity" class="form-control" placeholder="重量を整数で入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  バーコード
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_barcode" class="form-control" placeholder="バーコードの末尾4桁を入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  保護具
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_epuipment" class="form-control" placeholder="使用する保護具を入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  救急対応
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="text" name="reagent_correspondence" class="form-control" placeholder="救急対応を入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  保管方法
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <input type="link" name="reagent_storage" class="form-control" placeholder="保管時の注意を入力してください">
                 </div>
             </div>
             <div class="card-title" style="padding-top:10px;">
                  SDS
              </div>
             <div class="form-group">
                 <div class="col-sm-6">
                  <!--input typeは初期値を入れ込めない-->
                     <input type="file" name="reagent_document" class="form-control">
                 </div>
             </div>
             
             <!-- 本 登録ボタン -->
             <div class="form-group" style="padding-top:10px;">
                 <div class="col-sm-offset-3 col-sm-6">
                     <button type="submit" class="btn btn-primary">
                         登録
                     </button>
                 </div>
             </div>
         </form>
     </div>
     @endif
     <div class="col-sm-6" style="padding:20px 0; padding-left:20px;">
      <form class="form-inline" action="{{url('/reagents')}}">
       <div class="form-group" style="padding-bottom:10px;">
          <!--valueをどうしたら良いかわからない-->
        <input type="text" name="keyword" class="form-control" placeholder="薬品名を入力してください">
       </div>
        <input type="submit" value="検索" class="btn btn-info">
      </form>
     </div>
     <!-- Reagent: 既に登録されてる本のリスト -->
     <!-- 現在の本 -->
     @if (count($reagents) > 0)
         <div class="card-body">
             <div class="card-body">
                 <table class="table table-striped task-table">
                     <!-- テーブルヘッダ -->
                     <thead>
                         <th>一覧</th>
                         <th>&nbsp;</th>
                     </thead>
                     <thead>
                         <th>薬品名</th>
                         <th>未開封<br>薬品数量(本)</th>
                         <th>開封済<br>薬品重量(g)</th>
                         <th>バーコード</th>
                         <th>保護具</th>
                         <th>救急対応</th>
                         <th>保管方法</th>
                         <th>SDS</th>
                         <th>登録者</th>
                         <th>登録日時</th>
                         <th>更新日時</th>
                     </thead>
                     <!-- テーブル本体 -->
                     <tbody>
                         @foreach ($reagents as $reagent)
                             <tr>
                                 <!-- 本タイトル -->
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_name }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_number }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_capcity }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_barcode }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_epuipment }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_correspondence }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <div>{{ $reagent->reagent_storage }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                     <a href="{{asset($reagent->reagent_document)}}">PDF</a>
                                 </td>
                                 
                                 <!--ここはログインしないで開くとエラー発生。web.phpのindexに->middlewareを追加してエラー回避。ここだけ valign="middle"を入れると中央揃えにならない-->
                                 <td class="table-text" valign="middle">
                                      <div>{{ $reagent->user->name }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                      <div>{{ $reagent->created_at }}</div>
                                 </td>
                                 <td class="table-text" valign="middle">
                                      <div>{{ $reagent->updated_at }}</div>
                                 </td>
                                 
                                 <!--更新削除は登録管理者のみができるように-->
                                 @if($flag == 1) 
                                 <td>
                                	 <form action="{{ url('reagentsedit/'.$reagent->id) }}" method="GET"> {{ csrf_field() }}
                                	     <button type="submit" class="btn btn-primary">更新 </button>
                                	 </form>
                                 </td>
                                 <td>
                                     <form action="{{ url('reagent/'.$reagent->id) }}" method="POST">
                                             {{ csrf_field() }}
                                             {{ method_field('DELETE') }}
                                             <button type="submit" class="btn btn-danger">
                                                 削除
                                             </button>
                                     </form>
                                 </td>
                                 @endif
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>		
    @endif
 @endsection
