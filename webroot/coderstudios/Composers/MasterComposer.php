<?php

namespace CoderStudios\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Session;
use Auth;

class MasterComposer {

    /*
    |--------------------------------------------------------------------------
    | Admin Master Composer Class
    |--------------------------------------------------------------------------
    |
    | Loads variables for the master layout in one place
    |
    */

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function compose(View $view)
	{
        $view->with('user', Auth::user());
		$view->with('success_message', Session::pull('success_message'));
		$view->with('error_message', Session::pull('error_message'));
		$view->with('csrf_error', Session::pull('csrf_error'));
        $view->with('auth_error', Session::pull('auth_error'));
        $view->with('request', $this->request);
	}
}