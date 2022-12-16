<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Orders;
use JWTAuth;
use Namshi\JOSE\SimpleJWS;

class OrderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = JWTAuth::parseToken()->authenticate();
       
        $query = Orders::query();
        if ($user->is_admin==0){
            $query = $query->where('email', $user->email);
        }
        $orders = $query->paginate(15);
        return response()->json($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        

        $validator = Validator::make($request->all(), [
            
            'email' => 'required|string|email',
            'number_phone' => 'required|string',
            'customer_name' => 'required|string',
            'address' => 'required|string',
            'items' => 'required|array',
            'price' => 'required|int',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }


        // $secret = config('jwt.secret');
        // $jws = SimpleJWS::load($token);
        // if (!$jws->isValid($secret)) {
        //     return response()->json([], 401); // unauthorized
        // }else {

        //     $user = $this->jwt->User();
            $user = JWTAuth::parseToken()->authenticate();
            if ($user){
                $request['customer_id']= $user->_id;
                $request['customer_name']= $user->name;
            }
        // }
       
        $request['code']=Str::random(10);
        $request['status'] = 0;
        $orders = Orders::create($request->toArray());
        return response()->json($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->is_admin==0){
            $order = Orders::where('_id','=', $id)->where('email','=', $user->email)->get();
            if ($order){
                return response()->json($order);
            }else {
                return response()->json([
                    'message' => "You don't have permission",
                ]);
            }
        }else {
            $order = Orders::where('_id','=', $id)->get();
            return response()->json($order);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->is_admin ==1){

            $validator = Validator::make($request->all(), [
                'status' => 'required|int',
            ]);
            if ($validator->fails())
            {
                return response(['errors'=>$validator->errors()->all()], 422);
            }
    
            $order = Orders::where('_id','=', $id);
            $order->update(['status' => $request->get('status')]);
            return response()->json($order->get());
        }else {
            return response()->json([
                'message' => "You don't have permission",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::where('_id','=', $id);
        $order->delete();
        return response()->json(['message'=>'DELETE_SUSSECCFULLY'], status:200);
    }
}
