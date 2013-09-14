<?php namespace Simple\Banner;


use Simple\Cms\BaseController;
use View;
use Input;
use Exception;
use Redirect;
use Config;
use File;
use Simple\Cms\Page;


class AdminController extends BaseController {

	/**
	 * Layout
	 */
	protected $layout = 'cms::template';

	/**
	 * Banner list
	 */
	public function getIndex($section = NULL) {



		if (is_null($section)) {

			$section = Config::get('banner::default.sections');
			$section = array_shift($section);
			$section = $section['name'];

		}

		$view = View::make('banner::list');
		$view->banners = Banner::where('section', '=', $section)->get();
		$view->sections = Config::get('banner::default.sections');
		$view->fields =  Config::get('banner::default.sections.' . $section . '.fields');
		$view->active_section = $section;

		$this->layout->content = $view;

	}

	/**
	 * Add new banner
	 */
	public function getNew($section = null) {

		if ($section == null) {

			$view = View::make('banner::sections');
			$view->sections = Config::get('banner::default.sections');
			$view->section_name = $section;
		}
		else {
			$view = View::make('banner::add');
			$view->banners = array();
			$view->sections = Config::get('banner::default.sections');
			$view->tree = Page::$tree;
			$view->fields =  Config::get('banner::default.sections.' . $section . '.fields');
			$view->section = Config::get('banner::default.sections.' . $section);
			$view->section_name = $section;


		}

		$this->layout->content = $view;


	}

	/**
	 * Edit banner
	 */
	public function getEdit($banner_id) {

		$banner = Banner::find($banner_id);

		if (is_null($banner)) {
			throw new Exception('Banner not found');
		}

		$view = View::make('banner::add');

		$view->banner = $banner;


		$view->sections = Config::get('banner::default.sections');
		$view->tree = Page::$tree;
		$view->section = Config::get('banner::default.sections.' . $banner->section);
		$view->fields =  Config::get('banner::default.sections.' . $banner->section . '.fields');
		$view->section_name = $banner->section;


		$this->layout->content = $view;

	}

	/**
	 * Delete banner
	 *
	 * @param $banner_id
	 * @throws Exception
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getDelete($banner_id) {

		$banner = Banner::find($banner_id);

		if (is_null($banner)) {
			throw new Exception('Banner not found');
		}

		// Delete image
		File::delete( public_path() . '/uploads/banners/' . $banner->image );

		$banner->delete();

		return Redirect::to('admin/banners')->with('deleted', TRUE);

	}

	/**
	 * Create a banner
	 */
	public function postCreate() {

		$input = Input::all();

		$validation = new Validation\Banner($input);

		if ($validation->passes()) {

			$banner = Banner::create($input);

			return Redirect::to('admin/banners/edit/' . $banner->id)->with('created', TRUE);

		}

		return Redirect::to('admin/banners/new')->withInput()->withErrors($validation->errors);


	}


	/**
	 * Update banner
	 */
	public function postUpdate($banner_id) {

		$input = Input::all();

		$validation = new Validation\Banner($input);

		$banner = Banner::find($banner_id);

		if (is_null($banner)) {
			throw new Exception('Banner not found');
		}

		if ($validation->passes()) {

			$banner->update($input);

			return Redirect::to('admin/banners/edit/' . $banner_id)->with('updated', TRUE);

		}

		return Redirect::to('admin/banners/edit/' . $banner_id)->withInput()->withErrors($validation->errors);

	}


}