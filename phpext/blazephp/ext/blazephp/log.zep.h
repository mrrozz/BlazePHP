
extern zend_class_entry *blazephp_log_ce;

ZEPHIR_INIT_CLASS(BlazePHP_Log);

PHP_METHOD(BlazePHP_Log, __construct);
PHP_METHOD(BlazePHP_Log, __destruct);
PHP_METHOD(BlazePHP_Log, write);
PHP_METHOD(BlazePHP_Log, fileLocation);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_log___construct, 0, 0, 2)
	ZEND_ARG_INFO(0, namePrefix)
	ZEND_ARG_INFO(0, level)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_log_write, 0, 0, 2)
	ZEND_ARG_INFO(0, level)
	ZEND_ARG_INFO(0, message)
	ZEND_ARG_INFO(0, addNewLine)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_log_method_entry) {
	PHP_ME(BlazePHP_Log, __construct, arginfo_blazephp_log___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(BlazePHP_Log, __destruct, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_DTOR)
	PHP_ME(BlazePHP_Log, write, arginfo_blazephp_log_write, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Log, fileLocation, NULL, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
