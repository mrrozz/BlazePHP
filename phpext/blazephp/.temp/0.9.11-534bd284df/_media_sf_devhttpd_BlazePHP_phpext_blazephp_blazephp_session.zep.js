[
    {
        "type": "namespace",
        "name": "BlazePHP",
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
        "line": 3,
        "char": 5
    },
    {
        "type": "class",
        "name": "Session",
        "abstract": 0,
        "final": 0,
        "definition": {
            "properties": [
                {
                    "visibility": [
                        "private"
                    ],
                    "type": "property",
                    "name": "type",
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 7,
                    "char": 8
                },
                {
                    "visibility": [
                        "private"
                    ],
                    "type": "property",
                    "name": "id",
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 9,
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
                            "name": "config",
                            "const": 0,
                            "data-type": "variable",
                            "mandatory": 0,
                            "cast": {
                                "type": "variable",
                                "value": "SessionConfig",
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                "line": 9,
                                "char": 51
                            },
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 9,
                            "char": 52
                        }
                    ],
                    "statements": [
                        {
                            "type": "if",
                            "expr": {
                                "type": "list",
                                "left": {
                                    "type": "empty",
                                    "left": {
                                        "type": "list",
                                        "left": {
                                            "type": "property-access",
                                            "left": {
                                                "type": "variable",
                                                "value": "config",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                "line": 12,
                                                "char": 19
                                            },
                                            "right": {
                                                "type": "variable",
                                                "value": "id",
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                "line": 12,
                                                "char": 22
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                            "line": 12,
                                            "char": 22
                                        },
                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                        "line": 12,
                                        "char": 23
                                    },
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                    "line": 12,
                                    "char": 23
                                },
                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                "line": 12,
                                "char": 25
                            },
                            "statements": [
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "object-property",
                                            "operator": "assign",
                                            "variable": "this",
                                            "property": "id",
                                            "expr": {
                                                "type": "scall",
                                                "dynamic-class": 0,
                                                "class": "UniqueId",
                                                "dynamic": 0,
                                                "name": "make",
                                                "parameters": [
                                                    {
                                                        "parameter": {
                                                            "type": "string",
                                                            "value": "blazephp_session_",
                                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                            "line": 13,
                                                            "char": 53
                                                        },
                                                        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                        "line": 13,
                                                        "char": 53
                                                    }
                                                ],
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                "line": 13,
                                                "char": 54
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                            "line": 13,
                                            "char": 54
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                    "line": 14,
                                    "char": 3
                                }
                            ],
                            "else_statements": [
                                {
                                    "type": "let",
                                    "assignments": [
                                        {
                                            "assign-type": "object-property",
                                            "operator": "assign",
                                            "variable": "this",
                                            "property": "id",
                                            "expr": {
                                                "type": "property-access",
                                                "left": {
                                                    "type": "variable",
                                                    "value": "config",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                    "line": 16,
                                                    "char": 26
                                                },
                                                "right": {
                                                    "type": "variable",
                                                    "value": "id",
                                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                    "line": 16,
                                                    "char": 29
                                                },
                                                "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                                "line": 16,
                                                "char": 29
                                            },
                                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                            "line": 16,
                                            "char": 29
                                        }
                                    ],
                                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                                    "line": 17,
                                    "char": 3
                                }
                            ],
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 18,
                            "char": 2
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 9,
                    "last-line": 22,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "close",
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 22,
                    "last-line": 29,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "destroy",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "id",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 29,
                            "char": 35
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 29,
                    "last-line": 36,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "gc",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "maxLifeTime",
                            "const": 0,
                            "data-type": "int",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 36,
                            "char": 36
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 36,
                    "last-line": 43,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "open",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "savePath",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 43,
                            "char": 38
                        },
                        {
                            "type": "parameter",
                            "name": "name",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 43,
                            "char": 51
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 43,
                    "last-line": 50,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "read",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "id",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 50,
                            "char": 32
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 50,
                    "last-line": 57,
                    "char": 16
                },
                {
                    "visibility": [
                        "public"
                    ],
                    "type": "method",
                    "name": "write",
                    "parameters": [
                        {
                            "type": "parameter",
                            "name": "id",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 57,
                            "char": 33
                        },
                        {
                            "type": "parameter",
                            "name": "data",
                            "const": 0,
                            "data-type": "string",
                            "mandatory": 0,
                            "reference": 0,
                            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                            "line": 57,
                            "char": 46
                        }
                    ],
                    "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
                    "line": 57,
                    "last-line": 61,
                    "char": 16
                }
            ],
            "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
            "line": 3,
            "char": 5
        },
        "file": "\/media\/sf_devhttpd\/BlazePHP\/phpext\/blazephp\/blazephp\/session.zep",
        "line": 3,
        "char": 5
    }
]