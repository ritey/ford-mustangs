<?php

namespace CoderStudios\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request {

	/**
	 * Determine if the user is authorised to make this request.
	 *
	 * @return boolean
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'name' 		=> 'required|min:3',
			'email'	    => 'required|email',
			'subject'	=> 'required|min:3',
			'message'	=> 'required|min:3',
		];

		return $rules;
	}

	/**
	 * Override the default error messages.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required_without_all' 		=> 'The name field is required when postcode &amp; mobile are not present',
			'postcode.required_without_all' 	=> 'The postcode field is required when name &amp; mobile are not present',
			'mobile.required_without_all' 		=> 'The mobile field is required when postcode &amp; name are not present',
		];
	}
}