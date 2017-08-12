
extern zend_class_entry *blazephp_helloworld_ce;

ZEPHIR_INIT_CLASS(BlazePHP_HelloWorld);

PHP_METHOD(BlazePHP_HelloWorld, say);

ZEPHIR_INIT_FUNCS(blazephp_helloworld_method_entry) {
	PHP_ME(BlazePHP_HelloWorld, say, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_STATIC)
	PHP_FE_END
};
