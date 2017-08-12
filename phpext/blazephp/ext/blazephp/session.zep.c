
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
#include "kernel/operators.h"
#include "kernel/memory.h"
#include "kernel/object.h"
#include "kernel/fcall.h"


ZEPHIR_INIT_CLASS(BlazePHP_Session) {

	ZEPHIR_REGISTER_CLASS(BlazePHP, Session, blazephp, session, blazephp_session_method_entry, 0);

	zend_declare_property_null(blazephp_session_ce, SL("type"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_null(blazephp_session_ce, SL("id"), ZEND_ACC_PRIVATE TSRMLS_CC);

	return SUCCESS;

}

PHP_METHOD(BlazePHP_Session, __construct) {

	zend_long ZEPHIR_LAST_CALL_STATUS;
	zephir_fcall_cache_entry *_2 = NULL;
	zval *config, config_sub, _0, _1$$3, _3$$3, _4$$4;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&config_sub);
	ZVAL_UNDEF(&_0);
	ZVAL_UNDEF(&_1$$3);
	ZVAL_UNDEF(&_3$$3);
	ZVAL_UNDEF(&_4$$4);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &config);



	ZEPHIR_OBS_VAR(&_0);
	zephir_read_property(&_0, config, SL("id"), PH_NOISY_CC);
	if (ZEPHIR_IS_EMPTY(&_0)) {
		ZEPHIR_INIT_VAR(&_3$$3);
		ZVAL_STRING(&_3$$3, "blazephp_session_");
		ZEPHIR_CALL_CE_STATIC(&_1$$3, blazephp_uniqueid_ce, "make", &_2, 0, &_3$$3);
		zephir_check_call_status();
		zephir_update_property_zval(this_ptr, SL("id"), &_1$$3);
	} else {
		zephir_read_property(&_4$$4, config, SL("id"), PH_NOISY_CC | PH_READONLY);
		zephir_update_property_zval(this_ptr, SL("id"), &_4$$4);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(BlazePHP_Session, close) {

	zval *this_ptr = getThis();



}

PHP_METHOD(BlazePHP_Session, destroy) {

	zval *id_param = NULL;
	zval id;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&id);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &id_param);

	zephir_get_strval(&id, id_param);



}

PHP_METHOD(BlazePHP_Session, gc) {

	zval *maxLifeTime_param = NULL;
	zend_long maxLifeTime;
	zval *this_ptr = getThis();


	zephir_fetch_params(0, 1, 0, &maxLifeTime_param);

	maxLifeTime = zephir_get_intval(maxLifeTime_param);



}

PHP_METHOD(BlazePHP_Session, open) {

	zval *savePath_param = NULL, *name_param = NULL;
	zval savePath, name;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&savePath);
	ZVAL_UNDEF(&name);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &savePath_param, &name_param);

	zephir_get_strval(&savePath, savePath_param);
	zephir_get_strval(&name, name_param);



}

PHP_METHOD(BlazePHP_Session, read) {

	zval *id_param = NULL;
	zval id;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&id);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &id_param);

	zephir_get_strval(&id, id_param);



}

PHP_METHOD(BlazePHP_Session, write) {

	zval *id_param = NULL, *data_param = NULL;
	zval id, data;
	zval *this_ptr = getThis();

	ZVAL_UNDEF(&id);
	ZVAL_UNDEF(&data);

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &id_param, &data_param);

	zephir_get_strval(&id, id_param);
	zephir_get_strval(&data, data_param);



}

