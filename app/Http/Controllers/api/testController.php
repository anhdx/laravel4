<?php

namespace App\Http\Controllers\api;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Rules\validateCaptcha;
class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    public function Login(Request $rq){
        if(Auth::attempt(['email'=>$rq->email,'password'=>$rq->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success'=>$success['token']],$this->successStatus);
        }else{
            return response()->json(['error'=>'Unauthorised'],401);
        }
    }
    public function getRegister(){
        return view('auth.register');
    }
    public function register(Request $rq){
        $register = $rq->all();
        $validate = [
            'name'                    => 'required',
            'email'                   => 'required|email',
            'password'                => 'required',
            'cf_password'             => 'required|same:password',
            'g-recaptcha-response'    => ['required', new \App\Rules\validateCaptcha]
        ];
        $validator = Validator::make($register,$validate);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);

        }
        $register['password'] = Hash::make($register['password']);
        $user = user::create($register);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success'=>$success,],$this->successStatus);
    }
    public function details(){

        $user = Auth::user();
       //return status code with endcode uft-8 and content
        return response()->json(['success'=>$user],$this->successStatus);
    }
    public function index()
    {
        $data = user::all();
        $h = json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        return $h;
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
    public function store(Request $rq){
        // $data = new products([
        //     'name'              =>$rq->name,
        //     'description'       =>$rq->description,
        //     'unit_price'        =>$rq->unit_price,
        //     'promotion_price'   =>$rq->promotion_price,
        //     'image'             =>$rq->image,
        //     'unit'              =>$rq->unit

        // ]);
        
        // $data->save();
        $data = new user();
        $data->name = $rq->name;
        $data->save();
      
       return redirect()->back();
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
    public function edit($id)
    {
        $data = user::findOrFail($id);
        $json = json_encode($data,JSON_UNESCAPED_UNICODE);
        return   response($json, 200)
              ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $rq, $id)
    {
        // $data = products::findOrFail($id);
        // $data->name = $rq->name;
        // $data->description = $rq->description;
        // $data->unit_price = $rq->unit_price;
        // $data->promotion_price = $rq->promotion_price;
        // $data->image = $rq->image;
        // $data->unit = $rq->unit;
        // $data->save();
      
        return redirect()->back()->with('success','Your infor updated!');//tra ve flash messages voi session la success noi dung la sau dau phay 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = products::findOrFail($id);
        $data->delete();
        return response()->json('success');
    }
}
