<?php

namespace App\Http\Controllers;


//////////////////////////////
use Auth;
use App\Http\Requests;
use Request;
use App\Opros;
use App\Http\Requests\OprosRequest;


class OprosController extends Controller
{
    public function index() {

    	return  view('opros.index' , [ ]);   
   

    }

	public function reply(Requests\OprosRequest $request) {

		 if  (!Auth::check()) {
         	return ('false');   
        
        }

		$opros = new Opros($request->all());
		//return($request);


		//$opros = Opros::OrderBy('id')->get();   
		

        $result = $opros->save();   

        return ($opros);

	}

	public function result() {
		$opros = Opros::OrderBy('id')->get(); 
		return($opros);
	}
}
