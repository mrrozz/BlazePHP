
extern zend_class_entry *blazephp_session_ce;

ZEPHIR_INIT_CLASS(BlazePHP_Session);

PHP_METHOD(BlazePHP_Session, __construct);
PHP_METHOD(BlazePHP_Session, close);
PHP_METHOD(BlazePHP_Session, destroy);
PHP_METHOD(BlazePHP_Session, gc);
PHP_METHOD(BlazePHP_Session, open);
PHP_METHOD(BlazePHP_Session, read);
PHP_METHOD(BlazePHP_Session, write);

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session___construct, 0, 0, 1)
	ZEND_ARG_OBJ_INFO(0, config, BlazePHP\\SessionConfig, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session_destroy, 0, 0, 1)
	ZEND_ARG_INFO(0, id)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session_gc, 0, 0, 1)
	ZEND_ARG_INFO(0, maxLifeTime)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session_open, 0, 0, 2)
	ZEND_ARG_INFO(0, savePath)
	ZEND_ARG_INFO(0, name)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session_read, 0, 0, 1)
	ZEND_ARG_INFO(0, id)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_blazephp_session_write, 0, 0, 2)
	ZEND_ARG_INFO(0, id)
	ZEND_ARG_INFO(0, data)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(blazephp_session_method_entry) {
	PHP_ME(BlazePHP_Session, __construct, arginfo_blazephp_session___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(BlazePHP_Session, close, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Session, destroy, arginfo_blazephp_session_destroy, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Session, gc, arginfo_blazephp_session_gc, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Session, open, arginfo_blazephp_session_open, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Session, read, arginfo_blazephp_session_read, ZEND_ACC_PUBLIC)
	PHP_ME(BlazePHP_Session, write, arginfo_blazephp_session_write, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
