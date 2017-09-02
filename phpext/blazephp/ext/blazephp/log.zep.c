
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
#include "kernel/object.h"
#include "kernel/memory.h"
#include "kernel/operators.h"
#include "kernel/fcall.h"
#include "kernel/concat.h"
#include "kernel/exception.h"
#include "kernel/file.h"


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
 * Log
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
ZEPHIR_INIT_CLASS(BlazePHP_Log) {

	ZEPHIR_REGISTER_CLASS_EX(BlazePHP, Log, blazephp, log, blazephp_struct_ce, blazephp_log_method_entry, 0);

	zend_declare_property_null(blazephp_log_ce, SL("fp"), ZEND_ACC_PUBLIC TSRMLS_CC);

	zend_declare_property_null(blazephp_log_ce, SL("file"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_bool(blazephp_log_ce, SL("addTimeStamp"), 1, ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_null(blazephp_log_ce, SL("level"), ZEND_ACC_PUBLIC TSRMLS_CC);

	return SUCCESS;

}

PHP_METHOD(BlazePHP_Log, __construct) {

	zend_long level, ZEPHIR_LAST_CALL_STATUS;
	zval *namePrefix_param = NULL, *level_param = NULL, _0, _1, _2, _3, _4, _5, _6, _7, _8, _9$$4, _10$$4, _11$$4;
	zval namePrefix;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&namePrefix);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);
	ZVAL_UNDEF(&_4);
	ZVAL_UNDEF(&_5);
	ZVAL_UNDEF(&_6);
	ZVAL_UNDEF(&_7);
	ZVAL_UNDEF(&_8);
	ZVAL_UNDEF(&_9$$4);
	ZVAL_UNDEF(&_10$$4);
	ZVAL_UNDEF(&_11$$4);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &namePrefix_param, &level_param);

	zephir_get_strval(&namePrefix, namePrefix_param);
	level = zephir_get_intval(level_param);


	ZEPHIR_INIT_ZVAL_NREF(_0);
	ZVAL_LONG(&_0, level);
	zephir_update_property_zval(this_ptr, SL("level"), &_0);
	zephir_read_property(&_0, this_ptr, SL("level"), PH_NOISY_CC | PH_READONLY);
	if (ZEPHIR_LE_LONG(&_0, 0)) {
		RETURN_MM_NULL();
	}
	ZEPHIR_INIT_VAR(&_1);
	ZVAL_STRING(&_1, "/[^a-zA-Z0-9\\-_\\.]/");
	ZEPHIR_INIT_VAR(&_2);
	ZVAL_STRING(&_2, "_");
	ZEPHIR_CALL_FUNCTION(&_3, "preg_replace", NULL, 7, &_1, &_2, &namePrefix);
	zephir_check_call_status();
	zephir_get_strval(&namePrefix, &_3);
	ZEPHIR_INIT_NVAR(&_1);
	ZEPHIR_GET_CONSTANT(&_1, "ABS_VAR");
	ZEPHIR_INIT_NVAR(&_2);
	ZVAL_STRING(&_2, "Y-m-d");
	ZEPHIR_CALL_FUNCTION(&_4, "date", NULL, 2, &_2);
	zephir_check_call_status();
	ZEPHIR_INIT_VAR(&_5);
	ZEPHIR_CONCAT_VSVSVS(&_5, &_1, "/log/", &namePrefix, "-", &_4, ".log");
	zephir_update_property_zval(this_ptr, SL("file"), &_5);
	zephir_read_property(&_6, this_ptr, SL("file"), PH_NOISY_CC | PH_READONLY);
	ZEPHIR_INIT_NVAR(&_2);
	ZVAL_STRING(&_2, "a");
	ZEPHIR_CALL_FUNCTION(&_7, "fopen", NULL, 5, &_6, &_2);
	zephir_check_call_status();
	zephir_update_property_zval(this_ptr, SL("fp"), &_7);
	zephir_read_property(&_8, this_ptr, SL("fp"), PH_NOISY_CC | PH_READONLY);
	if (!zephir_is_true(&_8)) {
		ZEPHIR_INIT_VAR(&_9$$4);
		object_init_ex(&_9$$4, zend_exception_get_default(TSRMLS_C));
		zephir_read_property(&_10$$4, this_ptr, SL("file"), PH_NOISY_CC | PH_READONLY);
		ZEPHIR_INIT_VAR(&_11$$4);
		ZEPHIR_CONCAT_SSSSVS(&_11$$4, "BlazePHP\\Log", "::", "__construct", " - There has been an error trying to open the log file [", &_10$$4, "]");
		ZEPHIR_CALL_METHOD(NULL, &_9$$4, "__construct", NULL, 4, &_11$$4);
		zephir_check_call_status();
		zephir_throw_exception_debug(&_9$$4, "blazephp/log.zep", 49 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Log, __destruct) {

	zval _0, _1, _4, _2$$4, _3$$4;
	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_4);
	ZVAL_UNDEF(&_2$$4);
	ZVAL_UNDEF(&_3$$4);

	ZEPHIR_MM_GROW();

	zephir_read_property(&_0, this_ptr, SL("level"), PH_NOISY_CC | PH_READONLY);
	if (ZEPHIR_LE_LONG(&_0, 0)) {
		RETURN_MM_NULL();
	}
	zephir_read_property(&_1, this_ptr, SL("addTimeStamp"), PH_NOISY_CC | PH_READONLY);
	if (ZEPHIR_IS_FALSE_IDENTICAL(&_1)) {
		zephir_read_property(&_2$$4, this_ptr, SL("fp"), PH_NOISY_CC | PH_READONLY);
		ZEPHIR_INIT_VAR(&_3$$4);
		ZVAL_STRING(&_3$$4, "\n");
		ZEPHIR_CALL_FUNCTION(NULL, "fputs", NULL, 8, &_2$$4, &_3$$4);
		zephir_check_call_status();
	}
	zephir_read_property(&_4, this_ptr, SL("fp"), PH_NOISY_CC | PH_READONLY);
	zephir_fclose(&_4 TSRMLS_CC);
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Log, write) {

	zend_bool addNewLine, _0;
	zval message, _6$$5;
	zval *level_param = NULL, *message_param = NULL, *addNewLine_param = NULL, __$true, __$false, _1, _2, _7, _3$$4, _4$$4, _5$$4;
	zend_long level, ZEPHIR_LAST_CALL_STATUS;
	zval *this_ptr = getThis();

	ZVAL_BOOL(&__$true, 1);
	ZVAL_BOOL(&__$false, 0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_7);
	ZVAL_UNDEF(&_3$$4);
	ZVAL_UNDEF(&_4$$4);
	ZVAL_UNDEF(&_5$$4);
	ZVAL_UNDEF(&message);
	ZVAL_UNDEF(&_6$$5);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 1, &level_param, &message_param, &addNewLine_param);

	level = zephir_get_intval(level_param);
	zephir_get_strval(&message, message_param);
	if (!addNewLine_param) {
		addNewLine = 1;
	} else {
		addNewLine = zephir_get_boolval(addNewLine_param);
	}


	_0 = level <= 0;
	if (!(_0)) {
		zephir_read_property(&_1, this_ptr, SL("level"), PH_NOISY_CC | PH_READONLY);
		_0 = ZEPHIR_LT_LONG(&_1, level);
	}
	if (_0) {
		RETURN_MM_NULL();
	}
	zephir_read_property(&_2, this_ptr, SL("addTimeStamp"), PH_NOISY_CC | PH_READONLY);
	if (ZEPHIR_IS_TRUE_IDENTICAL(&_2)) {
		ZEPHIR_INIT_VAR(&_3$$4);
		ZVAL_STRING(&_3$$4, "Y-m-d H:i:s");
		ZEPHIR_CALL_FUNCTION(&_4$$4, "date", NULL, 2, &_3$$4);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(&_5$$4);
		ZEPHIR_CONCAT_SVSV(&_5$$4, "[", &_4$$4, "] ", &message);
		zephir_get_strval(&message, &_5$$4);
		if (0) {
			zephir_update_property_zval(this_ptr, SL("addTimeStamp"), &__$true);
		} else {
			zephir_update_property_zval(this_ptr, SL("addTimeStamp"), &__$false);
		}
	}
	if (addNewLine == 1) {
		ZEPHIR_INIT_VAR(&_6$$5);
		ZEPHIR_CONCAT_VS(&_6$$5, &message, "\n");
		ZEPHIR_CPY_WRT(&message, &_6$$5);
		if (1) {
			zephir_update_property_zval(this_ptr, SL("addTimeStamp"), &__$true);
		} else {
			zephir_update_property_zval(this_ptr, SL("addTimeStamp"), &__$false);
		}
	}
	zephir_read_property(&_7, this_ptr, SL("fp"), PH_NOISY_CC | PH_READONLY);
	ZEPHIR_CALL_FUNCTION(NULL, "fputs", NULL, 8, &_7, &message);
	zephir_check_call_status();
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Log, fileLocation) {

	zval *this_ptr = getThis();


	RETURN_MEMBER(getThis(), "file");

}

