<?php

/**
 * Class StaticData_Tags
 */
class StaticData_Tags extends TagManager
{
	/** @var array */
	public static $tag_definitions = array(
		'staticdata:country_options' 	=> 'tag_staticdata_country_options'
	);

	/**
	 * Render select options of countries
	 *
	 * @usage	<ion:staticdata:country_options/>
	 *
	 * @param	FTL_Binding $tag
	 * @return	string
	 */
	public function tag_staticdata_country_options(FTL_Binding $tag)
	{
		$langCode = $tag->getAttribute('lang');
		if( empty($langCode) ) {
			$langCode = 'EN';
		}

		$selected = $tag->getAttribute('selected');
		if( empty($selected) ) {
			$selected = '';
		}

		return self::getCountryOptions($langCode, $selected);
	}

	/**
	 * @param	string	$langCode
	 * @return	string
	 */
	private static function getCountryOptions($langCode, $selected)
	{
		$langCode = strtoupper($langCode);
		$selected = strtoupper($selected);

		$str = '';

		// Model load
		self::load_model('staticdata_country_model', 'country_model');

		/** @var StaticData_country_model	$countryModel */
		$countryModel = self::$ci->country_model;
		$countries = $countryModel->get_list(array());

		if( empty($selected) ) {
			$preferredLanguageCode = self::get_client_preferred_language();
			$selected = substr($preferredLanguageCode, -2);
		}

		foreach($countries as $country)
		{
			// Tag expand : Process of the children tags
			$str .=
				  '<option value="' . $country['alpha2'] . '"'
				. ( $country['alpha2'] === $selected ? ' selected="selected"' : '' )
				. '>'
				. $country['lang' . $langCode ]
				. '</option>';
		}

		return $str;
	}

	/**
	 * @param bool|false $getSortedList
	 * @param bool|false $acceptedLanguages
	 * @return array|mixed
	 */
	private static function get_client_preferred_language($getSortedList = false, $acceptedLanguages = false)
	{

		if (empty($acceptedLanguages))
			$acceptedLanguages = $_SERVER["HTTP_ACCEPT_LANGUAGE"];

		// regex inspired from @GabrielAnderson on http://stackoverflow.com/questions/6038236/http-accept-language
		preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})*)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $acceptedLanguages, $lang_parse);
		$langs = $lang_parse[1];
		$ranks = $lang_parse[4];


		// (create an associative array 'language' => 'preference')
		$lang2pref = array();
		for($i=0; $i<count($langs); $i++)
			$lang2pref[$langs[$i]] = (float) (!empty($ranks[$i]) ? $ranks[$i] : 1);

		// (comparison function for uksort)
		$cmpLangs = function ($a, $b) use ($lang2pref) {
			if ($lang2pref[$a] > $lang2pref[$b])
				return -1;
			elseif ($lang2pref[$a] < $lang2pref[$b])
				return 1;
			elseif (strlen($a) > strlen($b))
				return -1;
			elseif (strlen($a) < strlen($b))
				return 1;
			else
				return 0;
		};

		// sort the languages by preferred language and by the most specific region
		uksort($lang2pref, $cmpLangs);

		if ($getSortedList)
			return $lang2pref;

		// return the first value's key
		reset($lang2pref);
		return key($lang2pref);
	}
}