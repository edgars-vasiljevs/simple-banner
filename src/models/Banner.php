<?php namespace Simple\Banner;

use Monolog\Formatter;
use Config;
use Image;
use Input;
use File;
use Simple\Cms\MultiOutput;
use Whoops\Example\Exception;
use Simple\Cms\Multi;
use Simple\Cms\Language;
use Eloquent;

class Banner extends Eloquent {

	/**
	 * Table
	 */
	protected $table = 'banners';

	/**
	 * STATUSES
	 */
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;

	/**
	 * Redirect types
	 */
	const REDIRECT_URL = 1;
	const REDIRECT_PAGE = 2;

	const FIELD_TYPE_IMAGE = 'image';
	const FIELD_TYPE_MULTI = 'multi';
	const FIELD_TYPE_REDIRECT = 'redirect';


	const REDIRECT_TYPE_URL = 1;
	const REDIRECT_TYPE_PAGE = 2;

	/**
	 * Multi fields
	 */
	public static $multi = array();

	/**
	 * Fillable fields
	 */
	protected $fillable = array('section', 'fields');


	/**
	 * Fields
	 * @var array
	 */
	protected static $fields = array();


	/**
	 * Override default constructor
	 * @param array $attributes
	 */
	public function __construct(array $attributes = array()) {

		// add fillable fields
		if (!empty($attributes)) {

			$fields = Config::get('banner::default.sections.' . $attributes['section'] . '.fields');

			foreach($fields as $name => $field) {
				$this->fillable[] = $name;
				if ($field['type'] == self::FIELD_TYPE_MULTI) {
					self::$multi[] = $name;
				}
			}

		}

		$attributes = Multi::convertedAttributes($attributes, self::$multi);

		parent::__construct($attributes);

	}


	/**
	 * Convert fields variable
	 *
	 * @param string $attr
	 * @return mixed|\Simple\Cms\MultiOutput
	 */
	public function __get($attr) {

		$string = $this->getAttribute($attr);

		if ($attr == 'fields' && is_string($string) && is_object( json_decode($string) )) {
			return new MultiOutput( json_decode($string) );
		}

		return parent::__get($attr);

	}


	/**
	 * Convert multi fields to fields before updating
	 *
	 * @param array $attributes
	 *
	 * @return mixed
	 */
	public function update(array $attributes = array()) {

		// add fillable fields
		if (!empty($attributes)) {

			$fields = Config::get('banner::default.sections.' . $attributes['section'] . '.fields');

			foreach($fields as $name => $field) {
				$this->fillable[] = $name;
				if ($field['type'] == self::FIELD_TYPE_MULTI) {
					self::$multi[] = $name;
				}
			}

		}

		$attributes = Multi::convertedAttributes($attributes, self::$multi);

		return parent::update($attributes);

	}


	/**
	 * Upload or delete image
	 *
	 * @param array $options
	 *
	 * @return bool
	 */
	public function save(array $options = array()) {

		self::$fields = Config::get('banner::default.sections.' . $this->section . '.fields');

		if (!isset($fields)) {
			$this->fields = new \stdClass();
		}

		// update image fields
		foreach(self::$fields as $name => $field) {

			\FB::log( $name , isset($this->{$name}), $field);

			if ($field['type'] == self::FIELD_TYPE_IMAGE && isset($this->{$name})) {

				$this->updateImage($name);
			}

			if ($field['type'] == self::FIELD_TYPE_MULTI) {
				$this->updateMulti($name);
			}

			if ($field['type'] == self::FIELD_TYPE_REDIRECT) {
				$this->updateRedirect($name);
			}

		}

		$this->fields = json_encode($this->fields, TRUE);




		return parent::save($options);

	}


	/**
	 * Delete or create image
	 * @param $name
	 */
	private function updateImage($name) {

		// Delete image
		if (Input::get($name) == '' && $this->exists) {

			$image = self::find($this->id)->first();

			File::delete( public_path() . '/uploads/banners/' . $image->fields->{$name} );

			$this->fields->{$name} = '';

		}

		if (Input::get($name) != '' && $this->exists) {
			$this->fields->{$name} = Input::get($name);
		}

		// Upload image
		if (Input::file($name)) {

			$file = Input::file($name);
			$output =  Image::make($file->getRealPath());
			$uploadDir = public_path() . '/uploads/banners/';

			$options = Config::get('banner::default.sections.' . $this->section . '.fields.' . $name);

			$output->grab($options['width'], $options['height']);

			$this->fields->{$name} = md5(microtime() . $file->getClientOriginalName()) . '.jpg';

			$output->save($uploadDir . $this->fields->{$name}, 70);

		}

		unset($this->{$name});

	}


	/**
	 * Convert multi fields
	 */
	public function updateMulti($name) {

		$return = array();
		foreach (Language::$languages as $lang) {

			$return[$lang->code] = isset($this->{$name}[$lang->code])
				? $this->{$name}[$lang->code]
				: NULL;

		}

		unset($this->{$name});

		$this->fields->{$name} = $return;

	}

	/**
	 * Set redirect
	 * @param $name
	 */
	public function updateRedirect($name) {

		$this->fields->{$name} = $this->{$name};

		unset($this->{$name});

	}



}