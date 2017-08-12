
extern zend_class_entry *blazephp_uniqueid_ce;

ZEPHIR_INIT_CLASS(BlazePHP_UniqueId);

PHP_METHOD(BlazePHP_UniqueId, make);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_uniqueid_make, 0, 0, 0)
	ZEND_ARG_INFO(0, prefix)
	ZEND_ARG_INFO(0, suffix)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_uniqueid_method_entry) {
	PHP_ME(BlazePHP_UniqueId, make, arginfo_blazephp_uniqueid_make, ZEND_ACC_PUBLIC|ZEND_ACC_STATIC)
	PHP_FE_END
};
