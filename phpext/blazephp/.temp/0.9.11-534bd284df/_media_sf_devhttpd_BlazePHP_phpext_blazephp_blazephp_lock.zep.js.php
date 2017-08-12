<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'BlazePHP',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'Lock',
    'abstract' => 0,
    'final' => 0,
    'extends' => 'Struct',
    'definition' => 
    array (
      'properties' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'lockFileLocation',
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
          'line' => 8,
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
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'procName',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
              'line' => 8,
              'char' => 38,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'lockFileLocation',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'concat',
                      'left' => 
                      array (
                        'type' => 'concat',
                        'left' => 
                        array (
                          'type' => 'constant',
                          'value' => 'ABS_VAR',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 10,
                          'char' => 40,
                        ),
                        'right' => 
                        array (
                          'type' => 'string',
                          'value' => '/lock/',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 10,
                          'char' => 51,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 10,
                        'char' => 51,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'procName',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 10,
                        'char' => 62,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 10,
                      'char' => 62,
                    ),
                    'right' => 
                    array (
                      'type' => 'string',
                      'value' => '.lock',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 10,
                      'char' => 71,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                    'line' => 10,
                    'char' => 71,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 10,
                  'char' => 71,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
              'line' => 12,
              'char' => 4,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'list',
                'left' => 
                array (
                  'type' => 'fcall',
                  'name' => 'file_exists',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'property-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 12,
                          'char' => 23,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'lockFileLocation',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 12,
                          'char' => 40,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 12,
                        'char' => 40,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 12,
                      'char' => 40,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 12,
                  'char' => 41,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                'line' => 12,
                'char' => 43,
              ),
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
                      'variable' => 'now',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 14,
                      'char' => 11,
                    ),
                    1 => 
                    array (
                      'variable' => 'fileTime',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 14,
                      'char' => 21,
                    ),
                    2 => 
                    array (
                      'variable' => 'diff',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 14,
                      'char' => 27,
                    ),
                    3 => 
                    array (
                      'variable' => 'fileAge',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 14,
                      'char' => 36,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 16,
                  'char' => 6,
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
                      'variable' => 'now',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => '\\DateTime',
                        'dynamic' => 0,
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 16,
                        'char' => 34,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 16,
                      'char' => 34,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 17,
                  'char' => 6,
                ),
                2 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'fileTime',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => '\\DateTime',
                        'dynamic' => 0,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'fcall',
                              'name' => 'date',
                              'call-type' => 1,
                              'parameters' => 
                              array (
                                0 => 
                                array (
                                  'parameter' => 
                                  array (
                                    'type' => 'string',
                                    'value' => 'Y-m-d H:i:s',
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 17,
                                    'char' => 51,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 17,
                                  'char' => 51,
                                ),
                                1 => 
                                array (
                                  'parameter' => 
                                  array (
                                    'type' => 'fcall',
                                    'name' => 'filemtime',
                                    'call-type' => 1,
                                    'parameters' => 
                                    array (
                                      0 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'property-access',
                                          'left' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'this',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 17,
                                            'char' => 68,
                                          ),
                                          'right' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'lockFileLocation',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 17,
                                            'char' => 85,
                                          ),
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 17,
                                          'char' => 85,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 17,
                                        'char' => 85,
                                      ),
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 17,
                                    'char' => 86,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 17,
                                  'char' => 86,
                                ),
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 17,
                              'char' => 87,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 17,
                            'char' => 87,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 17,
                        'char' => 88,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 17,
                      'char' => 88,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 18,
                  'char' => 6,
                ),
                3 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'diff',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'now',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 18,
                          'char' => 23,
                        ),
                        'name' => 'diff',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'fileTime',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 18,
                              'char' => 37,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 18,
                            'char' => 37,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 18,
                        'char' => 38,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 18,
                      'char' => 38,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 20,
                  'char' => 6,
                ),
                4 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'fileAge',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'implode',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'string',
                              'value' => '',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 20,
                              'char' => 28,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 20,
                            'char' => 28,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array',
                              'left' => 
                              array (
                                0 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'concat',
                                    'left' => 
                                    array (
                                      'type' => 'property-access',
                                      'left' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'diff',
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 21,
                                        'char' => 11,
                                      ),
                                      'right' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'd',
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 21,
                                        'char' => 14,
                                      ),
                                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                      'line' => 21,
                                      'char' => 14,
                                    ),
                                    'right' => 
                                    array (
                                      'type' => 'string',
                                      'value' => ' days, ',
                                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                      'line' => 22,
                                      'char' => 5,
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 22,
                                    'char' => 5,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 22,
                                  'char' => 5,
                                ),
                                1 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'fcall',
                                    'name' => 'str_pad',
                                    'call-type' => 1,
                                    'parameters' => 
                                    array (
                                      0 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'property-access',
                                          'left' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'diff',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 22,
                                            'char' => 19,
                                          ),
                                          'right' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'h',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 22,
                                            'char' => 21,
                                          ),
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 22,
                                          'char' => 21,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 22,
                                        'char' => 21,
                                      ),
                                      1 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'int',
                                          'value' => '2',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 22,
                                          'char' => 24,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 22,
                                        'char' => 24,
                                      ),
                                      2 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'string',
                                          'value' => '0',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 22,
                                          'char' => 29,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 22,
                                        'char' => 29,
                                      ),
                                      3 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'constant',
                                          'value' => 'STR_PAD_LEFT',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 22,
                                          'char' => 43,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 22,
                                        'char' => 43,
                                      ),
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 23,
                                    'char' => 5,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 23,
                                  'char' => 5,
                                ),
                                2 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'string',
                                    'value' => ':',
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 24,
                                    'char' => 5,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 24,
                                  'char' => 5,
                                ),
                                3 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'fcall',
                                    'name' => 'str_pad',
                                    'call-type' => 1,
                                    'parameters' => 
                                    array (
                                      0 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'property-access',
                                          'left' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'diff',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 24,
                                            'char' => 19,
                                          ),
                                          'right' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'i',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 24,
                                            'char' => 21,
                                          ),
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 24,
                                          'char' => 21,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 24,
                                        'char' => 21,
                                      ),
                                      1 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'int',
                                          'value' => '2',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 24,
                                          'char' => 24,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 24,
                                        'char' => 24,
                                      ),
                                      2 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'string',
                                          'value' => '0',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 24,
                                          'char' => 29,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 24,
                                        'char' => 29,
                                      ),
                                      3 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'constant',
                                          'value' => 'STR_PAD_LEFT',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 24,
                                          'char' => 43,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 24,
                                        'char' => 43,
                                      ),
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 25,
                                    'char' => 5,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 25,
                                  'char' => 5,
                                ),
                                4 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'string',
                                    'value' => ':',
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 26,
                                    'char' => 5,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 26,
                                  'char' => 5,
                                ),
                                5 => 
                                array (
                                  'value' => 
                                  array (
                                    'type' => 'fcall',
                                    'name' => 'str_pad',
                                    'call-type' => 1,
                                    'parameters' => 
                                    array (
                                      0 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'property-access',
                                          'left' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 'diff',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 26,
                                            'char' => 19,
                                          ),
                                          'right' => 
                                          array (
                                            'type' => 'variable',
                                            'value' => 's',
                                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                            'line' => 26,
                                            'char' => 21,
                                          ),
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 26,
                                          'char' => 21,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 26,
                                        'char' => 21,
                                      ),
                                      1 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'int',
                                          'value' => '2',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 26,
                                          'char' => 24,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 26,
                                        'char' => 24,
                                      ),
                                      2 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'string',
                                          'value' => '0',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 26,
                                          'char' => 29,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 26,
                                        'char' => 29,
                                      ),
                                      3 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'constant',
                                          'value' => 'STR_PAD_LEFT',
                                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                          'line' => 26,
                                          'char' => 43,
                                        ),
                                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                        'line' => 26,
                                        'char' => 43,
                                      ),
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 27,
                                    'char' => 4,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 27,
                                  'char' => 4,
                                ),
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 27,
                              'char' => 5,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 27,
                            'char' => 5,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 27,
                        'char' => 6,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 27,
                      'char' => 6,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 29,
                  'char' => 8,
                ),
                5 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => '\\Exception',
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
                            'type' => 'concat',
                            'left' => 
                            array (
                              'type' => 'concat',
                              'left' => 
                              array (
                                'type' => 'concat',
                                'left' => 
                                array (
                                  'type' => 'concat',
                                  'left' => 
                                  array (
                                    'type' => 'concat',
                                    'left' => 
                                    array (
                                      'type' => 'string',
                                      'value' => 'The lock file exists for [',
                                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                      'line' => 30,
                                      'char' => 34,
                                    ),
                                    'right' => 
                                    array (
                                      'type' => 'variable',
                                      'value' => 'procName',
                                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                      'line' => 30,
                                      'char' => 45,
                                    ),
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 30,
                                    'char' => 45,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'string',
                                    'value' => '], age: [',
                                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                    'line' => 30,
                                    'char' => 59,
                                  ),
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 30,
                                  'char' => 59,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'fileAge',
                                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                  'line' => 30,
                                  'char' => 69,
                                ),
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 30,
                                'char' => 69,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => '], location: [',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 30,
                                'char' => 88,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 30,
                              'char' => 88,
                            ),
                            'right' => 
                            array (
                              'type' => 'property-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'this',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 30,
                                'char' => 95,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'lockFileLocation',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 30,
                                'char' => 113,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 30,
                              'char' => 113,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 30,
                            'char' => 113,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => ']',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 31,
                            'char' => 4,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 31,
                          'char' => 4,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 31,
                        'char' => 4,
                      ),
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                    'line' => 31,
                    'char' => 5,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 32,
                  'char' => 3,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'declare',
                  'data-type' => 'variable',
                  'variables' => 
                  array (
                    0 => 
                    array (
                      'variable' => 'fp',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 34,
                      'char' => 10,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 35,
                  'char' => 6,
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
                      'variable' => 'fp',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'fopen',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'property-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'this',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 35,
                                'char' => 24,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'lockFileLocation',
                                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                                'line' => 35,
                                'char' => 41,
                              ),
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 35,
                              'char' => 41,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 35,
                            'char' => 41,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'string',
                              'value' => 'w',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                              'line' => 35,
                              'char' => 46,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 35,
                            'char' => 46,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 35,
                        'char' => 47,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 35,
                      'char' => 47,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 36,
                  'char' => 9,
                ),
                2 => 
                array (
                  'type' => 'fcall',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'fwrite',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'fp',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 36,
                          'char' => 13,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 36,
                        'char' => 13,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'property-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'this',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 36,
                            'char' => 20,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'lockFileLocation',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                            'line' => 36,
                            'char' => 37,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 36,
                          'char' => 37,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 36,
                        'char' => 37,
                      ),
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                    'line' => 36,
                    'char' => 38,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 37,
                  'char' => 9,
                ),
                3 => 
                array (
                  'type' => 'fcall',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'fclose',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'fp',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                          'line' => 37,
                          'char' => 13,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 37,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                    'line' => 37,
                    'char' => 14,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 38,
                  'char' => 3,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
              'line' => 39,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
          'line' => 8,
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
          'name' => '__destruct',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'fcall',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'unlink',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 43,
                        'char' => 15,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'lockFileLocation',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                        'line' => 43,
                        'char' => 32,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                      'line' => 43,
                      'char' => 32,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                    'line' => 43,
                    'char' => 32,
                  ),
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                'line' => 43,
                'char' => 33,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
              'line' => 44,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
          'line' => 41,
          'last-line' => 46,
          'char' => 16,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'fileLocation',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'property-access',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 48,
                  'char' => 15,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'lockFileLocation',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                  'line' => 48,
                  'char' => 32,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
                'line' => 48,
                'char' => 32,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
              'line' => 49,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
          'line' => 46,
          'last-line' => 50,
          'char' => 16,
        ),
      ),
      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
      'line' => 4,
      'char' => 5,
    ),
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/lock.zep',
    'line' => 4,
    'char' => 5,
  ),
);