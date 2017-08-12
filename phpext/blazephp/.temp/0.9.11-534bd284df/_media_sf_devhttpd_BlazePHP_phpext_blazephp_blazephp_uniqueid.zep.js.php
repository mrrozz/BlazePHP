<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'BlazePHP',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'UniqueId',
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
            1 => 'static',
          ),
          'type' => 'method',
          'name' => 'make',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'prefix',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'string',
                'value' => '',
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                'line' => 6,
                'char' => 46,
              ),
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 6,
              'char' => 46,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'suffix',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'string',
                'value' => '',
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                'line' => 6,
                'char' => 64,
              ),
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 6,
              'char' => 64,
            ),
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
                  'variable' => 'lock',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 8,
                  'char' => 11,
                ),
                1 => 
                array (
                  'variable' => 'thisSecond',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 8,
                  'char' => 23,
                ),
                2 => 
                array (
                  'variable' => 'id',
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 8,
                  'char' => 27,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 10,
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
                  'variable' => 'thisSecond',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
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
                            'value' => 'YmdHis',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 10,
                            'char' => 35,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                          'line' => 10,
                          'char' => 35,
                        ),
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                      'line' => 10,
                      'char' => 37,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'microtime',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'bool',
                            'value' => 'true',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 10,
                            'char' => 53,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                          'line' => 10,
                          'char' => 53,
                        ),
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                      'line' => 10,
                      'char' => 54,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                    'line' => 10,
                    'char' => 54,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 10,
                  'char' => 54,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 11,
              'char' => 5,
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
                  'variable' => 'lock',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'Lock',
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
                            'value' => 'blaze_session_lock-',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 11,
                            'char' => 53,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'thisSecond',
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 11,
                            'char' => 65,
                          ),
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                          'line' => 11,
                          'char' => 65,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                        'line' => 11,
                        'char' => 65,
                      ),
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                    'line' => 11,
                    'char' => 66,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 11,
                  'char' => 66,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 12,
              'char' => 5,
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
                  'variable' => 'id',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'concat',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'prefix',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                        'line' => 12,
                        'char' => 23,
                      ),
                      'right' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'uniqid',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'int',
                              'value' => '1',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                              'line' => 12,
                              'char' => 33,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 12,
                            'char' => 33,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'bool',
                              'value' => 'true',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                              'line' => 12,
                              'char' => 39,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                            'line' => 12,
                            'char' => 39,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                        'line' => 12,
                        'char' => 41,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                      'line' => 12,
                      'char' => 41,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'suffix',
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                      'line' => 12,
                      'char' => 49,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                    'line' => 12,
                    'char' => 49,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 12,
                  'char' => 49,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 13,
              'char' => 5,
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
                  'variable' => 'lock',
                  'expr' => 
                  array (
                    'type' => 'null',
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                    'line' => 13,
                    'char' => 18,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                  'line' => 13,
                  'char' => 18,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 15,
              'char' => 8,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'id',
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
                'line' => 15,
                'char' => 12,
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
              'line' => 16,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
          'line' => 6,
          'last-line' => 17,
          'char' => 23,
        ),
      ),
      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
      'line' => 4,
      'char' => 5,
    ),
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/uniqueid.zep',
    'line' => 4,
    'char' => 5,
  ),
);