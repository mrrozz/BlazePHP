<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'BlazePHP',
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
    'line' => 3,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'Session',
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
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'type',
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 7,
          'char' => 8,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'id',
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 9,
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
              'name' => 'config',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => 'SessionConfig',
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                'line' => 9,
                'char' => 51,
              ),
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 9,
              'char' => 52,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'list',
                'left' => 
                array (
                  'type' => 'empty',
                  'left' => 
                  array (
                    'type' => 'list',
                    'left' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'config',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                        'line' => 12,
                        'char' => 19,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'id',
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                        'line' => 12,
                        'char' => 22,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                      'line' => 12,
                      'char' => 22,
                    ),
                    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                    'line' => 12,
                    'char' => 23,
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                  'line' => 12,
                  'char' => 23,
                ),
                'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                'line' => 12,
                'char' => 25,
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
                      'property' => 'id',
                      'expr' => 
                      array (
                        'type' => 'scall',
                        'dynamic-class' => 0,
                        'class' => 'UniqueId',
                        'dynamic' => 0,
                        'name' => 'make',
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'string',
                              'value' => 'blazephp_session_',
                              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                              'line' => 13,
                              'char' => 53,
                            ),
                            'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                            'line' => 13,
                            'char' => 53,
                          ),
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                        'line' => 13,
                        'char' => 54,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                      'line' => 13,
                      'char' => 54,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                  'line' => 14,
                  'char' => 3,
                ),
              ),
              'else_statements' => 
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
                      'property' => 'id',
                      'expr' => 
                      array (
                        'type' => 'property-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => 'config',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                          'line' => 16,
                          'char' => 26,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'id',
                          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                          'line' => 16,
                          'char' => 29,
                        ),
                        'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                        'line' => 16,
                        'char' => 29,
                      ),
                      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                      'line' => 16,
                      'char' => 29,
                    ),
                  ),
                  'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
                  'line' => 17,
                  'char' => 3,
                ),
              ),
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 18,
              'char' => 2,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 9,
          'last-line' => 22,
          'char' => 16,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'close',
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 22,
          'last-line' => 29,
          'char' => 16,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'destroy',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'id',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 29,
              'char' => 35,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 29,
          'last-line' => 36,
          'char' => 16,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'gc',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'maxLifeTime',
              'const' => 0,
              'data-type' => 'int',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 36,
              'char' => 36,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 36,
          'last-line' => 43,
          'char' => 16,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'open',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'savePath',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 43,
              'char' => 38,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 43,
              'char' => 51,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 43,
          'last-line' => 50,
          'char' => 16,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'read',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'id',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 50,
              'char' => 32,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 50,
          'last-line' => 57,
          'char' => 16,
        ),
        6 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'write',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'id',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 57,
              'char' => 33,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'data',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
              'line' => 57,
              'char' => 46,
            ),
          ),
          'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
          'line' => 57,
          'last-line' => 61,
          'char' => 16,
        ),
      ),
      'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
      'line' => 3,
      'char' => 5,
    ),
    'file' => '/media/sf_devhttpd/BlazePHP/phpext/blazephp/blazephp/session.zep',
    'line' => 3,
    'char' => 5,
  ),
);