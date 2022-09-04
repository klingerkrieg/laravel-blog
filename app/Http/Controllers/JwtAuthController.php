<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JwtAuthController extends Controller{
    

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    protected function validLogin(array $data) {
        $rules = ['email'             => ['required'],
                  'password'          => ['required']];

        return Validator::make($data, $rules);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {

        
        $validator = $this->validLogin($request->all());
        
        if ($validator->fails()){
            return response()->json(["error"=>1, "validation"=>1, "message"=>$validator->getMessageBag()]);
        } else {
            $credentials = $request->only(['email', 'password']);
            if (! $token = $this->guard()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'error'=>0,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }



    protected function validator(array $data) {
        $rules = ['name'              => ['required', 'string', 'max:255'],
                  'email'             => ['required', 'string', 'email', 
                                        'max:255', 'confirmed', 
                                        Rule::unique('users','email')],
                  'password'          => ['required', 'string', 'min:6', 'confirmed'],
                ];

        return Validator::make($data, $rules);
    }

    public function register(Request $request){
        $data = $request->all();
        $data['email'] = strtolower($data['email']);
        $data['email_confirmation'] = strtolower($data['email_confirmation']);

        $validator = $this->validator($data);

        if ($validator->fails()){
            return response()->json(["error"=>1, "validation"=>1, "message"=>$validator->getMessageBag()]);
        } else {

            $data['password'] = Hash::make($data['password']);
            $obj = User::create($data);
            
            return response()->json(["error"=>0, "message"=>"Data saved.", "id"=>$obj->id]);
        }
    }


    
    protected function guard(){
        return Auth::guard('api');
    }

}
