[
    {
        "type": "namespace",
        "name": "BlazePHP",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
        "line": 4,
        "char": 5
    },
    {
        "type": "class",
        "name": "Lock",
        "abstract": 0,
        "final": 0,
        "extends": "Struct",
        "definition": {
            "properties": [
                {
                    "visibility": [
                        "private"
                    ],
                    "type": "property",
                    "name": "lockFileLocation",
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                    "line": 8,
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
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "procName",
                            "const": 0,
                            "data-type": "variable",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                            "line": 8,
                            "char": 38
                        }
                    ],
                    "statements": [
                        {
                            "type": "let",
                            "assignments": [
                                {
                                    "assign-type": "object-property",
                                    "operator": "assign",
                                    "variable": "this",
                                    "property": "lockFileLocation",
                                    "expr": {
                                        "type": "concat",
                                        "left": {
                                            "type": "concat",
                                            "left": {
                                                "type": "concat",
                                                "left": {
                                                    "type": "constant",
                                                    "value": "ABS_VAR",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 10,
                                                    "char": 40
                                                },
                                                "right": {
                                                    "type": "string",
                                                    "value": "\/lock\/",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 10,
                                                    "char": 51
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 10,
                                                "char": 51
                                            },
                                            "right": {
                                                "type": "variable",
                                                "value": "procName",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 10,
                                                "char": 62
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 10,
                                            "char": 62
                                        },
                                        "right": {
                                            "type": "string",
                                            "value": ".lock",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 10,
                                            "char": 71
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                        "line": 10,
                                        "char": 71
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 10,
                                    "char": 71
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                            "line": 12,
                            "char": 4
                        },
                        {
                            "type": "if",
                            "expr": {
                                "type": "list",
                                "left": {
                                    "type": "fcall",
                                    "name": "file_exists",
                                    "call-type": 1,
                                    "parameters": [
                                        {
                                            "parameter": {
                                                "type": "property-access",
                                                "left": {
                                                    "type": "variable",
                                                    "value": "this",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 12,
                                                    "char": 23
                                                },
                                                "right": {
                                                    "type": "variable",
                                                    "value": "lockFileLocation",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 12,
                                                    "char": 40
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 12,
                                                "char": 40
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 12,
                                            "char": 40
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 12,
                                    "char": 41
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                "line": 12,
                                "char": 43
                            },
                            "statements": [
                                {
                                    "type": "declare",
                                    "data-type": "variable",
                                    "variables": [
                                        {
                                            "variable": "now",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 14,
                                            "char": 11
                                        },
                                        {
                                            "variable": "fileTime",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 14,
                                            "char": 21
                                        },
                                        {
                                            "variable": "diff",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 14,
                                            "char": 27
                                        },
                                        {
                                            "variable": "fileAge",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 14,
                                            "char": 36
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 16,
                                    "char": 6
                                },
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "variable",
                                            "operator": "assign",
                                            "variable": "now",
                                            "expr": {
                                                "type": "new",
                                                "class": "\\DateTime",
                                                "dynamic": 0,
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 16,
                                                "char": 34
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 16,
                                            "char": 34
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 17,
                                    "char": 6
                                },
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "variable",
                                            "operator": "assign",
                                            "variable": "fileTime",
                                            "expr": {
                                                "type": "new",
                                                "class": "\\DateTime",
                                                "dynamic": 0,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "fcall",
                                                            "name": "date",
                                                            "call-type": 1,
                                                            "parameters": [
                                                                {
                                                                    "parameter": {
                                                                        "type": "string",
                                                                        "value": "Y-m-d H:i:s",
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 17,
                                                                        "char": 51
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 17,
                                                                    "char": 51
                                                                },
                                                                {
                                                                    "parameter": {
                                                                        "type": "fcall",
                                                                        "name": "filemtime",
                                                                        "call-type": 1,
                                                                        "parameters": [
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "property-access",
                                                                                    "left": {
                                                                                        "type": "variable",
                                                                                        "value": "this",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 17,
                                                                                        "char": 68
                                                                                    },
                                                                                    "right": {
                                                                                        "type": "variable",
                                                                                        "value": "lockFileLocation",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 17,
                                                                                        "char": 85
                                                                                    },
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 17,
                                                                                    "char": 85
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 17,
                                                                                "char": 85
                                                                            }
                                                                        ],
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 17,
                                                                        "char": 86
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 17,
                                                                    "char": 86
                                                                }
                                                            ],
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 17,
                                                            "char": 87
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 17,
                                                        "char": 87
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 17,
                                                "char": 88
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 17,
                                            "char": 88
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 18,
                                    "char": 6
                                },
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "variable",
                                            "operator": "assign",
                                            "variable": "diff",
                                            "expr": {
                                                "type": "mcall",
                                                "variable": {
                                                    "type": "variable",
                                                    "value": "now",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 18,
                                                    "char": 23
                                                },
                                                "name": "diff",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "variable",
                                                            "value": "fileTime",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 18,
                                                            "char": 37
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 18,
                                                        "char": 37
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 18,
                                                "char": 38
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 18,
                                            "char": 38
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 20,
                                    "char": 6
                                },
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "variable",
                                            "operator": "assign",
                                            "variable": "fileAge",
                                            "expr": {
                                                "type": "fcall",
                                                "name": "implode",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "string",
                                                            "value": "",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 20,
                                                            "char": 28
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 20,
                                                        "char": 28
                                                    },
                                                    {
                                                        "parameter": {
                                                            "type": "array",
                                                            "left": [
                                                                {
                                                                    "value": {
                                                                        "type": "concat",
                                                                        "left": {
                                                                            "type": "property-access",
                                                                            "left": {
                                                                                "type": "variable",
                                                                                "value": "diff",
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 21,
                                                                                "char": 11
                                                                            },
                                                                            "right": {
                                                                                "type": "variable",
                                                                                "value": "d",
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 21,
                                                                                "char": 14
                                                                            },
                                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                            "line": 21,
                                                                            "char": 14
                                                                        },
                                                                        "right": {
                                                                            "type": "string",
                                                                            "value": " days, ",
                                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                            "line": 22,
                                                                            "char": 5
                                                                        },
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 22,
                                                                        "char": 5
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 22,
                                                                    "char": 5
                                                                },
                                                                {
                                                                    "value": {
                                                                        "type": "fcall",
                                                                        "name": "str_pad",
                                                                        "call-type": 1,
                                                                        "parameters": [
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "property-access",
                                                                                    "left": {
                                                                                        "type": "variable",
                                                                                        "value": "diff",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 22,
                                                                                        "char": 19
                                                                                    },
                                                                                    "right": {
                                                                                        "type": "variable",
                                                                                        "value": "h",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 22,
                                                                                        "char": 21
                                                                                    },
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 22,
                                                                                    "char": 21
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 22,
                                                                                "char": 21
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "int",
                                                                                    "value": "2",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 22,
                                                                                    "char": 24
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 22,
                                                                                "char": 24
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "string",
                                                                                    "value": "0",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 22,
                                                                                    "char": 29
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 22,
                                                                                "char": 29
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "constant",
                                                                                    "value": "STR_PAD_LEFT",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 22,
                                                                                    "char": 43
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 22,
                                                                                "char": 43
                                                                            }
                                                                        ],
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 23,
                                                                        "char": 5
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 23,
                                                                    "char": 5
                                                                },
                                                                {
                                                                    "value": {
                                                                        "type": "string",
                                                                        "value": ":",
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 24,
                                                                        "char": 5
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 24,
                                                                    "char": 5
                                                                },
                                                                {
                                                                    "value": {
                                                                        "type": "fcall",
                                                                        "name": "str_pad",
                                                                        "call-type": 1,
                                                                        "parameters": [
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "property-access",
                                                                                    "left": {
                                                                                        "type": "variable",
                                                                                        "value": "diff",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 24,
                                                                                        "char": 19
                                                                                    },
                                                                                    "right": {
                                                                                        "type": "variable",
                                                                                        "value": "i",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 24,
                                                                                        "char": 21
                                                                                    },
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 24,
                                                                                    "char": 21
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 24,
                                                                                "char": 21
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "int",
                                                                                    "value": "2",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 24,
                                                                                    "char": 24
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 24,
                                                                                "char": 24
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "string",
                                                                                    "value": "0",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 24,
                                                                                    "char": 29
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 24,
                                                                                "char": 29
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "constant",
                                                                                    "value": "STR_PAD_LEFT",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 24,
                                                                                    "char": 43
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 24,
                                                                                "char": 43
                                                                            }
                                                                        ],
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 25,
                                                                        "char": 5
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 25,
                                                                    "char": 5
                                                                },
                                                                {
                                                                    "value": {
                                                                        "type": "string",
                                                                        "value": ":",
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 26,
                                                                        "char": 5
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 26,
                                                                    "char": 5
                                                                },
                                                                {
                                                                    "value": {
                                                                        "type": "fcall",
                                                                        "name": "str_pad",
                                                                        "call-type": 1,
                                                                        "parameters": [
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "property-access",
                                                                                    "left": {
                                                                                        "type": "variable",
                                                                                        "value": "diff",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 26,
                                                                                        "char": 19
                                                                                    },
                                                                                    "right": {
                                                                                        "type": "variable",
                                                                                        "value": "s",
                                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                        "line": 26,
                                                                                        "char": 21
                                                                                    },
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 26,
                                                                                    "char": 21
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 26,
                                                                                "char": 21
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "int",
                                                                                    "value": "2",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 26,
                                                                                    "char": 24
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 26,
                                                                                "char": 24
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "string",
                                                                                    "value": "0",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 26,
                                                                                    "char": 29
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 26,
                                                                                "char": 29
                                                                            },
                                                                            {
                                                                                "parameter": {
                                                                                    "type": "constant",
                                                                                    "value": "STR_PAD_LEFT",
                                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                    "line": 26,
                                                                                    "char": 43
                                                                                },
                                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                                "line": 26,
                                                                                "char": 43
                                                                            }
                                                                        ],
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 27,
                                                                        "char": 4
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 27,
                                                                    "char": 4
                                                                }
                                                            ],
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 27,
                                                            "char": 5
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 27,
                                                        "char": 5
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 27,
                                                "char": 6
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 27,
                                            "char": 6
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 29,
                                    "char": 8
                                },
                                {
                                    "type": "throw",
                                    "expr": {
                                        "type": "new",
                                        "class": "\\Exception",
                                        "dynamic": 0,
                                        "parameters": [
                                            {
                                                "parameter": {
                                                    "type": "concat",
                                                    "left": {
                                                        "type": "concat",
                                                        "left": {
                                                            "type": "concat",
                                                            "left": {
                                                                "type": "concat",
                                                                "left": {
                                                                    "type": "concat",
                                                                    "left": {
                                                                        "type": "concat",
                                                                        "left": {
                                                                            "type": "string",
                                                                            "value": "The lock file exists for [",
                                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                            "line": 30,
                                                                            "char": 34
                                                                        },
                                                                        "right": {
                                                                            "type": "variable",
                                                                            "value": "procName",
                                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                            "line": 30,
                                                                            "char": 45
                                                                        },
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 30,
                                                                        "char": 45
                                                                    },
                                                                    "right": {
                                                                        "type": "string",
                                                                        "value": "], age: [",
                                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                        "line": 30,
                                                                        "char": 59
                                                                    },
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 30,
                                                                    "char": 59
                                                                },
                                                                "right": {
                                                                    "type": "variable",
                                                                    "value": "fileAge",
                                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                    "line": 30,
                                                                    "char": 69
                                                                },
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 30,
                                                                "char": 69
                                                            },
                                                            "right": {
                                                                "type": "string",
                                                                "value": "], location: [",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 30,
                                                                "char": 88
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 30,
                                                            "char": 88
                                                        },
                                                        "right": {
                                                            "type": "property-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "this",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 30,
                                                                "char": 95
                                                            },
                                                            "right": {
                                                                "type": "variable",
                                                                "value": "lockFileLocation",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 30,
                                                                "char": 113
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 30,
                                                            "char": 113
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 30,
                                                        "char": 113
                                                    },
                                                    "right": {
                                                        "type": "string",
                                                        "value": "]",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 31,
                                                        "char": 4
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 31,
                                                    "char": 4
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 31,
                                                "char": 4
                                            }
                                        ],
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                        "line": 31,
                                        "char": 5
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 32,
                                    "char": 3
                                }
                            ],
                            "else_statements": [
                                {
                                    "type": "declare",
                                    "data-type": "variable",
                                    "variables": [
                                        {
                                            "variable": "fp",
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 34,
                                            "char": 10
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 35,
                                    "char": 6
                                },
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "variable",
                                            "operator": "assign",
                                            "variable": "fp",
                                            "expr": {
                                                "type": "fcall",
                                                "name": "fopen",
                                                "call-type": 1,
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "property-access",
                                                            "left": {
                                                                "type": "variable",
                                                                "value": "this",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 35,
                                                                "char": 24
                                                            },
                                                            "right": {
                                                                "type": "variable",
                                                                "value": "lockFileLocation",
                                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                                "line": 35,
                                                                "char": 41
                                                            },
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 35,
                                                            "char": 41
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 35,
                                                        "char": 41
                                                    },
                                                    {
                                                        "parameter": {
                                                            "type": "string",
                                                            "value": "w",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                            "line": 35,
                                                            "char": 46
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 35,
                                                        "char": 46
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 35,
                                                "char": 47
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 35,
                                            "char": 47
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 36,
                                    "char": 9
                                },
                                {
                                    "type": "fcall",
                                    "expr": {
                                        "type": "fcall",
                                        "name": "fwrite",
                                        "call-type": 1,
                                        "parameters": [
                                            {
                                                "parameter": {
                                                    "type": "variable",
                                                    "value": "fp",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 36,
                                                    "char": 13
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 36,
                                                "char": 13
                                            },
                                            {
                                                "parameter": {
                                                    "type": "property-access",
                                                    "left": {
                                                        "type": "variable",
                                                        "value": "this",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 36,
                                                        "char": 20
                                                    },
                                                    "right": {
                                                        "type": "variable",
                                                        "value": "lockFileLocation",
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                        "line": 36,
                                                        "char": 37
                                                    },
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 36,
                                                    "char": 37
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 36,
                                                "char": 37
                                            }
                                        ],
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                        "line": 36,
                                        "char": 38
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 37,
                                    "char": 9
                                },
                                {
                                    "type": "fcall",
                                    "expr": {
                                        "type": "fcall",
                                        "name": "fclose",
                                        "call-type": 1,
                                        "parameters": [
                                            {
                                                "parameter": {
                                                    "type": "variable",
                                                    "value": "fp",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                    "line": 37,
                                                    "char": 13
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 37,
                                                "char": 13
                                            }
                                        ],
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                        "line": 37,
                                        "char": 14
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 38,
                                    "char": 3
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                            "line": 39,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                    "line": 8,
                    "last-line": 41,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "__destruct",
                    "statements": [
                        {
                            "type": "fcall",
                            "expr": {
                                "type": "fcall",
                                "name": "unlink",
                                "call-type": 1,
                                "parameters": [
                                    {
                                        "parameter": {
                                            "type": "property-access",
                                            "left": {
                                                "type": "variable",
                                                "value": "this",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 43,
                                                "char": 15
                                            },
                                            "right": {
                                                "type": "variable",
                                                "value": "lockFileLocation",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                                "line": 43,
                                                "char": 32
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                            "line": 43,
                                            "char": 32
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                        "line": 43,
                                        "char": 32
                                    }
                                ],
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                "line": 43,
                                "char": 33
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                            "line": 44,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                    "line": 41,
                    "last-line": 46,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "fileLocation",
                    "statements": [
                        {
                            "type": "return",
                            "expr": {
                                "type": "property-access",
                                "left": {
                                    "type": "variable",
                                    "value": "this",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 48,
                                    "char": 15
                                },
                                "right": {
                                    "type": "variable",
                                    "value": "lockFileLocation",
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                    "line": 48,
                                    "char": 32
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                                "line": 48,
                                "char": 32
                            },
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                            "line": 49,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
                    "line": 46,
                    "last-line": 50,
                    "char": 16
                }
            ],
            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
            "line": 4,
            "char": 5
        },
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/lock.zep",
        "line": 4,
        "char": 5
    }
]