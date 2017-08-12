[
    {
        "type": "namespace",
        "name": "BlazePHP",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
        "line": 4,
        "char": 5
    },
    {
        "type": "class",
        "name": "UniqueId",
        "abstract": 0,
        "final": 0,
        "definition": {
            "methods": [
                {
                    "visibility": [
                        "public",
                        "static"
                    ],
                    "type": "method",
                    "name": "make",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "prefix",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "default": {
                                "type": "string",
                                "value": "",
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                "line": 6,
                                "char": 46
                            },
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 6,
                            "char": 46
                        },
                        {
                            "type": "parameter",
                            "name": "suffix",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "default": {
                                "type": "string",
                                "value": "",
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                "line": 6,
                                "char": 64
                            },
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 6,
                            "char": 64
                        }
                    ],
                    "statements": [
                        {
                            "type": "declare",
                            "data-type": "variable",
                            "variables": [
                                {
                                    "variable": "lock",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 8,
                                    "char": 11
                                },
                                {
                                    "variable": "thisSecond",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 8,
                                    "char": 23
                                },
                                {
                                    "variable": "id",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 8,
                                    "char": 27
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 10,
                            "char": 5
                        },
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "variable",
                                    "operator": "assign",
                                    "variable": "thisSecond",
                                    "expr": {
                                        "type": "concat",
                                        "left": {
                                            "type": "fcall",
                                            "name": "date",
                                            "call-type": 1,
                                            "parameters": [
                                                {
                                                    "parameter": {
                                                        "type": "string",
                                                        "value": "YmdHis",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 10,
                                                        "char": 35
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                    "line": 10,
                                                    "char": 35
                                                }
                                            ],
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                            "line": 10,
                                            "char": 37
                                        },
                                        "right": {
                                            "type": "fcall",
                                            "name": "microtime",
                                            "call-type": 1,
                                            "parameters": [
                                                {
                                                    "parameter": {
                                                        "type": "bool",
                                                        "value": "true",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 10,
                                                        "char": 53
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                    "line": 10,
                                                    "char": 53
                                                }
                                            ],
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                            "line": 10,
                                            "char": 54
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                        "line": 10,
                                        "char": 54
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 10,
                                    "char": 54
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 11,
                            "char": 5
                        },
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "variable",
                                    "operator": "assign",
                                    "variable": "lock",
                                    "expr": {
                                        "type": "new",
                                        "class": "Lock",
                                        "dynamic": 0,
                                        "parameters": [
                                            {
                                                "parameter": {
                                                    "type": "concat",
                                                    "left": {
                                                        "type": "string",
                                                        "value": "blaze_session_lock-",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 11,
                                                        "char": 53
                                                    },
                                                    "right": {
                                                        "type": "variable",
                                                        "value": "thisSecond",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 11,
                                                        "char": 65
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                    "line": 11,
                                                    "char": 65
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                "line": 11,
                                                "char": 65
                                            }
                                        ],
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                        "line": 11,
                                        "char": 66
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 11,
                                    "char": 66
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 12,
                            "char": 5
                        },
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "variable",
                                    "operator": "assign",
                                    "variable": "id",
                                    "expr": {
                                        "type": "concat",
                                        "left": {
                                            "type": "concat",
                                            "left": {
                                                "type": "variable",
                                                "value": "prefix",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                "line": 12,
                                                "char": 23
                                            },
                                            "right": {
                                                "type": "fcall",
                                                "name": "uniqid",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "int",
                                                            "value": "1",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                            "line": 12,
                                                            "char": 33
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 12,
                                                        "char": 33
                                                    },
                                                    {
                                                        "parameter": {
                                                            "type": "bool",
                                                            "value": "true",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                            "line": 12,
                                                            "char": 39
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                        "line": 12,
                                                        "char": 39
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                                "line": 12,
                                                "char": 41
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                            "line": 12,
                                            "char": 41
                                        },
                                        "right": {
                                            "type": "variable",
                                            "value": "suffix",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                            "line": 12,
                                            "char": 49
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                        "line": 12,
                                        "char": 49
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 12,
                                    "char": 49
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 13,
                            "char": 5
                        },
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "variable",
                                    "operator": "assign",
                                    "variable": "lock",
                                    "expr": {
                                        "type": "null",
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                        "line": 13,
                                        "char": 18
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                    "line": 13,
                                    "char": 18
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 15,
                            "char": 8
                        },
                        {
                            "type": "return",
                            "expr": {
                                "type": "variable",
                                "value": "id",
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                                "line": 15,
                                "char": 12
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                            "line": 16,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
                    "line": 6,
                    "last-line": 17,
                    "char": 23
                }
            ],
            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
            "line": 4,
            "char": 5
        },
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/uniqueid.zep",
        "line": 4,
        "char": 5
    }
]