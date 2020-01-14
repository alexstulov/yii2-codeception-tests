<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Codeception Tests</h1>
    <p>Here placed ready to work configs of unit, functional, api and acceptance test suites.</p>
</p>

<h2>Prepare application</h2>
Init project: `/path/to/php-bin/php /path/to/yii-application/init --env=Development --overwrite=All`

Install dependencies: `composer install`

Setup nginx:
```
server {
   	listen 80;
   	listen [::]:80;
   
   	root /var/www/yii-testing/frontend/web;
   
   	index index.php index-test.php;
   
   	server_name yii2testing;
   
   	location / {
   		try_files $uri $uri/ /index.php$is_args$args;
   	}
   
   	location ~ \.php$ {
   		include snippets/fastcgi-php.conf;
   		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
   	}
   
   	location ~ /\.ht {
   		deny all;
   	}
   }
```

<h2>Acceptance tests instructions</h2>
Install [jre](https://www.java.com/en/download/linux_manual.jsp).

Download and install [Selenium stand-alone sever](http://www.seleniumhq.org/download/).
 
Download and unpack [Chrome driver](https://chromedriver.chromium.org/).

Run Selenium: `java -jar -Dwebdriver.gecko.driver=./chromedriver ./selenium-server-standalone-x.x.x.jar`

Run web server in the app /web folder: `php -S 127.0.0.1:8080`