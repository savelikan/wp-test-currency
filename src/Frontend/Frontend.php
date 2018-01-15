<?php namespace Premmerce\NewPlugin\Frontend;

use Premmerce\NewPlugin\FileManager;

/**
 * Class Frontend
 *
 * @package Premmerce\NewPlugin\Frontend
 */
class Frontend {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;
	}

}