<?php

use Imagine\Image\ImageInterface;
use Imagine\Image\Box;

Image::filter('uploader',array(
	'width' => 600,
	'height' => 600,
	'crop' => true
));