
#ifdef HAVE_CONFIG_H
#include "../ext_config.h"
#endif

#include <php.h>
#include "../php_ext.h"
#include "../ext.h"

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/main.h"
#include "kernel/memory.h"
#include "kernel/object.h"
#include "kernel/array.h"
#include "kernel/string.h"
#include "kernel/concat.h"
#include "kernel/fcall.h"
#include "kernel/operators.h"


/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2015, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2015, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
/**
 * Request - Handles the detailed information about a reqeust
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
ZEPHIR_INIT_CLASS(BlazePHP_Request) {

	ZEPHIR_REGISTER_CLASS(BlazePHP, Request, blazephp, request, blazephp_request_method_entry, 0);

	zend_declare_property_null(blazephp_request_ce, SL("parameters"), ZEND_ACC_PROTECTED TSRMLS_CC);

	blazephp_request_ce->create_object = zephir_init_properties_BlazePHP_Request;
	return SUCCESS;

}

PHP_METHOD(BlazePHP_Request, __construct) {

	zend_string *_2;
	zend_ulong _1;
	zval *_REQUEST, name, value, *_0;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&name);
	ZVAL_UNDEF(&value);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_REQUEST, SL("_REQUEST"));
	if (!_REQUEST) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	zephir_is_iterable(_REQUEST, 0, "blazephp/request.zep", 35);
	ZEND_HASH_FOREACH_KEY_VAL(Z_ARRVAL_P(_REQUEST), _1, _2, _0)
	{
		ZEPHIR_INIT_NVAR(&name);
		if (_2 != NULL) { 
			ZVAL_STR_COPY(&name, _2);
		} else {
			ZVAL_LONG(&name, _1);
		}
		ZEPHIR_INIT_NVAR(&value);
		ZVAL_COPY(&value, _0);
		zephir_update_property_array(this_ptr, SL("parameters"), &name, &value TSRMLS_CC);
	} ZEND_HASH_FOREACH_END();
	ZEPHIR_INIT_NVAR(&value);
	ZEPHIR_INIT_NVAR(&name);
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Request, __get) {

	zval *name, name_sub, _0, _1, _2;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&name_sub);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &name);



	ZEPHIR_INIT_VAR(&_0);
	zephir_read_property(&_1, this_ptr, SL("parameters"), PH_NOISY_CC | PH_READONLY);
	if (zephir_array_isset(&_1, name)) {
		zephir_read_property(&_2, this_ptr, SL("parameters"), PH_NOISY_CC | PH_READONLY);
		zephir_array_fetch(&_0, &_2, name, PH_NOISY, "blazephp/request.zep", 40 TSRMLS_CC);
	} else {
		ZVAL_NULL(&_0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, getMethod) {

	zval *_SERVER, _0, _1;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	if (zephir_array_isset_string(_SERVER, SL("REQUEST_METHOD"))) {
		zephir_array_fetch_string(&_1, _SERVER, SL("REQUEST_METHOD"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 46 TSRMLS_CC);
		zephir_fast_strtoupper(&_0, &_1);
	} else {
		ZVAL_NULL(&_0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, getRequestedPath) {

	zval _0, _1;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);


	zephir_read_property(&_0, this_ptr, SL("parameters"), PH_NOISY_CC | PH_READONLY);
	zephir_array_fetch_string(&_1, &_0, SL("__requested_path"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 52 TSRMLS_CC);
	ZEPHIR_CONCAT_SV(return_value, "/", &_1);
	return;

}

PHP_METHOD(BlazePHP_Request, getHostConfig) {

	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *_SERVER, httphost, _0, _1, _2;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&httphost);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	if (zephir_array_isset_string(_SERVER, SL("HTTP_HOST"))) {
		zephir_array_fetch_string(&_0, _SERVER, SL("HTTP_HOST"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 59 TSRMLS_CC);
		ZEPHIR_INIT_VAR(&httphost);
		zephir_fast_strtolower(&httphost, &_0);
	} else {
		ZEPHIR_INIT_NVAR(&httphost);
		ZVAL_STRING(&httphost, "default");
	}
	ZEPHIR_INIT_VAR(&_1);
	ZVAL_STRING(&_1, "/[^a-z]/");
	ZEPHIR_INIT_VAR(&_2);
	ZVAL_STRING(&_2, "");
	ZEPHIR_RETURN_CALL_FUNCTION("preg_replace", NULL, 7, &_1, &_2, &httphost);
	zephir_check_call_status();
	RETURN_MM();

}

PHP_METHOD(BlazePHP_Request, isPOST) {

	zend_bool _1;
	zval *_SERVER, _0, _2, _3;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	_1 = zephir_array_isset_string(_SERVER, SL("REQUEST_METHOD"));
	if (_1) {
		ZEPHIR_INIT_VAR(&_2);
		zephir_array_fetch_string(&_3, _SERVER, SL("REQUEST_METHOD"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 66 TSRMLS_CC);
		zephir_fast_strtoupper(&_2, &_3);
		_1 = ZEPHIR_IS_STRING_IDENTICAL(&_2, "POST");
	}
	if (_1) {
		ZVAL_BOOL(&_0, 1);
	} else {
		ZVAL_BOOL(&_0, 0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, isGET) {

	zend_bool _1;
	zval *_SERVER, _0, _2, _3;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	_1 = zephir_array_isset_string(_SERVER, SL("REQUEST_METHOD"));
	if (_1) {
		ZEPHIR_INIT_VAR(&_2);
		zephir_array_fetch_string(&_3, _SERVER, SL("REQUEST_METHOD"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 74 TSRMLS_CC);
		zephir_fast_strtoupper(&_2, &_3);
		_1 = ZEPHIR_IS_STRING_IDENTICAL(&_2, "GET");
	}
	if (_1) {
		ZVAL_BOOL(&_0, 1);
	} else {
		ZVAL_BOOL(&_0, 0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, isPUT) {

	zend_bool _1;
	zval *_SERVER, _0, _2, _3;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	_1 = zephir_array_isset_string(_SERVER, SL("REQUEST_METHOD"));
	if (_1) {
		ZEPHIR_INIT_VAR(&_2);
		zephir_array_fetch_string(&_3, _SERVER, SL("REQUEST_METHOD"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 82 TSRMLS_CC);
		zephir_fast_strtoupper(&_2, &_3);
		_1 = ZEPHIR_IS_STRING_IDENTICAL(&_2, "PUT");
	}
	if (_1) {
		ZVAL_BOOL(&_0, 1);
	} else {
		ZVAL_BOOL(&_0, 0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, isDELETE) {

	zend_bool _1;
	zval *_SERVER, _0, _2, _3;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	_1 = zephir_array_isset_string(_SERVER, SL("REQUEST_METHOD"));
	if (_1) {
		ZEPHIR_INIT_VAR(&_2);
		zephir_array_fetch_string(&_3, _SERVER, SL("REQUEST_METHOD"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 90 TSRMLS_CC);
		zephir_fast_strtoupper(&_2, &_3);
		_1 = ZEPHIR_IS_STRING_IDENTICAL(&_2, "DELETE");
	}
	if (_1) {
		ZVAL_BOOL(&_0, 1);
	} else {
		ZVAL_BOOL(&_0, 0);
	}
	RETURN_CCTOR(&_0);

}

PHP_METHOD(BlazePHP_Request, isAJAX) {

	zend_bool _1;
	zval *_SERVER, _0, _2;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_2);

	ZEPHIR_MM_GROW();
	zephir_get_global(&_SERVER, SL("_SERVER"));
	if (!_SERVER) {
		ZEPHIR_THROW_EXCEPTION_STR(zend_exception_get_default(), "Invalid superglobal");
		return;
	}

	ZEPHIR_INIT_VAR(&_0);
	ZVAL_STRING(&_0, "HTTP_X_REQUESTED_WITH");
	_1 = zephir_array_key_exists(_SERVER, &_0 TSRMLS_CC);
	if (_1) {
		zephir_array_fetch_string(&_2, _SERVER, SL("HTTP_X_REQUESTED_WITH"), PH_NOISY | PH_READONLY, "blazephp/request.zep", 98 TSRMLS_CC);
		_1 = ZEPHIR_IS_STRING(&_2, "XMLHttpRequest");
	}
	RETURN_MM_BOOL(_1);

}

zend_object *zephir_init_properties_BlazePHP_Request(zend_class_entry *class_type TSRMLS_DC) {

		zval _0, _1$$3;
		ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1$$3);

		ZEPHIR_MM_GROW();
	
	{
		zval local_this_ptr, *this_ptr = &local_this_ptr;
		ZEPHIR_CREATE_OBJECT(this_ptr, class_type);
		zephir_read_property(&_0, this_ptr, SL("parameters"), PH_NOISY_CC | PH_READONLY);
		if (Z_TYPE_P(&_0) == IS_NULL) {
			ZEPHIR_INIT_VAR(&_1$$3);
			array_init(&_1$$3);
			zephir_update_property_zval(this_ptr, SL("parameters"), &_1$$3);
		}
		ZEPHIR_MM_RESTORE();
		return Z_OBJ_P(this_ptr);
	}

}

