
extern zend_class_entry *blazephp_request_ce;

ZEPHIR_INIT_CLASS(BlazePHP_Request);

PHP_METHOD(BlazePHP_Request, __construct);
PHP_METHOD(BlazePHP_Request, __get);
PHP_METHOD(BlazePHP_Request, getMethod);
PHP_METHOD(BlazePHP_Request, getRequestedPath);
PHP_METHOD(BlazePHP_Request, getHostConfig);
PHP_METHOD(BlazePHP_Request, isPOST);
PHP_METHOD(BlazePHP_Request, isGET);
PHP_METHOD(BlazePHP_Request, isPUT);
PHP_METHOD(BlazePHP_Request, isDELETE);
PHP_METHOD(BlazePHP_Request, isAJAX);
zend_object *zephir_init_properties_BlazePHP_Request(zend_class_entry *class_type TSRMLS_DC);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_request___get, 0, 0, 1)
	ZEND_ARG_INFO(0, name)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_request_method_entry) {
	PHP_ME(BlazePHP_Request, __construct, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(BlazePHP_Request, __get, arginfo_blazephp_request___get, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, getMethod, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, getRequestedPath, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, getHostConfig, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, isPOST, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, isGET, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, isPUT, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, isDELETE, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Request, isAJAX, NULL, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
