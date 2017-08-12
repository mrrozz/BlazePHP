
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
#include "kernel/concat.h"
#include "kernel/memory.h"
#include "kernel/object.h"
#include "kernel/file.h"
#include "ext/date/php_date.h"
#include "kernel/fcall.h"
#include "kernel/array.h"
#include "kernel/string.h"
#include "kernel/exception.h"


ZEPHIR_INIT_CLASS(BlazePHP_Lock) {

	ZEPHIR_REGISTER_CLASS_EX(BlazePHP, Lock, blazephp, lock, blazephp_struct_ce, blazephp_lock_method_entry, 0);

	zend_declare_property_null(blazephp_lock_ce, SL("lockFileLocation"), ZEND_ACC_PRIVATE TSRMLS_CC);

	return SUCCESS;

}

PHP_METHOD(BlazePHP_Lock, __construct) {

	zval _7$$3;
	zephir_fcall_cache_entry *_15 = NULL;
	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *procName, procName_sub, _0, _1, _2, now$$3, fileTime$$3, diff$$3, fileAge$$3, _3$$3, _4$$3, _5$$3, _6$$3, _8$$3, _9$$3, _10$$3, _11$$3, _12$$3, _13$$3, _14$$3, _16$$3, _17$$3, fp$$4, _18$$4, _19$$4, _20$$4;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&procName_sub);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&now$$3);
	ZVAL_UNDEF(&fileTime$$3);
	ZVAL_UNDEF(&diff$$3);
	ZVAL_UNDEF(&fileAge$$3);
	ZVAL_UNDEF(&_3$$3);
	ZVAL_UNDEF(&_4$$3);
	ZVAL_UNDEF(&_5$$3);
	ZVAL_UNDEF(&_6$$3);
	ZVAL_UNDEF(&_8$$3);
	ZVAL_UNDEF(&_9$$3);
	ZVAL_UNDEF(&_10$$3);
	ZVAL_UNDEF(&_11$$3);
	ZVAL_UNDEF(&_12$$3);
	ZVAL_UNDEF(&_13$$3);
	ZVAL_UNDEF(&_14$$3);
	ZVAL_UNDEF(&_16$$3);
	ZVAL_UNDEF(&_17$$3);
	ZVAL_UNDEF(&fp$$4);
	ZVAL_UNDEF(&_18$$4);
	ZVAL_UNDEF(&_19$$4);
	ZVAL_UNDEF(&_20$$4);
	ZVAL_UNDEF(&_7$$3);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &procName);



	ZEPHIR_INIT_VAR(&_0);
	ZEPHIR_GET_CONSTANT(&_0, "ABS_VAR");
	ZEPHIR_INIT_VAR(&_1);
	ZEPHIR_CONCAT_VSVS(&_1, &_0, "/lock/", procName, ".lock");
	zephir_update_property_zval(this_ptr, SL("lockFileLocation"), &_1);
	zephir_read_property(&_2, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
	if ((zephir_file_exists(&_2 TSRMLS_CC) == SUCCESS)) {
		ZEPHIR_INIT_VAR(&now$$3);
		object_init_ex(&now$$3, php_date_get_date_ce());
		ZEPHIR_CALL_METHOD(NULL, &now$$3, "__construct", NULL, 0);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(&fileTime$$3);
		object_init_ex(&fileTime$$3, php_date_get_date_ce());
		ZEPHIR_INIT_VAR(&_3$$3);
		zephir_read_property(&_4$$3, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
		zephir_filemtime(&_3$$3, &_4$$3 TSRMLS_CC);
		ZEPHIR_INIT_VAR(&_5$$3);
		ZVAL_STRING(&_5$$3, "Y-m-d H:i:s");
		ZEPHIR_CALL_FUNCTION(&_6$$3, "date", NULL, 2, &_5$$3, &_3$$3);
		zephir_check_call_status();
		ZEPHIR_CALL_METHOD(NULL, &fileTime$$3, "__construct", NULL, 0, &_6$$3);
		zephir_check_call_status();
		ZEPHIR_CALL_METHOD(&diff$$3, &now$$3, "diff", NULL, 0, &fileTime$$3);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(&_7$$3);
		zephir_create_array(&_7$$3, 6, 0 TSRMLS_CC);
		zephir_read_property(&_8$$3, &diff$$3, SL("d"), PH_NOISY_CC | PH_READONLY);
		ZEPHIR_INIT_VAR(&_9$$3);
		ZEPHIR_CONCAT_VS(&_9$$3, &_8$$3, " days, ");
		zephir_array_fast_append(&_7$$3, &_9$$3);
		zephir_read_property(&_10$$3, &diff$$3, SL("h"), PH_NOISY_CC | PH_READONLY);
		ZVAL_LONG(&_11$$3, 2);
		ZVAL_LONG(&_12$$3, 0);
		ZVAL_LONG(&_13$$3, 0);
		ZEPHIR_CALL_FUNCTION(&_14$$3, "str_pad", &_15, 3, &_10$$3, &_11$$3, &_12$$3, &_13$$3);
		zephir_check_call_status();
		zephir_array_fast_append(&_7$$3, &_14$$3);
		ZEPHIR_INIT_NVAR(&_5$$3);
		ZVAL_STRING(&_5$$3, ":");
		zephir_array_fast_append(&_7$$3, &_5$$3);
		zephir_read_property(&_11$$3, &diff$$3, SL("i"), PH_NOISY_CC | PH_READONLY);
		ZVAL_LONG(&_12$$3, 2);
		ZVAL_LONG(&_13$$3, 0);
		ZVAL_LONG(&_16$$3, 0);
		ZEPHIR_CALL_FUNCTION(&_14$$3, "str_pad", &_15, 3, &_11$$3, &_12$$3, &_13$$3, &_16$$3);
		zephir_check_call_status();
		zephir_array_fast_append(&_7$$3, &_14$$3);
		ZEPHIR_INIT_NVAR(&_5$$3);
		ZVAL_STRING(&_5$$3, ":");
		zephir_array_fast_append(&_7$$3, &_5$$3);
		zephir_read_property(&_12$$3, &diff$$3, SL("s"), PH_NOISY_CC | PH_READONLY);
		ZVAL_LONG(&_13$$3, 2);
		ZVAL_LONG(&_16$$3, 0);
		ZVAL_LONG(&_17$$3, 0);
		ZEPHIR_CALL_FUNCTION(&_14$$3, "str_pad", &_15, 3, &_12$$3, &_13$$3, &_16$$3, &_17$$3);
		zephir_check_call_status();
		zephir_array_fast_append(&_7$$3, &_14$$3);
		ZEPHIR_INIT_VAR(&fileAge$$3);
		zephir_fast_join_str(&fileAge$$3, SL(""), &_7$$3 TSRMLS_CC);
		ZEPHIR_INIT_NVAR(&_5$$3);
		object_init_ex(&_5$$3, zend_exception_get_default(TSRMLS_C));
		zephir_read_property(&_13$$3, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
		ZEPHIR_INIT_LNVAR(_9$$3);
		ZEPHIR_CONCAT_SVSVSVS(&_9$$3, "The lock file exists for [", procName, "], age: [", &fileAge$$3, "], location: [", &_13$$3, "]");
		ZEPHIR_CALL_METHOD(NULL, &_5$$3, "__construct", NULL, 4, &_9$$3);
		zephir_check_call_status();
		zephir_throw_exception_debug(&_5$$3, "blazephp/lock.zep", 31 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	} else {
		zephir_read_property(&_18$$4, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
		ZEPHIR_INIT_VAR(&_19$$4);
		ZVAL_STRING(&_19$$4, "w");
		ZEPHIR_CALL_FUNCTION(&fp$$4, "fopen", NULL, 5, &_18$$4, &_19$$4);
		zephir_check_call_status();
		zephir_read_property(&_20$$4, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
		zephir_fwrite(NULL, &fp$$4, &_20$$4 TSRMLS_CC);
		zephir_fclose(&fp$$4 TSRMLS_CC);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Lock, __destruct) {

	zval _0;
	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&_0);

	ZEPHIR_MM_GROW();

	zephir_read_property(&_0, this_ptr, SL("lockFileLocation"), PH_NOISY_CC | PH_READONLY);
	ZEPHIR_CALL_FUNCTION(NULL, "unlink", NULL, 6, &_0);
	zephir_check_call_status();
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Lock, fileLocation) {

	zval *this_ptr = getThis();


	RETURN_MEMBER(getThis(), "lockFileLocation");

}

