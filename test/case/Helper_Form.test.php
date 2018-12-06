<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2017, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2017, BlazePHP.com
 * @link          http://blazePHP.com
 * @package       Blaze.
 */
namespace BlazeTest;
use \BlazePHP\Globals as G;
use \BlazePHP\Helper\Form;
use \BlazePHP\Request;
use \BlazePHP\Session;
use \BlazePHP\Debug as D;
use BlazeTest\TestCase;

G::$request = new Request();
// D::printre(G::$request);



$_REQUEST['__requested_path'] = 'user/login';
G::$request = new Request();

class Route extends \BlazePHP\Route
{
	public function __construct()
	{
		// %i - the argument is treated as an unsigned integer
		// %s - the argument is treated as and presented as a string matching the following pattern '[a-zA-Z0-9_\-\.]'.

		// $this->alias('/mycontroller/myaction/id:$i1',          '/myAlias/%i');
		// $this->alias('/mycontroller/myaction/id:$i1/form:$i2', '/myAlias/%i/%i');
		// $this->alias('/blog/view/article:$s1/mode:$s2',        '/blog/%s/%s');
		// $this->alias('/blog/view/article:$s1',                 '/blog/%s');

		$this->alias('/', '/');

		parent::__construct();
	}
}
G::$route  = new Route();


final class Helper_FormTest extends TestCase
{
	public function testInstanceCreates()
	{
		$this->assertInstanceOf(Form::class, new Form);
	}

	public function testOpenInsecure()
	{
		// D::printre(G::$router);
		$form = new Form(Form::INSECURE, 'testform_insecure');

		$data = $form->open();
		$this->assertValueEquals($data, '<form name="testform_insecure" action="/user/login" method="post" enctype="multipart/form-data" formenctype="multipart/form-data"><input type="hidden" name="__blaze_form_name" value="testform_insecure">');

	}

	public function testOpenSingleUseOnly()
	{
		G::$session = new Session();
		$form = new Form(Form::SINGLE_USE_ONLY, 'testform_single_use_only');

		$data = $form->open();

		$this->assertValueEquals($data, '<form name="testform_single_use_only" action="/user/login" method="post" enctype="multipart/form-data" formenctype="multipart/form-data"><input type="hidden" name="__blaze_form_name" value="testform_single_use_only"><input type="hidden" name="__blaze_form_key" value="'.G::$session->formKeys['testform_single_use_only'].'">');
	}


	public function testOpenSecure()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->open();

		$this->assertValueEquals($data, '<form name="testform_secure" action="/user/login" method="post" enctype="multipart/form-data" formenctype="multipart/form-data"><input type="hidden" name="__blaze_form_name" value="testform_secure"><input type="hidden" name="__blaze_form_key" value="'.G::$session->formKeys['testform_secure'].'">');
	}


	public function testInputText()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputText('name_first', null, 'class="input_class"');

		$this->assertValueEquals($data, '<input type="text" name="testform_secure[name_first]" id="name_first" value="" class="input_class"><div class="form-help-block with-errors"></div>');
	}

	public function testInputEmail()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputEmail('email', null, 'class="input_class"');

		$this->assertValueEquals($data, '<input type="email" name="testform_secure[email]" id="email" value="" class="input_class"><div class="form-help-block with-errors"></div>');
	}

	public function testInputPassword()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputPassword('password', null, 'class="password_class"');

		$this->assertValueEquals($data, '<input type="password" name="testform_secure[password]" id="password" value="" class="password_class"><div class="form-help-block with-errors"></div>');
	}

	public function testInputCheckbox()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputCheckbox('option_one', 'one', 'class="option_one_class"');

		$this->assertValueEquals($data, '<input type="checkbox" name="testform_secure[option_one]" id="option_one" value="one" class="option_one_class">');
	}

	public function testRadio()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputRadio('option_three', 'a', 'class="radio_class"');

		$this->assertValueEquals($data, '<input type="radio" name="testform_secure[option_three]" id="option_three" value="a" class="radio_class">');
	}

	public function testTextarea()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->textarea('long_text_block', 'THIS IS THE TEXTAREA VALUE', 'class="textarea_class');

		$this->assertValueEquals($data, '<textarea name="testform_secure[long_text_block]" id="long_text_block" class="textarea_class>THIS IS THE TEXTAREA VALUE</textarea><div class="form-help-block with-errors"></div>');
	}

	public function testSelectSingle()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$singleChoice = array(
			 'one'   => 'First Choice'
			,'two'   => 'Second Choice'
			,'three' => 'Third Choice'
		);
		$data = explode("\n", $form->selectSingle('single_choice', $singleChoice, 'two', 'class="single_choice_class"'));
		$cleaned = array();
		foreach($data as $line) {
			$cleaned[] = trim($line);
		}
		$data = implode($cleaned);

		$this->assertValueEquals($data, '<select name="testform_secure[single_choice]" id="single_choice" class="single_choice_class"><option value="one">First Choice</option><option value="two" selected="selected">Second Choice</option><option value="three">Third Choice</option></select><div class="form-help-block with-errors"></div>');
	}

	public function testSelectByGroup()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$groupChoice = array(
			 'Group #1' => array(
				 'one'   => 'First Choice'
				,'two'   => 'Second Choice'
				,'three' => 'Third Choice'
			)
			,'Group #2' => array(
				 'eh'  => 'A'
				,'bee' => 'B'
				,'sea' => 'C'
			)
		);
		$data = explode("\n", $form->selectGroups('single_choice', $groupChoice, 'bee', 'class="group_choice_class"'));
		$cleaned = array();
		foreach($data as $line) {
			$cleaned[] = trim($line);
		}
		$data = implode($cleaned);

		$this->assertValueEquals($data, '<select name="testform_secure[single_choice]" id="single_choice" class="group_choice_class"><optgroup label="Group #1"><option value="one">First Choice</option><option value="two">Second Choice</option><option value="three">Third Choice</option></optgroup><optgroup label="Group #2"><option value="eh">A</option><option value="bee" selected="selected">B</option><option value="sea">C</option></optgroup></select><div class="form-help-block with-errors"></div>');
	}

	public function testInputSubmit()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');

		$data = $form->inputSubmit('submit', 'Submit Me!', 'class="submit_class"');

		$this->assertValueEquals($data, '<input type="submit" name="testform_secure[submit]" id="submit" value="Submit Me!" class="submit_class">');
	}

	public function testClose()
	{
		G::$session = new Session();
		$form = new Form(Form::SECURE, 'testform_secure');


		$data = $form->close();
		$this->assertValueEquals($data, '</form>');
	}
		/** /
		?>



		<label>First Name: <?=$form->inputText('name_first', null, 'class="redtext"');?></label>
		<label>Last Name: <?=$form->inputText('name_last', null, 'class="bluetext"');?></label>
		<label>Constant Value: <?=$form->inputText('constant_value', 'constant value', 'class="bluetext"');?></label>
		<br><br>
		<label>Option #1: <?=$form->inputCheckbox('option_one');?></label>
		<label>Option #2: <?=$form->inputCheckbox('option_two');?></label>
		<br><br>
		<label>Option #3.a <?=$form->inputRadio('option_three', 'a');?></label>
		<label>Option #3.b <?=$form->inputRadio('option_three', 'b');?></label>
		<label>Option #3.c <?=$form->inputRadio('option_three', 'c');?></label>
		<label>Option #3.d <?=$form->inputRadio('option_three', 'd');?></label>
		<br><br>
		<label>Some Long Text: <?=$form->textarea('long_text_block');?></label>
		<br><br>
		<label>Select One: <?=$form->selectSingle('single_choice', $singleChoice);?></label>
		<br>
		<input type="submit" name="submit" value="Verify Key">


		<?=$form->close();?>

		<? /**/

}
