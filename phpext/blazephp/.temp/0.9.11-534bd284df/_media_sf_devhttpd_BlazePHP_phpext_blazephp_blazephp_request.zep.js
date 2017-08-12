[
    {
        "type": "comment",
        "value": "**\n *\n * BlazePHP.com - A framework for high performance\n * Copyright 2012 - 2015, BlazePHP.com\n *\n * Licensed under The MIT License\n * Any redistribution of this file's contents, both\n * as a whole, or in part, must retain the above information\n *\n * @license       MIT License (http:\/\/www.opensource.org\/licenses\/mit-license.php)\n * @copyright     2012 - 2015, BlazePHP.com\n * @link          http:\/\/blazePHP.com\n *\n *",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
        "line": 15,
        "char": 9
    },
    {
        "type": "namespace",
        "name": "BlazePHP",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
        "line": 23,
        "char": 2
    },
    {
        "type": "comment",
        "value": "**\n * Request - Handles the detailed information about a reqeust\n *\n * @author    Matt Roszyk <me@mattroszyk.com>\n * @package   Blaze.Core\n *\n *",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
        "line": 24,
        "char": 5
    },
    {
        "type": "class",
        "name": "Request",
        "abstract": 0,
        "final": 0,
        "definition": {
            "properties": [
                {
                    "visibility": [
                        "protected"
                    ],
                    "type": "property",
                    "name": "parameters",
                    "default": {
                        "type": "empty-array",
                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                        "line": 26,
                        "char": 27
                    },
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 28,
                    "char": 7
                }
            ],
            "methods": [
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "__construct",
                    "statements": [
                        {
                            "type": "declare",
                            "data-type": "variable",
                            "variables": [
                                {
                                    "variable": "name",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 30,
                                    "char": 11
                                },
                                {
                                    "variable": "value",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 30,
                                    "char": 18
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 32,
                            "char": 5
                        },
                        {
                            "type": "for",
                            "expr": {
                                "type": "variable",
                                "value": "_REQUEST",
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 32,
                                "char": 31
                            },
                            "key": "name",
                            "value": "value",
                            "reverse": 0,
                            "statements": [
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "object-property-array-index",
                                            "operator": "assign",
                                            "variable": "this",
                                            "property": "parameters",
                                            "index-expr": [
                                                {
                                                    "type": "variable",
                                                    "value": "name",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 33,
                                                    "char": 29
                                                }
                                            ],
                                            "expr": {
                                                "type": "variable",
                                                "value": "value",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 33,
                                                "char": 38
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 33,
                                            "char": 38
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 34,
                                    "char": 3
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 35,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 28,
                    "last-line": 38,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "__get",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "name",
                            "const": 0,
                            "data-type": "variable",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 38,
                            "char": 28
                        }
                    ],
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "isset",
                                        "left": {
                                            "type": "list",
                                            "left": {
                                                "type": "array-access",
                                                "left": {
                                                    "type": "property-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "this",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 40,
                                                        "char": 22
                                                    },
                                                    "right": {
                                                        "type": "variable",
                                                        "value": "parameters",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 40,
                                                        "char": 33
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 40,
                                                    "char": 33
                                                },
                                                "right": {
                                                    "type": "variable",
                                                    "value": "name",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 40,
                                                    "char": 38
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 40,
                                                "char": 39
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 40,
                                            "char": 40
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 40,
                                        "char": 40
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 40,
                                    "char": 42
                                },
                                "right": {
                                    "type": "array-access",
                                    "left": {
                                        "type": "property-access",
                                        "left": {
                                            "type": "variable",
                                            "value": "this",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 40,
                                            "char": 49
                                        },
                                        "right": {
                                            "type": "variable",
                                            "value": "parameters",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 40,
                                            "char": 60
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 40,
                                        "char": 60
                                    },
                                    "right": {
                                        "type": "variable",
                                        "value": "name",
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 40,
                                        "char": 65
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 40,
                                    "char": 67
                                },
                                "extra": {
                                    "type": "null",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 40,
                                    "char": 73
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 40,
                                "char": 73
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 41,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 38,
                    "last-line": 44,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "getMethod",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "isset",
                                        "left": {
                                            "type": "list",
                                            "left": {
                                                "type": "array-access",
                                                "left": {
                                                    "type": "variable",
                                                    "value": "_SERVER",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 46,
                                                    "char": 24
                                                },
                                                "right": {
                                                    "type": "string",
                                                    "value": "REQUEST_METHOD",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 46,
                                                    "char": 41
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 46,
                                                "char": 42
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 46,
                                            "char": 43
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 46,
                                        "char": 43
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 46,
                                    "char": 45
                                },
                                "right": {
                                    "type": "fcall",
                                    "name": "strtoupper",
                                    "call-type": 1,
                                    "parameters": [
                                        {
                                            "parameter": {
                                                "type": "array-access",
                                                "left": {
                                                    "type": "variable",
                                                    "value": "_SERVER",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 46,
                                                    "char": 65
                                                },
                                                "right": {
                                                    "type": "string",
                                                    "value": "REQUEST_METHOD",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 46,
                                                    "char": 82
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 46,
                                                "char": 83
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 46,
                                            "char": 83
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 46,
                                    "char": 85
                                },
                                "extra": {
                                    "type": "null",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 46,
                                    "char": 91
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 46,
                                "char": 91
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 47,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 44,
                    "last-line": 50,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "getRequestedPath",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "array-access",
                                "left": {
                                    "type": "property-access",
                                    "left": {
                                        "type": "variable",
                                        "value": "this",
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 52,
                                        "char": 15
                                    },
                                    "right": {
                                        "type": "variable",
                                        "value": "parameters",
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 52,
                                        "char": 26
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 52,
                                    "char": 26
                                },
                                "right": {
                                    "type": "string",
                                    "value": "__requested_path",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 52,
                                    "char": 45
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 52,
                                "char": 46
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 53,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 50,
                    "last-line": 56,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "getHostConfig",
                    "statements": [
                        {
                            "type": "declare",
                            "data-type": "variable",
                            "variables": [
                                {
                                    "variable": "httphost",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 58,
                                    "char": 15
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 59,
                            "char": 5
                        },
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "variable",
                                    "operator": "assign",
                                    "variable": "httphost",
                                    "expr": {
                                        "type": "ternary",
                                        "left": {
                                            "type": "list",
                                            "left": {
                                                "type": "isset",
                                                "left": {
                                                    "type": "list",
                                                    "left": {
                                                        "type": "array-access",
                                                        "left": {
                                                            "type": "variable",
                                                            "value": "_SERVER",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 59,
                                                            "char": 32
                                                        },
                                                        "right": {
                                                            "type": "string",
                                                            "value": "HTTP_HOST",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 59,
                                                            "char": 44
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 59,
                                                        "char": 45
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 59,
                                                    "char": 46
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 59,
                                                "char": 46
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 59,
                                            "char": 48
                                        },
                                        "right": {
                                            "type": "fcall",
                                            "name": "strtolower",
                                            "call-type": 1,
                                            "parameters": [
                                                {
                                                    "parameter": {
                                                        "type": "array-access",
                                                        "left": {
                                                            "type": "variable",
                                                            "value": "_SERVER",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 59,
                                                            "char": 68
                                                        },
                                                        "right": {
                                                            "type": "string",
                                                            "value": "HTTP_HOST",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 59,
                                                            "char": 80
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 59,
                                                        "char": 81
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 59,
                                                    "char": 81
                                                }
                                            ],
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 59,
                                            "char": 83
                                        },
                                        "extra": {
                                            "type": "string",
                                            "value": "default",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 59,
                                            "char": 94
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 59,
                                        "char": 94
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 59,
                                    "char": 94
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 60,
                            "char": 8
                        },
                        {
                            "type": "return",
                            "expr": {
                                "type": "fcall",
                                "name": "preg_replace",
                                "call-type": 1,
                                "parameters": [
                                    {
                                        "parameter": {
                                            "type": "string",
                                            "value": "\/[^a-z]\/",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 60,
                                            "char": 33
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 60,
                                        "char": 33
                                    },
                                    {
                                        "parameter": {
                                            "type": "string",
                                            "value": "",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 60,
                                            "char": 37
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 60,
                                        "char": 37
                                    },
                                    {
                                        "parameter": {
                                            "type": "variable",
                                            "value": "httphost",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 60,
                                            "char": 47
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 60,
                                        "char": 47
                                    }
                                ],
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 60,
                                "char": 48
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 61,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 56,
                    "last-line": 64,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "isPOST",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "and",
                                        "left": {
                                            "type": "isset",
                                            "left": {
                                                "type": "list",
                                                "left": {
                                                    "type": "array-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "_SERVER",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 66,
                                                        "char": 24
                                                    },
                                                    "right": {
                                                        "type": "string",
                                                        "value": "REQUEST_METHOD",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 66,
                                                        "char": 41
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 66,
                                                    "char": 42
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 66,
                                                "char": 45
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 66,
                                            "char": 45
                                        },
                                        "right": {
                                            "type": "identical",
                                            "left": {
                                                "type": "fcall",
                                                "name": "strtoupper",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "array-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "_SERVER",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 66,
                                                                "char": 65
                                                            },
                                                            "right": {
                                                                "type": "string",
                                                                "value": "REQUEST_METHOD",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 66,
                                                                "char": 82
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 66,
                                                            "char": 83
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 66,
                                                        "char": 83
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 66,
                                                "char": 87
                                            },
                                            "right": {
                                                "type": "string",
                                                "value": "POST",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 66,
                                                "char": 95
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 66,
                                            "char": 95
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 66,
                                        "char": 95
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 67,
                                    "char": 4
                                },
                                "right": {
                                    "type": "bool",
                                    "value": "true",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 68,
                                    "char": 4
                                },
                                "extra": {
                                    "type": "bool",
                                    "value": "false",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 68,
                                    "char": 11
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 68,
                                "char": 11
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 69,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 64,
                    "last-line": 72,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "isGET",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "and",
                                        "left": {
                                            "type": "isset",
                                            "left": {
                                                "type": "list",
                                                "left": {
                                                    "type": "array-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "_SERVER",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 74,
                                                        "char": 24
                                                    },
                                                    "right": {
                                                        "type": "string",
                                                        "value": "REQUEST_METHOD",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 74,
                                                        "char": 41
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 74,
                                                    "char": 42
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 74,
                                                "char": 45
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 74,
                                            "char": 45
                                        },
                                        "right": {
                                            "type": "identical",
                                            "left": {
                                                "type": "fcall",
                                                "name": "strtoupper",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "array-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "_SERVER",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 74,
                                                                "char": 65
                                                            },
                                                            "right": {
                                                                "type": "string",
                                                                "value": "REQUEST_METHOD",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 74,
                                                                "char": 82
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 74,
                                                            "char": 83
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 74,
                                                        "char": 83
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 74,
                                                "char": 87
                                            },
                                            "right": {
                                                "type": "string",
                                                "value": "GET",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 74,
                                                "char": 94
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 74,
                                            "char": 94
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 74,
                                        "char": 94
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 75,
                                    "char": 4
                                },
                                "right": {
                                    "type": "bool",
                                    "value": "true",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 76,
                                    "char": 4
                                },
                                "extra": {
                                    "type": "bool",
                                    "value": "false",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 76,
                                    "char": 11
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 76,
                                "char": 11
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 77,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 72,
                    "last-line": 80,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "isPUT",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "and",
                                        "left": {
                                            "type": "isset",
                                            "left": {
                                                "type": "list",
                                                "left": {
                                                    "type": "array-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "_SERVER",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 82,
                                                        "char": 24
                                                    },
                                                    "right": {
                                                        "type": "string",
                                                        "value": "REQUEST_METHOD",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 82,
                                                        "char": 41
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 82,
                                                    "char": 42
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 82,
                                                "char": 45
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 82,
                                            "char": 45
                                        },
                                        "right": {
                                            "type": "identical",
                                            "left": {
                                                "type": "fcall",
                                                "name": "strtoupper",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "array-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "_SERVER",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 82,
                                                                "char": 65
                                                            },
                                                            "right": {
                                                                "type": "string",
                                                                "value": "REQUEST_METHOD",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 82,
                                                                "char": 82
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 82,
                                                            "char": 83
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 82,
                                                        "char": 83
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 82,
                                                "char": 87
                                            },
                                            "right": {
                                                "type": "string",
                                                "value": "PUT",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 82,
                                                "char": 94
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 82,
                                            "char": 94
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 82,
                                        "char": 94
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 83,
                                    "char": 4
                                },
                                "right": {
                                    "type": "bool",
                                    "value": "true",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 84,
                                    "char": 4
                                },
                                "extra": {
                                    "type": "bool",
                                    "value": "false",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 84,
                                    "char": 11
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 84,
                                "char": 11
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 85,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 80,
                    "last-line": 88,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "isDELETE",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "ternary",
                                "left": {
                                    "type": "list",
                                    "left": {
                                        "type": "and",
                                        "left": {
                                            "type": "isset",
                                            "left": {
                                                "type": "list",
                                                "left": {
                                                    "type": "array-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "_SERVER",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 90,
                                                        "char": 24
                                                    },
                                                    "right": {
                                                        "type": "string",
                                                        "value": "REQUEST_METHOD",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 90,
                                                        "char": 41
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 90,
                                                    "char": 42
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 90,
                                                "char": 45
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 90,
                                            "char": 45
                                        },
                                        "right": {
                                            "type": "identical",
                                            "left": {
                                                "type": "fcall",
                                                "name": "strtoupper",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "array-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "_SERVER",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 90,
                                                                "char": 65
                                                            },
                                                            "right": {
                                                                "type": "string",
                                                                "value": "REQUEST_METHOD",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                                "line": 90,
                                                                "char": 82
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                            "line": 90,
                                                            "char": 83
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                        "line": 90,
                                                        "char": 83
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 90,
                                                "char": 87
                                            },
                                            "right": {
                                                "type": "string",
                                                "value": "DELETE",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 90,
                                                "char": 97
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 90,
                                            "char": 97
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 90,
                                        "char": 97
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 91,
                                    "char": 4
                                },
                                "right": {
                                    "type": "bool",
                                    "value": "true",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 92,
                                    "char": 4
                                },
                                "extra": {
                                    "type": "bool",
                                    "value": "false",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 92,
                                    "char": 11
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 92,
                                "char": 11
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 93,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 88,
                    "last-line": 96,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "isAJAX",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "list",
                                "left": {
                                    "type": "and",
                                    "left": {
                                        "type": "fcall",
                                        "name": "array_key_exists",
                                        "call-type": 1,
                                        "parameters": [
                                            {
                                                "parameter": {
                                                    "type": "string",
                                                    "value": "HTTP_X_REQUESTED_WITH",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 98,
                                                    "char": 51
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 98,
                                                "char": 51
                                            },
                                            {
                                                "parameter": {
                                                    "type": "variable",
                                                    "value": "_SERVER",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                    "line": 98,
                                                    "char": 60
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 98,
                                                "char": 60
                                            }
                                        ],
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 98,
                                        "char": 63
                                    },
                                    "right": {
                                        "type": "equals",
                                        "left": {
                                            "type": "array-access",
                                            "left": {
                                                "type": "variable",
                                                "value": "_SERVER",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 98,
                                                "char": 72
                                            },
                                            "right": {
                                                "type": "string",
                                                "value": "HTTP_X_REQUESTED_WITH",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                                "line": 98,
                                                "char": 96
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 98,
                                            "char": 99
                                        },
                                        "right": {
                                            "type": "string",
                                            "value": "XMLHttpRequest",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                            "line": 98,
                                            "char": 117
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                        "line": 98,
                                        "char": 117
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                    "line": 98,
                                    "char": 117
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                                "line": 98,
                                "char": 118
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                            "line": 99,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
                    "line": 96,
                    "last-line": 100,
                    "char": 16
                }
            ],
            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
            "line": 24,
            "char": 5
        },
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/request.zep",
        "line": 24,
        "char": 5
    }
]