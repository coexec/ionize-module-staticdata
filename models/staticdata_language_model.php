<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class StaticData_language_model
 */
class StaticData_language_model extends Base_model
{
	protected $_country_table = 'module_staticdata_language';
//	protected $_country_lang_table = 'module_staticdata_language_lang';

	/**
	 * Model Constructor
	 *
	 * @access	public
	 */
	public function __construct()
	{
		$this->set_table($this->_language_table);
//		$this->set_lang_table($this->_country_lang_table);
		$this->set_pk_name('id_language');
		
		parent::__construct();
	}

}