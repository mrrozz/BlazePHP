
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
#include "kernel/fcall.h"
#include "kernel/time.h"
#include "kernel/operators.h"


ZEPHIR_INIT_CLASS(BlazePHP_UniqueId) {

	ZEPHIR_REGISTER_CLASS(BlazePHP, UniqueId, blazephp, uniqueid, blazephp_uniqueid_method_entry, 0);

	return SUCCESS;

}

PHP_METHOD(BlazePHP_UniqueId, make) {

	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *prefix_param = NULL, *suffix_param = NULL, __$true, lock, thisSecond, id, _0, _1, _2, _3, _4;
	zval prefix, suffix;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&prefix);
	ZVAL_UNDEF(&suffix);
	ZVAL_BOOL(&__$true, 1);
	ZVAL_UNDEF(&lock);
	ZVAL_UNDEF(&thisSecond);
	ZVAL_UNDEF(&id);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1);
	ZVAL_UNDEF(&_2);
	ZVAL_UNDEF(&_3);
	ZVAL_UNDEF(&_4);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 0, 2, &prefix_param, &suffix_param);

	if (!prefix_param) {
		ZEPHIR_INIT_VAR(&prefix);
		ZVAL_STRING(&prefix, "");
	} else {
		zephir_get_strval(&prefix, prefix_param);
	}
	if (!suffix_param) {
		ZEPHIR_INIT_VAR(&suffix);
		ZVAL_STRING(&suffix, "");
	} else {
		zephir_get_strval(&suffix, suffix_param);
	}


	ZEPHIR_INIT_VAR(&_0);
	ZVAL_STRING(&_0, "YmdHis");
	ZEPHIR_CALL_FUNCTION(&_1, "date", NULL, 2, &_0);
	zephir_check_call_status();
	ZEPHIR_INIT_NVAR(&_0);
	zephir_microtime(&_0, &__$true TSRMLS_CC);
	ZEPHIR_INIT_VAR(&thisSecond);
	ZEPHIR_CONCAT_VV(&thisSecond, &_1, &_0);
	ZEPHIR_INIT_VAR(&lock);
	object_init_ex(&lock, blazephp_lock_ce);
	ZEPHIR_INIT_VAR(&_2);
	ZEPHIR_CONCAT_SV(&_2, "blaze_session_lock-", &thisSecond);
	ZEPHIR_CALL_METHOD(NULL, &lock, "__construct", NULL, 8, &_2);
	zephir_check_call_status();
	ZVAL_LONG(&_3, 1);
	ZEPHIR_CALL_FUNCTION(&_4, "uniqid", NULL, 9, &_3, &__$true);
	zephir_check_call_status();
	ZEPHIR_INIT_VAR(&id);
	ZEPHIR_CONCAT_VVV(&id, &prefix, &_4, &suffix);
	ZEPHIR_INIT_NVAR(&lock);
	ZVAL_NULL(&lock);
	RETURN_CCTOR(&id);

}

