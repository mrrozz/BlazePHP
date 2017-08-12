
extern zend_class_entry *blazephp_lock_ce;

ZEPHIR_INIT_CLASS(BlazePHP_Lock);

PHP_METHOD(BlazePHP_Lock, __construct);
PHP_METHOD(BlazePHP_Lock, __destruct);
PHP_METHOD(BlazePHP_Lock, fileLocation);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_lock___construct, 0, 0, 1)
	ZEND_ARG_INFO(0, procName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_lock_method_entry) {
	PHP_ME(BlazePHP_Lock, __construct, arginfo_blazephp_lock___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(BlazePHP_Lock, __destruct, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_DTOR)
	PHP_ME(BlazePHP_Lock, fileLocation, NULL, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
