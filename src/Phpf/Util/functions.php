<?php
/**
 * @package Phpf.Util
 * @subpackage functions
 */

use Phpf\Util\Http;
use Phpf\Util\Str;
use Phpf\Util\Security;
use Phpf\Util\Arr;

function session(){
	return \Phpf\Util\Session::instance();
}

function session_set( $var, $val ){
	return \Phpf\Util\Session::instance()->set($var, $val);
}

function session_get( $var = '' ){
	return \Phpf\Util\Session::instance()->get($var);	
}	

/** ==============================
		Request Headers
=============================== */

/** 
* Returns HTTP request headers as array.
*/
function get_request_headers(){
	return Http::requestHeaders();
}
	
/**
* Returns a single HTTP request header if set.
*/
function get_request_header( $name ){
	return Http::requestHeader($name);
}

/** ======================
		Strings
======================= */

/**
 * Converts a string to a PEAR-like class name. (e.g. "View_Template_Controller")
 */
function str_pearclass( $str ){
	return Str::pearClass($str);
}

/**
 * Converts a string to "snake_case"
 */
function str_snakecase( $str ){
	return Str::snakeCase($str);
}

/**
 * Converts a string to "StudlyCaps"
 */
function str_studlycaps( $str ){
	return Str::studlyCaps($str);
}

/**
 * Converts a string to "camelCase"
 */
function str_camelcase( $str ){
	return Str::camelCase($str);
}

/**
 * Escape a string using fairly aggressive rules.
 * Strips all tags and converts to html entities.
 * 
 * @param string $string The string to sanitize.
 * @param bool $encode Whether to encode or strip high & low ASCII chars. (default: false = strip)
 * @return string Sanitized string.
 */
function str_esc( $string, $flag = Str::ESC_STRIP ){
	return Str::esc($string, $flag);
}

/**
 * Strips non-alphanumeric characters from a string.
 * Add characters to $extras to preserve those as well.
 * Extra chars should be escaped for use in preg_*() functions.
 */
function str_esc_alnum( $str, array $extras = null ){
	return Str::escAlnum($str, $extras);
}

/**
 * Escapes text for SQL LIKE special characters % and _.
 *
 * @param string $text The text to be escaped.
 * @return string text, safe for inclusion in LIKE query.
 */
function str_esc_sql_like( $string ) {
	return Str::escSqlLike($string);
}

/**
 * Formats a phone number based on string lenth.
 */
function phone_format( $phone ){
	return Str::formatPhone($phone);
}

/**
 * Formats a hash/digest based on string length.
 */
function hash_format( $hash ){
	return Str::formatHash($hash);
}

/**
 * Formats a string by injecting non-numeric characters into 
 * the string in the positions they appear in the template.
 *
 * @param string $string The string to format
 * @param string $template String format to apply
 * @return string Formatted string.
 */
function str_format( $string, $template ){
	return Str::format($string, $template);
}

/**
* Generate a random string from one of several of character pools.
*
* @param int $length Length of the returned random string (default 16)
* @param string $type The type of characters to use to generate string.
* @return string A random string
*/
function str_rand( $length = 16, $pool_type = 'alnum' ){
	return Str::rand($length, $pool_type);
}

/**
 * Serialize data, if needed.
 *
 * @param mixed $data Data that might be serialized.
 * @return mixed A scalar data
 */
function maybe_serialize( $data ) {
	return Str::maybeSerialize($data);
}

/**
 * Unserialize value only if it was serialized.
 *
 * @param string $value Maybe unserialized original, if is needed.
 * @return mixed Unserialized data can be any type.
 */
function maybe_unserialize( $value ) {
	return Str::maybeUnserialize($value);
}

/**
 * Check value to find if it was serialized.
 *
 * @param mixed $data Value to check to see if was serialized.
 * @param bool $strict Optional. Whether to be strict about the end of the string. Defaults true.
 * @return bool False if not serialized and true if it was.
 */
function is_serialized( $data, $strict = true ) {
	return Str::isSerialized($data, $strict);
}

/**
 * Generates a random string with given number of bytes.
 * If $strong = true (default), must use one of:
 * 		openssl_random_pseudo_bytes() PHP >= 5.3.4
 * 		mcrypt_create_iv() PHP >= 5.3.7
 * 		/dev/urandom
 */
function rand_bytes( $length = 12, $strong = true ){
	return Str::randBytes($length, $strong);
}

/**
 * Generates a verifiable token from seed.
 */
function generate_token( $seed, $algo = Security::DEFAULT_HASH_ALGO ){
	return Security::generateToken($seed, $algo);
}

/**
 * Verifies a token using seed.
 */
function verify_token( $token, $seed, $algo = Security::DEFAULT_HASH_ALGO ){
	return Security::verifyToken($token, $seed, $algo);
}

/**
 * Generate a UUID
 * 32 characters (a-f and 0-9) in format 8-4-4-12.
 */
function generate_uuid(){
	return Security::generateUuid();
}

/**
 * Generates a 32-byte base64-encoded random string.
 */
function generate_csrf_token(){
    return Security::generateCsrfToken();
}

/** ====================
		Arrays
===================== */

/**
* Retrieves a value from $array given its path in dot notation
*/
function array_get( array &$array, $dotpath ) {
	return Arr::dotGet($array, $dotpath);
}

/**
* Sets a value in $array given its path in dot notation.
*/
function array_set( array &$array, $dotpath, $value ){
	return Arr::dotSet($array, $dotpath, $value);
}

/**
 * Merge user defined arguments into defaults array.
 *
 * @param string|array $args Value to merge with $defaults
 * @param array $defaults Array that serves as the defaults.
 * @return array Merged user defined values with defaults.
 */
function parse_args( $args, $defaults = '' ) {
	return Arr::parse($args, $defaults);
}

/**
 * Filters a list of objects, based on a set of key => value arguments.
 *
 * @param array $list An array of objects to filter
 * @param array $args An array of key => value arguments to match against each object
 * @param string $operator The logical operation to perform:
 *    'AND' means all elements from the array must match;
 *    'OR' means only one element needs to match;
 *    'NOT' means no elements may match.
 *   The default is 'AND'.
 * @return array
 */
function list_filter( $list, $args = array(), $operator = 'AND', $keys_exist_only = false ) {
	return Arr::filter($list, $args, $operator, $keys_exist_only);
}

/**
 * Pluck a certain field out of each object in a list.
 *
 * @param array $list A list of objects or arrays
 * @param int|string $field A field from the object to place instead of the entire object
 * @return array
 */
function list_pluck( $list, $field ) {
	return Arr::pluck($list, $field);
}

/**
 * Pluck a certain field out of each object in a list by reference.
 * This will change the values of the original array/object list.
 *
 * @param array $list A list of objects or arrays
 * @param int|string $field A field from the object to place instead of the entire object
 * @return array
 */
function list_pluck_ref( &$list, $field ){
	return Arr::pluckRef($list, $field);
}
