<?php return array (
  0 => 
  array (
    'type' => 'comment',
    'value' => '**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2013, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file\'s contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     Copyright 2012 - 2013, BlazePHP.com
 * @link          http://blazePHP.com
 *
 *',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
    'line' => 15,
    'char' => 9,
  ),
  1 => 
  array (
    'type' => 'namespace',
    'name' => 'BlazePHP',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
    'line' => 28,
    'char' => 2,
  ),
  2 => 
  array (
    'type' => 'comment',
    'value' => '**
 * Struct - A basic structure wrapper.  This is a very controlled way to create
 *          parameters for methods, template value holders, etc...
 *
 *          The goal of this class is to eliminate, as much as possible, the
 *          ambiguous nature of a template/class/method/etc
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 *',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
    'line' => 29,
    'char' => 5,
  ),
  3 => 
  array (
    'type' => 'class',
    'name' => 'Struct',
    'abstract' => 0,
    'final' => 0,
    'definition' => 
    array (
      'methods' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__get',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'invalidAttribute',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
              'line' => 36,
              'char' => 47,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'throw',
              'expr' => 
              array (
                'type' => 'new',
                'class' => '\\ErrorException',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'concat',
                      'left' => 
                      array (
                        'type' => 'string',
                        'value' => 'Trying to access an invalid attribute Struct::',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                        'line' => 38,
                        'char' => 78,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'invalidAttribute',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                        'line' => 38,
                        'char' => 96,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                      'line' => 38,
                      'char' => 96,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                    'line' => 38,
                    'char' => 96,
                  ),
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                'line' => 38,
                'char' => 97,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
              'line' => 39,
              'char' => 2,
            ),
          ),
          'docblock' => '**
	 * Ensure that any attempt at accessing an invalid attribute method will
	 * result in an ErrorException being thrown.
	 *
	 *',
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
          'line' => 36,
          'last-line' => 41,
          'char' => 16,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__set',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'invalidAttribute',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
              'line' => 41,
              'char' => 47,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'sValue',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
              'line' => 41,
              'char' => 55,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'throw',
              'expr' => 
              array (
                'type' => 'new',
                'class' => '\\ErrorException',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'concat',
                      'left' => 
                      array (
                        'type' => 'string',
                        'value' => 'Trying to write to an invalid attribute Struct::',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                        'line' => 43,
                        'char' => 80,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'invalidAttribute',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                        'line' => 43,
                        'char' => 98,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                      'line' => 43,
                      'char' => 98,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                    'line' => 43,
                    'char' => 98,
                  ),
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
                'line' => 43,
                'char' => 99,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
              'line' => 44,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
          'line' => 41,
          'last-line' => 45,
          'char' => 16,
        ),
      ),
      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
      'line' => 29,
      'char' => 5,
    ),
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/struct.zep',
    'line' => 29,
    'char' => 5,
  ),
);