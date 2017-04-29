<?php

namespace CoderStudios\Traits;

trait SetEnabledAttribute {

	/**
	 * Set enabled attribute
	 * @param  $value
	 * @return collection
	 */
	public function setEnabledAttribute($value)
	{
		if (empty($value)) {
			$this->attributes['enabled'] = 0;
		} else {
			$this->attributes['enabled'] = $value;
		}
	}

}