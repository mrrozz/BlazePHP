
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
#include "kernel/exception.h"
#include "kernel/memory.h"
#include "kernel/fcall.h"
#include "kernel/concat.h"
#include "kernel/operators.h"


/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2013, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     Copyright 2012 - 2013, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
/**
 * Struct - A basic structure wrapper.  This is a very controlled way to create
 *          parameters for methods, template value holders, etc...
 *
 *          The goal of this class is to eliminate, as much as possible, the
 *          ambiguous nature of a template/class/method/etc
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
ZEPHIR_INIT_CLASS(BlazePHP_Struct) {

	ZEPHIR_REGISTER_CLASS(BlazePHP, Struct, blazephp, struct, blazephp_struct_method_entry, 0);

	return SUCCESS;

}

/**
 * Ensure that any attempt at accessing an invalid attribute method will
 * result in an ErrorException being thrown.
 *
 */
PHP_METHOD(BlazePHP_Struct, __get) {

	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *invalidAttribute_param = NULL, _0;
	zval invalidAttribute, _1;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&invalidAttribute);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_0);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &invalidAttribute_param);

	zephir_get_strval(&invalidAttribute, invalidAttribute_param);


	ZEPHIR_INIT_VAR(&_0);
	object_init_ex(&_0, zephir_get_internal_ce(SL("errorexception")));
	ZEPHIR_INIT_VAR(&_1);
	ZEPHIR_CONCAT_SV(&_1, "Trying to access an invalid attribute Struct::", &invalidAttribute);
	ZEPHIR_CALL_METHOD(NULL, &_0, "__construct", NULL, 1, &_1);
	zephir_check_call_status();
	zephir_throw_exception_debug(&_0, "blazephp/struct.zep", 38 TSRMLS_CC);
	ZEPHIR_MM_RESTORE();
	return;

}

PHP_METHOD(BlazePHP_Struct, __set) {

	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *invalidAttribute_param = NULL, *sValue, sValue_sub, _0;
	zval invalidAttribute, _1;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&invalidAttribute);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&sValue_sub);
	ZVAL_UNDEF(&_0);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &invalidAttribute_param, &sValue);

	zephir_get_strval(&invalidAttribute, invalidAttribute_param);


	ZEPHIR_INIT_VAR(&_0);
	object_init_ex(&_0, zephir_get_internal_ce(SL("errorexception")));
	ZEPHIR_INIT_VAR(&_1);
	ZEPHIR_CONCAT_SV(&_1, "Trying to write to an invalid attribute Struct::", &invalidAttribute);
	ZEPHIR_CALL_METHOD(NULL, &_0, "__construct", NULL, 1, &_1);
	zephir_check_call_status();
	zephir_throw_exception_debug(&_0, "blazephp/struct.zep", 43 TSRMLS_CC);
	ZEPHIR_MM_RESTORE();
	return;

}

