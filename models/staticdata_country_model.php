<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class StaticData_country_model
 */
class StaticData_country_model extends Base_model
{
	protected $_country_table = 'module_staticdata_country';
//	protected $_country_lang_table = 'module_staticdata_country_lang';

	/**
	 * Model Constructor
	 *
	 * @access	public
	 */
	public function __construct()
	{
		$this->set_table($this->_country_table);
//		$this->set_lang_table($this->_country_lang_table);
		$this->set_pk_name('id_country');
		
		parent::__construct();
	}

}