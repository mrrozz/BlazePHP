
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


ZEPHIR_INIT_CLASS(BlazePHP_SessionConfig) {

	ZEPHIR_REGISTER_CLASS(BlazePHP, SessionConfig, blazephp, sessionconfig, NULL, 0);

	zend_declare_property_string(blazephp_sessionconfig_ce, SL("type"), "mysql", ZEND_ACC_PUBLIC TSRMLS_CC);

	zend_declare_property_null(blazephp_sessionconfig_ce, SL("id"), ZEND_ACC_PUBLIC TSRMLS_CC);

	return SUCCESS;

}

