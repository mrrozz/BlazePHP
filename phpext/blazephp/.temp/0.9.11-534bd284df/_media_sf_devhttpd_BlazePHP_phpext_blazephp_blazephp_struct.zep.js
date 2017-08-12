[
    {
        "type": "comment",
        "value": "**\n *\n * BlazePHP.com - A framework for high performance\n * Copyright 2012 - 2013, BlazePHP.com\n *\n * Licensed under The MIT License\n * Any redistribution of this file's contents, both\n * as a whole, or in part, must retain the above information\n *\n * @license       MIT License (http:\/\/www.opensource.org\/licenses\/mit-license.php)\n * @copyright     Copyright 2012 - 2013, BlazePHP.com\n * @link          http:\/\/blazePHP.com\n *\n *",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
        "line": 15,
        "char": 9
    },
    {
        "type": "namespace",
        "name": "BlazePHP",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
        "line": 28,
        "char": 2
    },
    {
        "type": "comment",
        "value": "**\n * Struct - A basic structure wrapper.  This is a very controlled way to create\n *          parameters for methods, template value holders, etc...\n *\n *          The goal of this class is to eliminate, as much as possible, the\n *          ambiguous nature of a template\/class\/method\/etc\n *\n * @author    Matt Roszyk <me@mattroszyk.com>\n * @package   Blaze.Core\n *\n *",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
        "line": 29,
        "char": 5
    },
    {
        "type": "class",
        "name": "Struct",
        "abstract": 0,
        "final": 0,
        "definition": {
            "methods": [
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "__get",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "invalidAttribute",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                            "line": 36,
                            "char": 47
                        }
                    ],
                    "statements": [
                        {
                            "type": "throw",
                            "expr": {
                                "type": "new",
                                "class": "\\ErrorException",
                                "dynamic": 0,
                                "parameters": [
                                    {
                                        "parameter": {
                                            "type": "concat",
                                            "left": {
                                                "type": "string",
                                                "value": "Trying to access an invalid attribute Struct::",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                                "line": 38,
                                                "char": 78
                                            },
                                            "right": {
                                                "type": "variable",
                                                "value": "invalidAttribute",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                                "line": 38,
                                                "char": 96
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                            "line": 38,
                                            "char": 96
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                        "line": 38,
                                        "char": 96
                                    }
                                ],
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                "line": 38,
                                "char": 97
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                            "line": 39,
                            "char": 2
                        }
                    ],
                    "docblock": "**\n\t * Ensure that any attempt at accessing an invalid attribute method will\n\t * result in an ErrorException being thrown.\n\t *\n\t *",
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                    "line": 36,
                    "last-line": 41,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "__set",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "invalidAttribute",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                            "line": 41,
                            "char": 47
                        },
                        {
                            "type": "parameter",
                            "name": "sValue",
                            "const": 0,
                            "data-type": "variable",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                            "line": 41,
                            "char": 55
                        }
                    ],
                    "statements": [
                        {
                            "type": "throw",
                            "expr": {
                                "type": "new",
                                "class": "\\ErrorException",
                                "dynamic": 0,
                                "parameters": [
                                    {
                                        "parameter": {
                                            "type": "concat",
                                            "left": {
                                                "type": "string",
                                                "value": "Trying to write to an invalid attribute Struct::",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                                "line": 43,
                                                "char": 80
                                            },
                                            "right": {
                                                "type": "variable",
                                                "value": "invalidAttribute",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                                "line": 43,
                                                "char": 98
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                            "line": 43,
                                            "char": 98
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                        "line": 43,
                                        "char": 98
                                    }
                                ],
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                                "line": 43,
                                "char": 99
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                            "line": 44,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
                    "line": 41,
                    "last-line": 45,
                    "char": 16
                }
            ],
            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
            "line": 29,
            "char": 5
        },
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/struct.zep",
        "line": 29,
        "char": 5
    }
]