<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // return Drug::paginate(15);
       
        $product_name = $request->get('search');
        $arrange = $request->get('arrange');
        $brand = $request->get('brand');
        $query = Drug::query();
        // $total = Drug::count();
        // $drug = Drug::all();
       
        if ($arrange=='asc'){
            $query->orderBy('price', 'asc')->distinct('product_id');
        }
        if ($arrange=='desc'){
            $query->orderBy('price', 'desc')->distinct('product_id');
        }
        if ($product_name){
           $query->where('product_name','LIKE', "%{$product_name}%");
        }

        if ($brand){
            $query->where('brand',$brand);
        }
        $total = $query->count();
        $drug = $query->paginate(15);

        return response()->json(['total'=>$total, 'data'=>$drug]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function show($product_id){
        // echo $product_id;
        $drug = Drug::where('product_id','=', $product_id)->get();
        return response()->json($drug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function edit(Drug $drug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drug $drug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drug  $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        //
    }
}
