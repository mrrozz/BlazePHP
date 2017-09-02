BlazePHP - A light weight (*seriously*), fast, horizontally scalable, professionals' framework.


### Prerequisites

1. PHP 7.0 or higher

2. Zephir (compatible with your version of PHP) (https://zephir-lang.com/)


### Installation

1. #### Clone the base BlazePHP repository into your desired location.

   ```shell:> git clone https://github.com/mrrozz/BlazePHP.git```

2. #### Compile and install the Zephir BlazePHP extension.

   ```
   shell:> cd BlazePHP/phpext/blazephp
   shell:> zephir build
   Preparing for PHP compilation...
   Preparing configuration file...
   Compiling...
   Installing...
   [sudo] password for dev-user:
   Extension installed!
   Don't forget to restart your web server
   shell:>
   ```

3. #### Make a test module.

	```
	shell:> cd ../../bin/
	shell:> ./make-module --module-type=api --module-name=test123
	Make directory structure for the api module [test123]:
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123/public
	        Writing public/index.php: SUCCESS
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123/conf
	        Writing default config: SUCCESS
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123/controller
	        Writing controller/mycontroller.ctlr.php: SUCCESS
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123/model
	    mkdir /media/sf_devhttpd/BlazePHP-test/module/mod-test123/manager
	SUCCESS
	MSG: Gathering the list of controllers:
	MSG: Processing module [MyController.ctlr.php] SUCCESS
	MSG: Writing 1 map(s) to file [/media/sf_devhttpd/BlazePHP-test/module/mod-test123/controller] SUCCESS
	MSG: Gathering the list of modules:
	MSG: Processing module [mod-test123] SUCCESS
	MSG: Writing 0 map(s) to file [{BlazePHP_ROOT}/module/object.map.php] SUCCESS
	shell:>
	```

4. #### Create the NGiNX configuration

	```
	shell:> sudo cd /etc/nginx/sites-available/
	shell:> sudo vi test.blazephp.local
	```

	```
	server {
	    listen   80;
	    server_name test.blazephp.local;

	    access_log  /var/log/nginx/test.blazephp.local.access.log;
	    root /YOUR/PATH/TO/BlazePHP/module/mod-test123/public/;
	    index index.php;

	    rewrite  ^/(.*)$  /index.php?__requested_path=/$1&$args  last;

	    location ~ \.php$ {
	    fastcgi_index  index.php;
	    fastcgi_param  REQUEST_URI      $request_uri;
	    fastcgi_param  QUERY_STRING     $query_string;
	    fastcgi_param  REQUEST_METHOD   $request_method;
	    fastcgi_param  CONTENT_TYPE     $content_type;
	    fastcgi_param  CONTENT_LENGTH   $content_length;
	    fastcgi_param  PRODUCTION       'false';
	    fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
	    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	    }
	}
	```

	```
	shell:> cd ../sites-enabled
	shell:> sudo ln -s ../sites-available/test.blazephp.local ./
	shell:> sudo service nginx restart
	```

5. #### Create *or link in this case to the default* the module configuration file

	```
	shell:> cd [YOUR BLAZE ROOT]/module/mod-test123/conf
	shell:> ln -s default.conf.php testblazephplocal.conf.php
	```

6. #### Test the module.

	```
	shell:> curl test.blazephp.local
	{"success":"My Action works!"}⏎
	```
