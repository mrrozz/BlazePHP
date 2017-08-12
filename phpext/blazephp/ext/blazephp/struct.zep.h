
extern zend_class_entry *blazephp_struct_ce;

ZEPHIR_INIT_CLASS(BlazePHP_Struct);

PHP_METHOD(BlazePHP_Struct, __get);
PHP_METHOD(BlazePHP_Struct, __set);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_struct___get, 0, 0, 1)
	ZEND_ARG_INFO(0, invalidAttribute)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_struct___set, 0, 0, 2)
	ZEND_ARG_INFO(0, invalidAttribute)
	ZEND_ARG_INFO(0, sValue)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_struct_method_entry) {
	PHP_ME(BlazePHP_Struct, __get, arginfo_blazephp_struct___get, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Struct, __set, arginfo_blazephp_struct___set, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
