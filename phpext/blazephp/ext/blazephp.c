
/* This file was generated automatically by Zephir do not modify it! */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <php.h>

#include "php_ext.h"
#include "blazephp.h"

#include <ext/standard/info.h>

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/globals.h"
#include "kernel/main.h"
#include "kernel/fcall.h"
#include "kernel/memory.h"



zend_class_entry *blazephp_struct_ce;
zend_class_entry *blazephp_helloworld_ce;
zend_class_entry *blazephp_lock_ce;
zend_class_entry *blazephp_log_ce;
zend_class_entry *blazephp_request_ce;
zend_class_entry *blazephp_session_ce;
zend_class_entry *blazephp_sessionconfig_ce;
zend_class_entry *blazephp_uniqueid_ce;

ZEND_DECLARE_MODULE_GLOBALS(blazephp)

PHP_INI_BEGIN()
	
PHP_INI_END()

static PHP_MINIT_FUNCTION(blazephp)
{
	REGISTER_INI_ENTRIES();
	zephir_module_init();
	ZEPHIR_INIT(BlazePHP_Struct);
	ZEPHIR_INIT(BlazePHP_HelloWorld);
	ZEPHIR_INIT(BlazePHP_Lock);
	ZEPHIR_INIT(BlazePHP_Log);
	ZEPHIR_INIT(BlazePHP_Request);
	ZEPHIR_INIT(BlazePHP_Session);
	ZEPHIR_INIT(BlazePHP_SessionConfig);
	ZEPHIR_INIT(BlazePHP_UniqueId);
	return SUCCESS;
}

#ifndef ZEPHIR_RELEASE
static PHP_MSHUTDOWN_FUNCTION(blazephp)
{
	zephir_deinitialize_memory(TSRMLS_C);
	UNREGISTER_INI_ENTRIES();
	return SUCCESS;
}
#endif

/**
 * Initialize globals on each request or each thread started
 */
static void php_zephir_init_globals(zend_blazephp_globals *blazephp_globals TSRMLS_DC)
{
	blazephp_globals->initialized = 0;

	/* Memory options */
	blazephp_globals->active_memory = NULL;

	/* Virtual Symbol Tables */
	blazephp_globals->active_symbol_table = NULL;

	/* Cache Enabled */
	blazephp_globals->cache_enabled = 1;

	/* Recursive Lock */
	blazephp_globals->recursive_lock = 0;

	/* Static cache */
	memset(blazephp_globals->scache, '\0', sizeof(zephir_fcall_cache_entry*) * ZEPHIR_MAX_CACHE_SLOTS);


}

/**
 * Initialize globals only on each thread started
 */
static void php_zephir_init_module_globals(zend_blazephp_globals *blazephp_globals TSRMLS_DC)
{

}

static PHP_RINIT_FUNCTION(blazephp)
{

	zend_blazephp_globals *blazephp_globals_ptr;
#ifdef ZTS
	tsrm_ls = ts_resource(0);
#endif
	blazephp_globals_ptr = ZEPHIR_VGLOBAL;

	php_zephir_init_globals(blazephp_globals_ptr TSRMLS_CC);
	zephir_initialize_memory(blazephp_globals_ptr TSRMLS_CC);


	return SUCCESS;
}

static PHP_RSHUTDOWN_FUNCTION(blazephp)
{
	
	zephir_deinitialize_memory(TSRMLS_C);
	return SUCCESS;
}

static PHP_MINFO_FUNCTION(blazephp)
{
	php_info_print_box_start(0);
	php_printf("%s", PHP_BLAZEPHP_DESCRIPTION);
	php_info_print_box_end();

	php_info_print_table_start();
	php_info_print_table_header(2, PHP_BLAZEPHP_NAME, "enabled");
	php_info_print_table_row(2, "Author", PHP_BLAZEPHP_AUTHOR);
	php_info_print_table_row(2, "Version", PHP_BLAZEPHP_VERSION);
	php_info_print_table_row(2, "Build Date", __DATE__ " " __TIME__ );
	php_info_print_table_row(2, "Powered by Zephir", "Version " PHP_BLAZEPHP_ZEPVERSION);
	php_info_print_table_end();

	DISPLAY_INI_ENTRIES();
}

static PHP_GINIT_FUNCTION(blazephp)
{
	php_zephir_init_globals(blazephp_globals TSRMLS_CC);
	php_zephir_init_module_globals(blazephp_globals TSRMLS_CC);
}

static PHP_GSHUTDOWN_FUNCTION(blazephp)
{

}


zend_function_entry php_blazephp_functions[] = {
ZEND_FE_END

};

zend_module_entry blazephp_module_entry = {
	STANDARD_MODULE_HEADER_EX,
	NULL,
	NULL,
	PHP_BLAZEPHP_EXTNAME,
	php_blazephp_functions,
	PHP_MINIT(blazephp),
#ifndef ZEPHIR_RELEASE
	PHP_MSHUTDOWN(blazephp),
#else
	NULL,
#endif
	PHP_RINIT(blazephp),
	PHP_RSHUTDOWN(blazephp),
	PHP_MINFO(blazephp),
	PHP_BLAZEPHP_VERSION,
	ZEND_MODULE_GLOBALS(blazephp),
	PHP_GINIT(blazephp),
	PHP_GSHUTDOWN(blazephp),
	NULL,
	STANDARD_MODULE_PROPERTIES_EX
};

#ifdef COMPILE_DL_BLAZEPHP
ZEND_GET_MODULE(blazephp)
#endif
