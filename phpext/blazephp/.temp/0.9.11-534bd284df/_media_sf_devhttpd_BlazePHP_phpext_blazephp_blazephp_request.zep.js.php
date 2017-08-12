<?php return array (
  0 => 
  array (
    'type' => 'comment',
    'value' => '**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2015, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file\'s contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2015, BlazePHP.com
 * @link          http://blazePHP.com
 *
 *',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
    'line' => 15,
    'char' => 9,
  ),
  1 => 
  array (
    'type' => 'namespace',
    'name' => 'BlazePHP',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
    'line' => 23,
    'char' => 2,
  ),
  2 => 
  array (
    'type' => 'comment',
    'value' => '**
 * Request - Handles the detailed information about a reqeust
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 *',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
    'line' => 24,
    'char' => 5,
  ),
  3 => 
  array (
    'type' => 'class',
    'name' => 'Request',
    'abstract' => 0,
    'final' => 0,
    'definition' => 
    array (
      'properties' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'parameters',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
            'line' => 26,
            'char' => 27,
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 28,
          'char' => 7,
        ),
      ),
      'methods' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__construct',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'name',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 30,
                  'char' => 11,
                ),
                1 => 
                array (
                  'variable' => 'value',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 30,
                  'char' => 18,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 32,
              'char' => 5,
            ),
            1 => 
            array (
              'type' => 'for',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => '_REQUEST',
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 32,
                'char' => 31,
              ),
              'key' => 'name',
              'value' => 'value',
              'reverse' => 0,
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'parameters',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 33,
                          'char' => 29,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'value',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 33,
                        'char' => 38,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 33,
                      'char' => 38,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 34,
                  'char' => 3,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 35,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 28,
          'last-line' => 38,
          'char' => 16,
        ),
        1 => 
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
              'name' => 'name',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 38,
              'char' => 28,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'isset',
                    'left' => 
                    array (
                      'type' => 'list',
                      'left' => 
                      array (
                        'type' => 'array-access',
                        'left' => 
                        array (
                          'type' => 'property-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'this',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 40,
                            'char' => 22,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'parameters',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 40,
                            'char' => 33,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 40,
                          'char' => 33,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 40,
                          'char' => 38,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 40,
                        'char' => 39,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 40,
                      'char' => 40,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 40,
                    'char' => 40,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 40,
                  'char' => 42,
                ),
                'right' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 40,
                      'char' => 49,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'parameters',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 40,
                      'char' => 60,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 40,
                    'char' => 60,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'name',
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 40,
                    'char' => 65,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 40,
                  'char' => 67,
                ),
                'extra' => 
                array (
                  'type' => 'null',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 40,
                  'char' => 73,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 40,
                'char' => 73,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 41,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 38,
          'last-line' => 44,
          'char' => 16,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getMethod',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'isset',
                    'left' => 
                    array (
                      'type' => 'list',
                      'left' => 
                      array (
                        'type' => 'array-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => '_SERVER',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 46,
                          'char' => 24,
                        ),
                        'right' => 
                        array (
                          'type' => 'string',
                          'value' => 'REQUEST_METHOD',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 46,
                          'char' => 41,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 46,
                        'char' => 42,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 46,
                      'char' => 43,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 46,
                    'char' => 43,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 46,
                  'char' => 45,
                ),
                'right' => 
                array (
                  'type' => 'fcall',
                  'name' => 'strtoupper',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'array-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => '_SERVER',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 46,
                          'char' => 65,
                        ),
                        'right' => 
                        array (
                          'type' => 'string',
                          'value' => 'REQUEST_METHOD',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 46,
                          'char' => 82,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 46,
                        'char' => 83,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 46,
                      'char' => 83,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 46,
                  'char' => 85,
                ),
                'extra' => 
                array (
                  'type' => 'null',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 46,
                  'char' => 91,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 46,
                'char' => 91,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 47,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 44,
          'last-line' => 50,
          'char' => 16,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getRequestedPath',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'array-access',
                'left' => 
                array (
                  'type' => 'property-access',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 52,
                    'char' => 15,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'parameters',
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 52,
                    'char' => 26,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 52,
                  'char' => 26,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => '__requested_path',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 52,
                  'char' => 45,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 52,
                'char' => 46,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 53,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 50,
          'last-line' => 56,
          'char' => 16,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getHostConfig',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'httphost',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 58,
                  'char' => 15,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 59,
              'char' => 5,
            ),
            1 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'httphost',
                  'expr' => 
                  array (
                    'type' => 'ternary',
                    'left' => 
                    array (
                      'type' => 'list',
                      'left' => 
                      array (
                        'type' => 'isset',
                        'left' => 
                        array (
                          'type' => 'list',
                          'left' => 
                          array (
                            'type' => 'array-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => '_SERVER',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 59,
                              'char' => 32,
                            ),
                            'right' => 
                            array (
                              'type' => 'string',
                              'value' => 'HTTP_HOST',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 59,
                              'char' => 44,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 59,
                            'char' => 45,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 59,
                          'char' => 46,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 59,
                        'char' => 46,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 59,
                      'char' => 48,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'strtolower',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'array-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => '_SERVER',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 59,
                              'char' => 68,
                            ),
                            'right' => 
                            array (
                              'type' => 'string',
                              'value' => 'HTTP_HOST',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 59,
                              'char' => 80,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 59,
                            'char' => 81,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 59,
                          'char' => 81,
                        ),
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 59,
                      'char' => 83,
                    ),
                    'extra' => 
                    array (
                      'type' => 'string',
                      'value' => 'default',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 59,
                      'char' => 94,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 59,
                    'char' => 94,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 59,
                  'char' => 94,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 60,
              'char' => 8,
            ),
            2 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'preg_replace',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'string',
                      'value' => '/[^a-z]/',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 60,
                      'char' => 33,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 60,
                    'char' => 33,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'string',
                      'value' => '',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 60,
                      'char' => 37,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 60,
                    'char' => 37,
                  ),
                  2 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'httphost',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 60,
                      'char' => 47,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 60,
                    'char' => 47,
                  ),
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 60,
                'char' => 48,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 61,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 56,
          'last-line' => 64,
          'char' => 16,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isPOST',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'and',
                    'left' => 
                    array (
                      'type' => 'isset',
                      'left' => 
                      array (
                        'type' => 'list',
                        'left' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => '_SERVER',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 66,
                            'char' => 24,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => 'REQUEST_METHOD',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 66,
                            'char' => 41,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 66,
                          'char' => 42,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 66,
                        'char' => 45,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 66,
                      'char' => 45,
                    ),
                    'right' => 
                    array (
                      'type' => 'identical',
                      'left' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtoupper',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => '_SERVER',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 66,
                                'char' => 65,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => 'REQUEST_METHOD',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 66,
                                'char' => 82,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 66,
                              'char' => 83,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 66,
                            'char' => 83,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 66,
                        'char' => 87,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => 'POST',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 66,
                        'char' => 95,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 66,
                      'char' => 95,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 66,
                    'char' => 95,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 67,
                  'char' => 4,
                ),
                'right' => 
                array (
                  'type' => 'bool',
                  'value' => 'true',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 68,
                  'char' => 4,
                ),
                'extra' => 
                array (
                  'type' => 'bool',
                  'value' => 'false',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 68,
                  'char' => 11,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 68,
                'char' => 11,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 69,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 64,
          'last-line' => 72,
          'char' => 16,
        ),
        6 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isGET',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'and',
                    'left' => 
                    array (
                      'type' => 'isset',
                      'left' => 
                      array (
                        'type' => 'list',
                        'left' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => '_SERVER',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 74,
                            'char' => 24,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => 'REQUEST_METHOD',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 74,
                            'char' => 41,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 74,
                          'char' => 42,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 74,
                        'char' => 45,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 74,
                      'char' => 45,
                    ),
                    'right' => 
                    array (
                      'type' => 'identical',
                      'left' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtoupper',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => '_SERVER',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 74,
                                'char' => 65,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => 'REQUEST_METHOD',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 74,
                                'char' => 82,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 74,
                              'char' => 83,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 74,
                            'char' => 83,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 74,
                        'char' => 87,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => 'GET',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 74,
                        'char' => 94,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 74,
                      'char' => 94,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 74,
                    'char' => 94,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 75,
                  'char' => 4,
                ),
                'right' => 
                array (
                  'type' => 'bool',
                  'value' => 'true',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 76,
                  'char' => 4,
                ),
                'extra' => 
                array (
                  'type' => 'bool',
                  'value' => 'false',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 76,
                  'char' => 11,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 76,
                'char' => 11,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 77,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 72,
          'last-line' => 80,
          'char' => 16,
        ),
        7 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isPUT',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'and',
                    'left' => 
                    array (
                      'type' => 'isset',
                      'left' => 
                      array (
                        'type' => 'list',
                        'left' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => '_SERVER',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 82,
                            'char' => 24,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => 'REQUEST_METHOD',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 82,
                            'char' => 41,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 82,
                          'char' => 42,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 82,
                        'char' => 45,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 82,
                      'char' => 45,
                    ),
                    'right' => 
                    array (
                      'type' => 'identical',
                      'left' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtoupper',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => '_SERVER',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 82,
                                'char' => 65,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => 'REQUEST_METHOD',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 82,
                                'char' => 82,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 82,
                              'char' => 83,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 82,
                            'char' => 83,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 82,
                        'char' => 87,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => 'PUT',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 82,
                        'char' => 94,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 82,
                      'char' => 94,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 82,
                    'char' => 94,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 83,
                  'char' => 4,
                ),
                'right' => 
                array (
                  'type' => 'bool',
                  'value' => 'true',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 84,
                  'char' => 4,
                ),
                'extra' => 
                array (
                  'type' => 'bool',
                  'value' => 'false',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 84,
                  'char' => 11,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 84,
                'char' => 11,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 85,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 80,
          'last-line' => 88,
          'char' => 16,
        ),
        8 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isDELETE',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'ternary',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'and',
                    'left' => 
                    array (
                      'type' => 'isset',
                      'left' => 
                      array (
                        'type' => 'list',
                        'left' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => '_SERVER',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 90,
                            'char' => 24,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => 'REQUEST_METHOD',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 90,
                            'char' => 41,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 90,
                          'char' => 42,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 90,
                        'char' => 45,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 90,
                      'char' => 45,
                    ),
                    'right' => 
                    array (
                      'type' => 'identical',
                      'left' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtoupper',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => '_SERVER',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 90,
                                'char' => 65,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => 'REQUEST_METHOD',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                                'line' => 90,
                                'char' => 82,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                              'line' => 90,
                              'char' => 83,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                            'line' => 90,
                            'char' => 83,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 90,
                        'char' => 87,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => 'DELETE',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 90,
                        'char' => 97,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 90,
                      'char' => 97,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 90,
                    'char' => 97,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 91,
                  'char' => 4,
                ),
                'right' => 
                array (
                  'type' => 'bool',
                  'value' => 'true',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 92,
                  'char' => 4,
                ),
                'extra' => 
                array (
                  'type' => 'bool',
                  'value' => 'false',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 92,
                  'char' => 11,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 92,
                'char' => 11,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 93,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 88,
          'last-line' => 96,
          'char' => 16,
        ),
        9 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isAJAX',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'list',
                'left' => 
                array (
                  'type' => 'and',
                  'left' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'array_key_exists',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'string',
                          'value' => 'HTTP_X_REQUESTED_WITH',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 98,
                          'char' => 51,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 98,
                        'char' => 51,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => '_SERVER',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                          'line' => 98,
                          'char' => 60,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 98,
                        'char' => 60,
                      ),
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 98,
                    'char' => 63,
                  ),
                  'right' => 
                  array (
                    'type' => 'equals',
                    'left' => 
                    array (
                      'type' => 'array-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => '_SERVER',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 98,
                        'char' => 72,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => 'HTTP_X_REQUESTED_WITH',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                        'line' => 98,
                        'char' => 96,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 98,
                      'char' => 99,
                    ),
                    'right' => 
                    array (
                      'type' => 'string',
                      'value' => 'XMLHttpRequest',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                      'line' => 98,
                      'char' => 117,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                    'line' => 98,
                    'char' => 117,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                  'line' => 98,
                  'char' => 117,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
                'line' => 98,
                'char' => 118,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
              'line' => 99,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
          'line' => 96,
          'last-line' => 100,
          'char' => 16,
        ),
      ),
      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
      'line' => 24,
      'char' => 5,
    ),
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/request.zep',
    'line' => 24,
    'char' => 5,
  ),
);