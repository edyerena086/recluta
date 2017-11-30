<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Illuminate\Http\Request;
use ReclutaTI\User;
use ReclutaTI\Candidate;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Account\CreateRequest;

class AccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * [store description]
	 * @param  CreateRequest $request data send from the user
	 *                                nombre
	 *                                correoElectronico
	 *                                password
	 * @return json
	 */
    public function store(CreateRequest $request)
    {
    	$response = [
    		'status' => false,
    		'message' => 'No se ha podido crear tu cuenta.'
    	];

    	//New user
    	$user = new User();
    	$user->name = $request->nombre;
    	$user->email = $request->correoElectronico;
    	$user->password = bcrypt($request->password);
    	$user->user_group_id = 1;

    	if ($user->save()) {
    		$candidate = new Candidate();
    		$candidate->user_id = $user->id;
    		if ($request->has('apellidoPaterno')) $candidate->last_name = $request->apellidoPaterno;

    		if ($candidate->save()) {
    			$response = [
    				'status' => true
    			];
    		}  else {
    			$user->delet();
    		}
    	}

    	return response()->json($response);
    }
}
