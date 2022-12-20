<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Drug;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $array_cat= [];
        $query = Category::query();
        $query->where('num_products','>',0);
        $cat_parent = $query->get();
        foreach($cat_parent as $cat){
            $cat_childen= Category::where('parent',$cat->cat_id)->get();
            $array_cat[]= array(
                'cat_parent'=> $cat,
                'cat_childen'=>$cat_childen
            );
        }
        return response()->json($array_cat);

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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
        

    public function queueCat($cat_id){
        $dummyQueue = new \SplQueue();
        $dummyQueue->enqueue($cat_id);
        $dummyQueue->rewind();
        while($dummyQueue->valid()){
            $queryCategory = Category::query();
            $queryCategory->where('parent',$dummyQueue->current());
            $categories = $queryCategory->get();
            foreach($categories as $cat){
                $dummyQueue->enqueue($cat->cat_id);
            }
            $dummyQueue->next();
        }

        return $dummyQueue;
    }


    public function show($cat_id){
        $query = Drug::query();
        $query->where('productType_id', $cat_id);
      
        $dummyQueue =$this->queueCat($cat_id);
        $dummyQueue->rewind();
        while($dummyQueue->valid()){
            $query->orWhere('productType_id', $dummyQueue->current());
            $dummyQueue->next();
        }
        $total = $query->count();
        $drug = $query->paginate(15);
        return response()->json(['total'=>$total, 'data'=>$drug]);

        // return response()->json($category);
        // $queryCategory = Category::query();
        // $category= $queryCategory->where('cat_id','=',$cat_id)->get();
        // return response()->json($category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
