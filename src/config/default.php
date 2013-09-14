<?php

/**
 * Banner configuration
 */
return array(

	'sections' => array(
		'front' => array(
			'title' => 'Front page sliders',
			'name' => 'front',

			'fields' => array(
				'image' => array(
					'title' => 'Main image',
					'name' => 'image',
					'type' => 'image',
					'width' => 578,
					'height' => 346,
					'rules' => array(
						'image',
					),
					'cms' => array(
						'width' => 250
					)
				),
				'title' => array(
					'title' => 'Title',
					'name' => 'title',
					'type' => 'multi',
					'rules' => array(),
					'cms' => array(
						'width' => 250
					),
				),
				'description' => array(
					'title' => 'Description',
					'name' => 'description',
					'type' => 'multi',
					'rules' => array(),
					'cms' => true,
				),
				'url' => array(
					'title' => 'Redirect',
					'name' => 'url',
					'type' => 'redirect',
				),
				'button_text' => array(
					'title' => 'Button text',
					'name' => 'button_text',
					'type' => 'multi',
				),

			)
		),
		'services' => array(
			'title' => 'Service slider',
			'name' => 'services',

			'fields' => array(
				'image' => array(
					'title' => 'Main image',
					'name' => 'image',
					'type' => 'image',
					'width' => 1170,
					'height' => 424,
					'rules' => array(
						'image',
					),
					'cms' => array(
						'width' => 250
					)
				),
				'title' => array(
					'title' => 'Title',
					'name' => 'title',
					'type' => 'multi',
					'rules' => array(),
					'cms' => array(),
				),
				'title_desc' => array(
					'title' => 'Title description',
					'name' => 'title_desc',
					'type' => 'multi',
					'rules' => array(),
					'cms' => array()
				),
				'button_text' => array(
					'title' => 'Button text',
					'name' => 'button_text',
					'type' => 'multi',
					'rules' => array(),
				),
				'box_image' => array(
					'title' => 'Box image',
					'name' => 'box_image',
					'type' => 'image',
					'width' => 210,
					'height' => 210,
					'rules' => array(
						'image',
					),
				),
				'box_title' => array(
					'title' => 'Box title',
					'name' => 'box_title',
					'type' => 'multi',
					'rules' => array(),
				),
				'box_desc' => array(
					'title' => 'Box description',
					'name' => 'box_desc',
					'type' => 'multi',
					'rules' => array(),
				),
			)
		),
	),

	'providers' => array(
		'Intervention\Image\ImageServiceProvider',
	),

	'aliases' => array(
		'Image' => 'Intervention\Image\Facades\Image',
	)

);