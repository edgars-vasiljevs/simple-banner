<?php namespace Simple\Banner\Validation;

use Config;

class Banner extends \Simple\Cms\Validation\Validator {

	/**
	 * Rules
	 * @var array
	 */
	public static $rules = array();

	/**
	 * Multi fields
	 * @var array
	 */
	public static $multi = array();


	/**
	 * Override default validator constructor
	 *
	 * @param null $attributes
	 *
	 * @internal param $section
	 */
	public function __construct($attributes) {

		parent::__construct($attributes);

		$fields = Config::get('banner::default.sections.' . $attributes['section'] . '.fields');

		foreach($fields as $name => $field) {
			if ($field['type'] == 'multi') {
				self::$multi[] = $name;
			}
			if (isset($field['rules'])) {
				self::$rules[$name] = $field['rules'];
			}
		}

	}

}