<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    //O middleware guest verifica se o usuario está ou nao logado, assim, caso esteja nao deixa executar o login novamente
	public function __construct(){
		$this->middleware('guest:admin');
	}

	//função responsavel pela validação da tentativa, valida os campos de login
    public function login(Request $request){
    	$this->validate($request, [
    		'email' => 'required|string',
    		'password' => 'required|string',
    	]);

    	// credenciais de login dados
    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	//mantem a autenticação pro admimn, não pro guard padrao
    	$auth = Auth::guard('admin')->attempt($credentials,  $request->remember);

    	if ($auth) {
    		return redirect()->intended(route('admin.dashboard')); //passando a rota que queremos acessar
    	}else { 
    		return redirect()->back()->withInputs($request->only('email', 'remember'));
    	}
    }

    //função para renderizar o forulario de login do admin
    public function index(){
    	return view('adminlogin');
    }
}
