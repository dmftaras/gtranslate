<?php

/**
 * author: dmftaras
 * dmftaras.com
 * dmftaras@gmail.com
**/

class GTranslate
{
	/* Supported languages
		"en" English         || "uk" Ukrainian  || "auto" Auto     || "az" Azerbaijani
		"sq" Albanian        || "en" English    || "ar" Arabic     || "af" Afrikaans
		"eu" Basque          || "bn" Bengali    || "be" Belarusian || "bg" Bulgarian
		"bs" Bosnian         || "vi" Vietnamese || "cy" Welsh      || "hy" Armenian
		"ht" Haitian Creole  || "hi" Hindi      || "nl" Dutch      || "el" Greek
		"ka" Georgian        || "gl" Galician   || "gu" Gujarati   || "da" Danish
		"eo" Esperanto       || "et" Estonian   || "iw" Hebrew     || "yi" Yiddish
		"id" Indonesian      || "ga" Irish      || "is" Icelandic  || "es" Spanish
		"it" Italian         || "km" cambodian  || "kn" Kannada    || "ca" Catalan
		"zh-CN" Chinese      || "ko" Korean     || "lo" Lao        || "la" Latin
		"lv" Latvian         || "lt" Lithuanian || "mk" Macedonian || "ms" Malay
		"mt" Maltese         || "mr" Marathi    || "de" German     || "no" Norwegian
		"fa" Persian         || "pl" Polish     || "pt" Portuguese || "ru" russian
		"ro" Romanian        || "ceb" Sebuano   || "sr" Serbian    || "sk" Slovak
		"sl" Slovenian       || "sw" Swahili    || "th" Thai       || "ta" Tamil
		"te" Telugu          || "tr" Turkish    || "hu" Hungarian  || "uk" Ukrainian
		"ur" Urdu            || "tl" Filipino   || "fi" Finnish    || "fr" French
		"hmn" Hmong          || "hr" Croatian   || "cs" Czech      || "sv" Swedish
		"jw" Javanese        || "ja" Japanese
	*/
	private $base_url = 'http://translate.google.com/translate_a/t'; // don't touch this
	public  $input_lang = 'en'; //default input language
	public  $output_lang = 'uk'; //default output language

	public function SetInLang($val)
	{
		$this->input_lang = $val; //set input language
	}

	public function SetOutLang($val)
	{
		$this->output_lang = $val; //set output language
	}

	public function translate($text)
	{
		$query = array(
				'client' => 't',
				'sl'     => $this->input_lang,
				'tl'     => $this->output_lang,
				'hl'     => $this->output_lang,
				'sc'     => 2,
				'ie'     => 'UTF-8',
				'oe'     => 'UTF-8',
				'swap'   => 1,
				'oc'     => 2,
				'prev'   => 'conf',
				'pls'    => $this->input_lang,
				'pts'    => $this->output_lang,
				'otf'    => 1,
				'it'     => 'sel.'.rand(),
				'ssel'   => strlen($text),
				'tsel'   => strlen($text)

			);
		$url = $this->base_url.'?'.http_build_query($query);		
		$response = explode('"',$this->fetchResponse($url,$text));  //Get only translated information, without any suggestions
		return $response[1];
	}

	public function fetchResponse($url,$text)
	{
		if( $curl = curl_init() ) 
		{
		    curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, "q=$text");
		    $out = curl_exec($curl);
		    return $out;
		    curl_close($curl);
		}
		exit("curl isn't installed");
	}

}

?>