<?php namespace Premmerce\NewPlugin;

use Premmerce\NewPlugin\Admin\Admin;
use Premmerce\NewPlugin\Frontend\Frontend;

/**
 * Class NewPluginPlugin
 *
 * @package Premmerce\NewPlugin
 */
class NewPluginPlugin {

    public $tableName = '';
    public $wpdb = '';

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * PluginManager constructor.
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->tableName = $this->wpdb->prefix . "currencies";

		$this->fileManager = $fileManager;

        add_action('init', [ $this, 'loadTextDomain' ]);

	}

	/**
	 * Run plugin part
	 */
	public function run() {
		if ( is_admin() ) {
			new Admin( $this->fileManager );
		} else {
			new Frontend( $this->fileManager );
		}

	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain($name, false, $name . '/languages/');
    }

	/**
	 * Fired when the plugin is activated
	 */
	public function activate() {
        $sql = "CREATE TABLE " . $this->tableName . " (
          `id` bigint(11) NOT NULL AUTO_INCREMENT,
          `name` tinytext NOT NULL,
          `symbol` VARCHAR(1) DEFAULT '' NOT NULL,
          `rate` double(10,3) NOT NULL,
          PRIMARY KEY id (id)
        )";
        $this->wpdb->query($sql);
    }

	/**
	 * Fired when the plugin is deactivated
	 */
	public function deactivate() {

	}

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
	    global $wpdb;
        $wpdb->query( 'DROP TABLE IF EXISTS ' . $this->tableName );
	}
}