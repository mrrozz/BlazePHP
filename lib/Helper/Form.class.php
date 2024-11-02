<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2024, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2024, BlazePHP.com
 * @link          http://blazePHP.com
 * @package       Blaze.
 */
namespace BlazePHP\Helper;

use BlazePHP\Globals as G;
use \BlazePHP\Debug as D;
/**
 * FormHelper
 *
 * This class is the helper that is minimally designed to use for form security and automating the
 * Blaze object intraction.  This is not like other form helpers that try to do far beyond what
 * any helper class should do.
 *
 * @author Matt Roszyk <me@mattroszyk.com>
 */
class Form
{
	public $name;
	public $method = 'post';
	public $action = null;
	public $enctype;

	private $security       = false;
	private $formValues;
	private $formHashValues = array();

	private $errors;

	const INSECURE         = 0;
	const SINGLE_USE_ONLY  = 1;
	const VERIFY_FORM_ONLY = 2;
	const SECURE           = 3;





	/**
	 * Constructor - Creates a form helper object and validates a form that has been submitted
	 *               based on the security level set.
	 *
	 * @param $security - Object constant (INSECURE, SINGLE_USE_ONLY, VERIFY_FORM_ONLY, SECURE)
	 * @param $name - The name of the form
	 * @return - void
	 */
	public function __construct($security=Form::INSECURE, $name='blazeform')
	{

		if(empty($name)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - A form must have a name'
			);
		}
		$this->name       = $name;
		$this->security   = (integer)$security;
		$this->formValues = new \stdClass();

		// \BlazePHP\Debug::printre(array(G::$request->__blaze_form_name, $this->name));
		if(G::$request->__blaze_form_name === $this->name) {

			if(G::$request->getMethod() !== strtoupper($this->method)) {
				throw new \Exception(
					__CLASS__.'::'.__FUNCTION__.' - The request method ['.$_SERVER['REQUEST_METHOD']
					.'] received does not match the type for form ['.$this->name.']'
				);
			}

			if(   in_array($this->security, array(self::SINGLE_USE_ONLY, self::SECURE))
			   && true !== self::verifyFormKey(G::$request->__blaze_form_key))
			{
				throw new \Exception(
					__CLASS__.'::'.__FUNCTION__.' - The form key submitted does not match the form'
					.' key on file for form ['.$this->name.']'
				);
			}

			if(G::$request->{$this->name}) {
				// D::printre(G::$request->{$this->name});
				$receivedHashValues = array($this->name);
				foreach(G::$request->{$this->name} as $name => $value) {
					$this->formValues->{$name} = $value;
					$receivedHashValues[] = $name;
				}

				if(in_array($this->security, array(self::VERIFY_FORM_ONLY, self::SECURE))) {
					sort($receivedHashValues);
					$receivedHash = md5(implode($receivedHashValues));
					if(true !== self::verifyFormHash($receivedHash)) {
						throw new \Exception(
							__CLASS__.'::'.__FUNCTION__.' - The form has been modified on the client side'
						);
					}
				}
			}
		}
	}





	/**
	 * updateFormHash - Updates the form hash array with the name of the form element provided
	 *
	 * @param $name - The name of the form element to be added to the hash array
	 * @return - void
	 */
	private function updateFormHash($name)
	{
		$this->formHashValues[] = $name;
		sort($this->formHashValues, SORT_STRING);
	}





	/**
	 * verifyFormHash - Verifies that the form elements hashed received are the same as
	 *                  as the one sent to the client.
	 *
	 * @param $hash
	 * @return - boolean
	 */
	private function verifyFormHash($hash)
	{
		$formHashes = G::$session->formHashes;
		if(isset($formHashes[$this->name]) && $hash === $formHashes[$this->name]) {
			unset($formHashes[$this->name]);
			return true;
		}
		return false;
	}





	/**
	 * singleUseKey - Generates the HTML input tag for the single use key
	 *
	 * @return - string
	 */
	private function singleUseKey()
	{

		$microtime = microtime();
		$formKey = md5($this->name . $microtime) . md5($microtime) . md5(serialize($GLOBALS));

		$formKeys = G::$session->formKeys;
		$formKeys[$this->name] = $formKey;
		G::$session->formKeys = $formKeys;
		G::$session->save();

		$s[] = '<input type="hidden" name="__blaze_form_key" value="';
		$s[] = $formKey;
		$s[] = '">';

		return implode($s);
	}





	/**
	 * verifyFormKey - Validates the form key and removes it from the session so it cannot
	 *                 be validated again.
	 *
	 * @param $formKey
	 * @return - boolean
	 */
	private function verifyFormKey($formKey)
	{
		// D::printre(G::$session);
		$formKeys = G::$session->formKeys;

		if(isset($formKeys[$this->name]) && $formKeys[$this->name] === $formKey) {
			unset($formKeys[$this->name]);
			G::$session->formKeys = $formKeys;
			G::$session->save();
			return true;
		}

		return false;
	}





	/**
	 * setErrors - Sets the error messages on the form elements.  This is designed to
	 *             use the errors array received from a Blaze model object's validate()
	 *             method.
	 *
	 * @param $errors - Array of errors keyed by the form element name.
	 * @param $firstOfEachOnly - Boolean switch on whether to display the first error of each
	 *                           element or all of the errors if false is provided.
	 * @return - void
	 */
	public function setErrors($errors, $firstOfEachOnly=true)
	{
		if(!is_array($errors)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The value passed to errors is not an array ['.(string)$errors.']'
			);
		}

		foreach($errors as $name => $errorList) {
			if($firstOfEachOnly === true) {
				$this->errors[$name] = $errorList[0];
			}
			else {
				$this->errors[$name] = implode("\n", $errorList);
			}
		}
	}





	/**
	 * hasError - Returns true if the form element named has an error attatched to it
	 *
	 * @param $name - Form elment name
	 * @return - boolean
	 */
	public function hasError($name)
	{
		return (isset($this->errors[$name]) && !empty($this->errors[$name]))
			? true
			: false;
	}





	/**
	 * getError - Returns the error message attached to the form element named
	 *
	 * @param $name - Form element name
	 * @return - string
	 */
	public function getError($name)
	{
		return (isset($this->errors[$name]))
			? $this->errors[$name]
			: null;
	}





	/**
	 * clear - Clears the form values
	 *
	 * @return - void
	 */
	public function clear()
	{
		$this->formValues = array();
	}





	/**
	 * populate - Populates the form values with the values of the object received.  This
	 *            is designed to work with the Blaze model object's getValues() method as
	 *            the input.
	 *
	 * @param $values - PHP stdClass object holding the form values
	 * @return - void
	 */
	public function populate(\stdClass $values)
	{
		if(!is_object($values)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - An object was not received as expected.'
			);
		}
		foreach($values as $name => $value) {
			$this->formValues->{$name} = $value;
		}
	}





	/**
	 * getValues - Returns the form values object
	 *
	 * @return - object
	 */
	public function getValues()
	{
		return $this->formValues;
	}



	public function setValue($name, $value) {
		$this->formValues->{$name} = $value;
	}





	/**
	 * open - Returns the form open tag and initializes the the form hash to be used
	 *        when validating the received input from the client.
	 *
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <form> open tag
	 * @return - string - <form> open tag
	 */
	public function open($additionalAttributes=null)
	{
		if($this->action === null) {
			$this->action = G::$request->getRequestedPath();
		}

		self::updateFormHash($this->name);

		$s = array();
		$s[] = '<form';
		$s[] = ' name="';
		$s[] = urlencode((string)$this->name);
		$s[] = '"';
		$s[] = ' action="';
		$s[] = $this->action;
		$s[] = '"';
		$s[] = ' method="';
		$s[] = (in_array(strtolower($this->method), array('get', 'post'))) ? strtolower($this->method) : 'post';
		$s[] = '"';

		switch($this->enctype) {
			case 'application':
				$s[] = ' enctype="application/x-www-form-urlencoded"';
				$s[] = ' formenctype="application/x-www-form-urlencoded"';
				break;

			case 'text':
				$s[] = ' enctype="text/plain"';
				$s[] = ' formenctype="text/plain"';
				break;

			case 'multipart':
			default;
				$s[] = ' enctype="multipart/form-data"';
				$s[] = ' formenctype="multipart/form-data"';
				break;
		}
		$s[] = (!empty($additionalAttributes)) ? ' '.$additionalAttributes : '';
		$s[] = '>';
		$s[] = '<input type="hidden" name="__blaze_form_name" value="';
		$s[] = $this->name;
		$s[] = '">';

		if(in_array($this->security, array(self::SINGLE_USE_ONLY, self::SECURE))) {
			$s[] = self::singleUseKey();
		}

		return implode($s);
	}





	/**
	 * close - Returns the closing form tag along with saving the session information that
	 *         will be used to validate the input received from the client.
	 *
	 * @return - string - </form>
	 */
	public function close()
	{
		$formHashes = G::$session->formHashes;

		if(in_array($this->security, array(self::VERIFY_FORM_ONLY, self::SINGLE_USE_ONLY, self::SECURE))) {
			$formHashes[$this->name] = md5(implode($this->formHashValues));
			G::$session->formHashes = $formHashes;
			G::$session->save();
		}

		return '</form>';
	}





	/**
	 * input - Returns the common parts of the <input> tag used by all of the other form element generators.
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $type - Type of the input tag: type="$type"
	 * @return - string
	 */
	private function input($name, $type, $id=null)
	{
		self::updateFormHash($name);
		$s = array();
		$s[] = '<input type="'.$type.'"';
		$s[] = ' name="'.urlencode((string)$this->name).'['.urlencode((string)$name).']"';

		$id = (empty($id)) ? urlencode((string)$name) : urlencode((string)$id);
		$s[] = ' id="'.$id.'"';

		return $s;
	}





	/**
	 * inputHidden - Returns a hidden input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputHidden($name, $value=null, $additionalAttributes=null)
	{
		$s = self::input($name, 'hidden');
		$s[] = ' value="';
		if($value === null && isset($this->formValues->{$name})) {
			$s[] = urlencode((string)$this->formValues->{$name});
		}
		else {
			$s[] = urlencode((string)$value);
		}
		$s[] = '"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';

		return implode($s);
	}




	/**
	 *
	 */
	public function helpBlock($name, $classes='with-errors')
	{
		$s = array();
		$s[] = '<div class="form-help-block ';
		$s[] = $classes;
		$s[] = '">';
		if($this->hasError($name)) {
			$s[] = $this->getError($name);
		}
		$s[] = '</div>';

		return implode($s);
	}




	/**
	 * inputText - Returns a text input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputText($name, $value=null, $additionalAttributes=null)
	{
		$s = self::input($name, 'text');
		$s[] = ' value="';
		if($value === null && isset($this->formValues->{$name})) {
			$s[] = preg_replace('/\"/', '&quot;', $this->formValues->{$name});
		}
		else {
			$s[] = preg_replace('/\"/', '&quot;', (string)$value);
		}
		$s[] = '"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}





	/**
	 * inputEmail - Returns an email input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputEmail($name, $value=null, $additionalAttributes=null)
	{
		$s = self::input($name, 'email');
		$s[] = ' value="';
		if($value === null && isset($this->formValues->{$name})) {
			$s[] = preg_replace('/\"/', '&quot;', $this->formValues->{$name});
		}
		else {
			$s[] = preg_replace('/\"/', '&quot;', (string)$value);
		}
		$s[] = '"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}





	/**
	 * inputPassword - Returns a password input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputPassword($name, $value=null, $additionalAttributes=null)
	{
		$s = self::input($name, 'password');
		$s[] = ' value="';
		if($value === null && isset($this->formValues->{$name})) {
			$s[] = preg_replace('/\"/', '&quot;', $this->formValues->{$name});
		}
		else {
			$s[] = preg_replace('/\"/', '&quot;', (string)$value);
		}
		$s[] = '"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}





	/**
	 * inputCheckbox - Returns a checkbox input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputCheckbox($name, $value='1', $additionalAttributes=null)
	{
		$s = self::input($name, 'checkbox');
		$s[] = ' value="'.urlencode((string)$value).'"';
		if(isset($this->formValues->{$name}) && (boolean)$this->formValues->{$name} === true) {
			$s[] = ' checked="checked"';
		}
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';

		return implode($s);
	}





	/**
	 * inputRadio - Returns a radio button input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputRadio($name, $value, $additionalAttributes=null)
	{
		$s = self::input($name, 'radio', $name.$value);
		$s[] = ' value="'.urlencode((string)$value).'"';
		if(isset($this->formValues->{$name}) && $this->formValues->{$name} === $value) {
			$s[] = ' checked="checked"';
		}
		if(!empty($additionalAttributes)) {
			$s[] = ' '.$additionalAttributes;
		}
		$s[] = '>';


		return implode($s);
	}


	/**
	 * inputRange - Returns a range input element
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputRange($name, $value, $additionalAttributes=null)
	{
		$s = self::input($name, 'range', $name.$value);
		$s[] = ' value="'.urlencode((string)$value).'"';
		if(!empty($additionalAttributes)) {
			$s[] = ' '.$additionalAttributes;
		}
		$s[] = '>';

		return implode($s);
	}



	/**
	 * inputSubmit - Returns a submit button input tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	public function inputSubmit($name, $value, $additionalAttributes=null)
	{
		$s = self::input($name, 'submit');
		$s[] = ' value="'.preg_replace('/\"/', '&quot;', $value).'"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';

		return implode($s);
	}




	/**
	 * textarea - Returns a textarea tag set and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $value - Value of the input tag: value="$value"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <textarea> tag
	 * @return - string
	 */
	public function textarea($name, $value=null, $additionalAttributes=null)
	{
		self::updateFormHash($name);

		$s = array();
		$s[] = '<textarea';
		$s[] = ' name="'.urlencode((string)$this->name).'['.urlencode((string)$name).']"';
		$s[] = ' id="'.urlencode((string)$name).'"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';
		if($value === null && isset($this->formValues->{$name})) {
			$s[] = htmlspecialchars($this->formValues->{$name});
		}
		else {
			$s[] = htmlspecialchars((string)$value);
		}
		$s[] = '</textarea>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}





	/**
	 * select - Returns a select open tag and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <input> tag
	 * @return - string
	 */
	private function select($name, $additionalAttributes)
	{
		self::updateFormHash($name);

		$s = array();
		$s[] = '<select';
		$s[] = ' name="'.urlencode((string)$this->name).'['.urlencode((string)$name).']"';
		$s[] = ' id="'.urlencode((string)$name).'"';
		$s[] = ' '.$additionalAttributes;
		$s[] = '>';

		return $s;
	}





	/**
	 * selectSingle - Returns a selection dropdown with options for a single dimentioned array and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $options - Array holding the value=>label structure to build the options
	 * @param $selected - The key selected in the options array
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <select> tag
	 * @return - string
	 */
	public function selectSingle($name, $options, $selected=null, $additionalAttributes=null)
	{
		if(!is_array($options)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The value passed in to $options was not an array as expected'
			);
		}

		$s = self::select($name, $additionalAttributes);

		if($selected === null && isset($this->formValues->{$name})) {
			$selected = $this->formValues->{$name};
		}
		// D::printre([$selected, $options]);
		foreach($options as $key => $value) {
			$s[] = "\n    ";
			$s[] = '<option value="'.urlencode((string)$key).'"';
			if($selected == $key) {
				$s[] = ' selected="selected"';
			}
			$s[] = '>';
			$s[] = htmlspecialchars($value);
			$s[] = '</option>';
		}
		$s[] = '</select>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}





	/**
	 * selectGroup - Returns a selection dropdown with options for a multi dimentioned array
	 *               with the first dimention keys being the option groups and adds the element to the form hash
	 *
	 * @param $name - Name of the input tag: name="$name"
	 * @param $options - Array holding the group=>value=>label structure to build the options
	 * @param $selected - The key selected in the options array
	 * @param $additionalAttributes - A string of additional attributes to be placed directly in the <select> tag
	 * @return - string
	 */
	public function selectGroups($name, $options, $selected=null, $additionalAttributes=null)
	{
		if(!is_array($options)) {
			throw new \Exception(
				__CLASS__.'::'.__FUNCTION__.' - The value passed in to $options was not an array as expected'
			);
		}

		$s = self::select($name, $additionalAttributes);
		if($selected === null && isset($this->formValues->{$name})) {
			$selected = $this->formValues->{$name};
		}
		foreach($options as $group => $valueList) {
			$s[] = "\n    ";
			$s[] = '<optgroup';
			$s[] = ' label="'.preg_replace('/\"/', '&quot;', $group).'"';
			$s[] = '>';
			foreach($valueList as $value => $label) {
				$s[] = "\n        ";
				$s[] = '<option';
				$s[] = ' value="'.urlencode((string)$value).'"';
				if($selected == $value) {
					$s[] = ' selected="selected"';
				}
				$s[] = '>';
				$s[] = preg_replace('/\"/', '&quot;', $label);
				$s[] = '</option>';
			}
			$s[] = '</optgroup>';
		}
		$s[] = "\n";
		$s[] = '</select>';
		$s[] = $this->helpBlock($name);

		return implode($s);
	}
}