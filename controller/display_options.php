<?php
/**
 * User: budiartoa
 * Date: 16/03/12
 * Time: 10:47 AM
 * @copyright Copyright © Luxbet Pty Ltd. All rights reserved. http://www.luxbet.com/
 * @license http://www.opensource.org/licenses/BSD-3-Clause
 */

/**
 * Created by JetBrains PhpStorm.
 * User: budiartoa
 * Date: 16/03/12
 * Time: 10:47 AM
 * To change this template use File | Settings | File Templates.
 */

class MakeItStaticDisplayOptions {
	private $view_dir;
	private $settings_group_name;

	public function __construct($settings_group_name) {
		$this->view_dir = plugin_dir_path(__FILE__) . "../view/"; //instantiate the view directory for later use
		$this->settings_group_name = $settings_group_name;

		//init all the requried fields here we need to do this as a hook after the admin finished initializing
		add_action('admin_init', array($this, 'display_options_init'));
	}

	public function display_options_init() {
		$this->create_text_option(
			"main_static_folder_path_validate",
			"make_it_static_section_directory",
			"Main static directory setup",
			"display_options_section_directory",
			"make_it_static_fs_directory",
			"fs_static_directory",
			"Physical static directory"
		);

		$this->create_text_option(
			"main_static_folder_path_validate",
			"make_it_static_section_webserver",
			"Main static web server address",
			"display_options_section_webserver",
			"make_it_static_ws_directory",
			"ws_static_directory",
			"Web server address"
		);

		$this->create_text_option(
			"main_static_folder_path_validate",
			"make_it_static_section_img_path",
			"Main static Image Path",
			"display_options_section_imagepath",
			"make_it_static_original_imagepath",
			"original_imagepath",
			"Original Image path"
		);

		$this->create_text_option(
			"main_static_folder_path_validate",
			"make_it_static_section_img_path",
			"Main static Image Path",
			"display_options_section_imagepath",
			"make_it_static_target_imagepath",
			"target_imagepath",
			"Target Image path"
		);

		$this->create_text_option(
			"main_static_folder_path_validate",
			"make_it_static_section_callback",
			"After Creation Callback URL",
			"display_options_section_callback",
			"make_it_static_callback_url",
			"callback_url",
			"Callback URL"
		);
	}

	public function create_text_option($validation_callback, $section_id, $section_title, $section_description_callback, $current_settings_field_id,  $current_settings_field_name, $title) {
		//before we begin we need to register the settings, the option name is the table field, wordpress save it this way
		//since we want to save all the options in json format in one field, we constant this
		register_setting($this->settings_group_name, MakeItStatic::CONFIG_TABLE_FIELD, array($this, $validation_callback));

		//this settings section call back the display controller's display_options_section_directory function which calls the appropriate view
		add_settings_section($section_id, $section_title, array($this, $section_description_callback), 'make_it_static_plugin');

		//setup the actual input field, this is for the static file system directory in the publishing server
		add_settings_field($current_settings_field_id, $title, array($this,'display_input_field'), 'make_it_static_plugin', $section_id, array("field_name" => $current_settings_field_name, "field_id" => $current_settings_field_id));
	}

	public function display_options() {
		//include the template file
		$settings_group_name = $this->settings_group_name;
		include_once($this->view_dir . "plugin_settings.php");
	}

	public function display_options_section_directory() {
		include_once($this->view_dir . "plugin_settings_section_directory.php");
	}

	public function display_options_section_webserver() {
		include_once($this->view_dir . "plugin_settings_section_webserver.php");
	}

	public function display_options_section_imagepath() {
		include_once($this->view_dir . "plugin_settings_section_imagepath.php");
	}

	public function display_options_section_callback() {
		include_once($this->view_dir . "plugin_settings_section_callback.php");
	}

	public function display_input_field($field_args) {

		$current_settings_field_id = $field_args["field_id"];
		$current_settings_field_name = $field_args["field_name"];
		include($this->view_dir . "plugin_settings_input_field.php");
	}

	public function main_static_folder_path_validate($input) {
		return $input;
	}
}