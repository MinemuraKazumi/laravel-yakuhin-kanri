<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;//4/20追記
use App\Models\Reagent;
use Validator;
use Auth;//Authを使うために必要だけど、Authは深海の奥深くあるのでぱっと見どこいるか不明

class ReagentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reagents = Reagent::orderBy('created_at', 'asc')->get();
        
        // 今ログインしているユーザー情報をデータベース取ってくる
        $user = Auth::user();
        // ログインしているユーザー情報のカラム(フラグ番号)を確認する
        $flag = $user->flag;

         return view('reagents', 
            //  ['reagents' => $reagents, 'user' => $user, 'flag' => $flag]//下のコードと一緒
              compact('reagents', 'user', 'flag')
             
            //  []はヤマト運輸でコントローラーからビューに持っていくよ
            // reagentsは相手(=ビューに渡った時の名前)、右側が荷物
         );
     //return view('books',compact('books')); //も同じ意味
    }
    
    // 検索フォーム
    public function search(Request $request)
    {
        // ここを足してみたらエラーは無くなったけど、検索ができなくなった。
        $reagents = Reagent::orderBy('created_at', 'asc')->get();
        $user = Auth::user();
        $flag = $user->flag;
        
        $reagents = Reagent::where('reagent_name', 'LIKE', "%{$request->keyword}%")->get();

         return view('reagents', 
              compact('reagents', 'user', 'flag')
            //   returnより後ろは動かなかっている。このため、検索機能が停止していた。
        );

        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーション 入力チャック
        $validator = Validator::make($request->all(), [
        'reagent_name' => 'required|max:255',
        'reagent_number' => 'required|integer|max:100000',
        'reagent_capcity' => 'required|integer|max:100000',
        'reagent_barcode' => 'required|integer|max:100000',
        'reagent_epuipment' => 'required|string',
        'reagent_correspondence' => 'required|string',
        'reagent_storage' => 'required|string',
        'reagent_document' => 'required',
        ]);
        
        //バリデーション:エラー 
        if ($validator->fails()) {
        return redirect('/')
        ->withInput()
        ->withErrors($validator);
        }
        
         // Eloquent モデル
         $reagents = new Reagent;
         $reagents->reagent_name = $request->reagent_name;
         $reagents->reagent_number = $request->reagent_number;
         $reagents->reagent_capcity  = $request->reagent_capcity;
         $reagents->reagent_barcode  = $request->reagent_barcode;
         $reagents->reagent_epuipment  = $request->reagent_epuipment;
         $reagents->reagent_correspondence  = $request->reagent_correspondence;
         $reagents->reagent_storage  = $request->reagent_storage;
         $reagents->user_id = Auth::id();//4/20追記
         
         //pdfは容量、名前等のデータが複数ありデータベースに直接入れられないため、まず名前等の全体が入った状態で取得する
         $pdf_file =  $request->file('reagent_document');
         // アップロードするファイル名を取得するため、getClientOriginalName()を使う(全体から欲しいものだけが取れる)。
         // 取出作業のため()が必要。->の前後は空白あけない。
         //tmpというエラーが出た。ここのデータを読み取っていた  
         $pdf_name = $pdf_file->getClientOriginalName(); 
         // storeAsメソッドでstorage/app配下にファイルを保存できる。ここのpublicがないとエラーになる。
         $file = $pdf_file->storeAs('public', $pdf_name);
         // pdfを(storege/app)におく。保存されるファイル名という名前で保存される
         // 第一引数はファイルを指定したい場合に記載する。
         $reagents->reagent_document = 'storage/' .$pdf_name;
         
         
         
         $reagents->published = '2017-03-07 00:00:00';
         $reagents->save(); 
         
         return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reagent $reagent)
    {
        
        return view('reagentsedit', ['reagent' => $reagent]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //バリデーション
    $validator = Validator::make($request->all(), [
        'reagent_name' => 'required|max:255',
        'reagent_number' => 'required|integer|max:100000',
        'reagent_capcity' => 'required|integer|max:100000',
        'reagent_barcode' => 'required|integer|max:100000',
        'reagent_epuipment' => 'required|string',
        'reagent_correspondence' => 'required|string',
        'reagent_storage' => 'required|string',
        // 'reagent_document' => 'required',

    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    // Eloquent モデル
    $reagents = Reagent::find($request->id);
    $reagents->reagent_name = $request->reagent_name;
    $reagents->reagent_number = $request->reagent_number;
    $reagents->reagent_capcity  = $request->reagent_capcity;
    $reagents->reagent_barcode  = $request->reagent_barcode;
    $reagents->reagent_epuipment  = $request->reagent_epuipment;
    $reagents->reagent_correspondence  = $request->reagent_correspondence;
    $reagents->reagent_storage  = $request->reagent_storage;
    // $reagents->reagent_document  = $request->reagent_document = 'storage/' .$pdf_name;
    if ($reagents->reagent_document !== null) {
           $reagents->reagent_document = $reagents->reagent_document;
    }       
    $reagents->published = '2017-03-07 00:00:00';
    $reagents->update(); 
    return redirect('/');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reagent $reagent)
    {
        $reagent->delete();       //追加
        return redirect('/');  //追加
    }
}
