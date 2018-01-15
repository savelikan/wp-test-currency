<?php namespace Premmerce\NewPlugin\Admin;

use Premmerce\NewPlugin\FileManager;

/**
 * Class Admin
 *
 * @package Premmerce\NewPlugin\Admin
 */
class Admin {

	/**
	 * @var FileManager
	 */
	private $fileManager;
	public $currencyTable = '';
	public $currencyPageURL = '';

	/**
	 * Admin constructor.
	 *
	 * Register menu items and handlers
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->currencyTable = $this->wpdb->prefix . 'currencies';
        $this->currencyPageURL = get_site_url().'/wp-admin/admin.php?page=edit-currencies';

		$this->fileManager = $fileManager;

        add_action( 'admin_menu', function(){
            add_menu_page( __('Plugin page title','premmerce-new'),
                __('Edit currencies','premmerce-new'),
                'manage_options',
                'edit-currencies',
                [$this, 'edit_currencies'],
                'dashicons-dashboard'
            );
        });
	}


    public function edit_currencies(){
	    switch($_GET['act']){

            case 'create':
                $this->CreateCurrency();
                break;

            case 'delete':
                $this->DeleteCurrency();
                break;

            case 'edit':
                $this->EditCurrency();
                break;

            default:
                $this->listCurrencies();
                break;

        }
    }

    public function CreateCurrency(){
        if(isset($_POST['save'])){
            $this->wpdb->insert(
                $this->currencyTable,
                array(
                    'name' => $_POST['name'],
                    'symbol' => $_POST['symbol'],
                    'rate' => $_POST['rate'],
                )
            );
            echo __('Created','premmerce-new');
            echo '<p><a href="'.$this->currencyPageURL.'">'.__('Go back','premmerce-new').'</a></p>';
            return;
        }
        $this->fileManager->includeTemplate(
            'admin/create_currencies.php',
            [
                'CurrenciesList' => $CurrenciesList
            ]
        );
    }

    public function listCurrencies(){
        $CurrenciesList = $this->wpdb->get_results('SELECT * FROM ' . $this->currencyTable);
        $this->fileManager->includeTemplate(
            'admin/list_currencies.php',
            [
                'CurrenciesList' => $CurrenciesList
            ]
        );
    }


    public function DeleteCurrency(){
        $result = $this->wpdb->delete(
            $this->currencyTable,
            [
                'id' => ceil($_GET['id'])
            ]
        );
        if($result == 1){
            echo __('Deleted','premmerce-new');
        } else {
            echo __('Error query to db','premmerce-new');
        }
        echo '<p><a href="'.$this->currencyPageURL.'">'.__('Go back','premmerce-new').'</a></p>';
    }

    public function EditCurrency(){
        if(isset($_GET['id']) and !empty($_GET['id'])){
            if(isset($_POST['update'])){
                $this->wpdb->update(
                    $this->currencyTable,
                    [
                        'name'=>$_POST['name'],
                        'symbol'=>$_POST['symbol'],
                        'rate'=>$_POST['rate'],
                    ],
                    [
                        'id' => $_GET['id']
                    ]
                );
                echo __('Changed','premmerce-new');
                echo '<p><a href="'.$this->currencyPageURL.'">'.__('Go back','premmerce-new').'</a></p>';
                return;
            }
            $Currency = $this->wpdb->get_results('SELECT * FROM ' . $this->currencyTable . ' WHERE `id` = ' . ceil($_GET['id']));
            $this->fileManager->includeTemplate(
                'admin/edit_currencies.php',
                [
                    'Currency' => array_shift($Currency)
                ]
            );
        } else {
            echo __('Course not found','premmerce-new');
            echo '<p><a href="'.$this->currencyPageURL.'">'.__('Go back','premmerce-new').'</a></p>';
        }
    }




}