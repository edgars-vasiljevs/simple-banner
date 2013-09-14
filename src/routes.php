<?php

Route::group(array('before' => 'isAdmin'), function () {
	Route::controller('admin/banners', 'Simple\Banner\AdminController');
});