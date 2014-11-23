# Silex Simple REST
[![Latest Stable Version](https://poser.pugx.org/vesparny/silex-simple-rest/v/stable.png)](https://packagist.org/packages/vesparny/silex-simple-rest) [![Total Downloads](https://poser.pugx.org/vesparny/silex-simple-rest/downloads.png)](https://packagist.org/packages/vesparny/silex-simple-rest) [![Build Status](https://secure.travis-ci.org/vesparny/silex-simple-rest.png)](http://travis-ci.org/vesparny/silex-simple-rest) [![Dependency Status](https://www.versioneye.com/user/projects/53d0e4eacca8fffeb200006d/badge.png)](https://www.versioneye.com/user/projects/53d0e4eacca8fffeb200006d)


A simple silex skeleton application for writing RESTful API. Developed and maintained by [Alessandro Arnodo](http://alessandro.arnodo.net).

**This project wants to be a starting point to writing scalable and maintainable REST api with Silex PHP micro-framework**

Continuous Integration is provided by [Travis-CI](http://travis-ci.org/).

####How do I run it?
After download the last [release](https://github.com/vesparny/silex-simple-rest/releases), from the root folder of the project, run the following commands to install the php dependencies, import some data, and run a local php server.

You need at least php **5.4.*** with **SQLite extension** enabled and **Composer**

    composer install
    sqlite3 app.db < resources/sql/schema.sql
    php -S 0:9001 -t web/

You can install the project also as a composer project

		composer create-project vesparny/silex-simple-rest

Your api is now available at http://localhost:9001/api/v1.

####Run tests
Some tests were written, and all CRUD operations are fully tested :)

From the root folder run the following command to run tests.

    vendor/bin/phpunit

####Sting Relations
MYSQL Table
```
CREATE TABLE Sting (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    seq VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    title VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    time  VARCHAR NOT NULL,
    pred_status BOOLEAN,
    pred_weights VARCHAR,
    pred_seq  VARCHAR,
    pred_time  VARCHAR
);
```


####What you will get
The api will respond to

	GET  ->   http://localhost:9001/api/v1/sting
	POST ->   http://localhost:9001/api/v1/sting
	PUT ->   http://localhost:9001/api/v1/sting/{id}
	DELETE -> http://localhost:9001/api/v1/sting/{id}

Your request should have 'Content-Type: application/json' header.
Your api is CORS compliant out of the box, so it's capable of cross-domain communication.

Try with curl:

	#GET
	curl http://localhost:9001/api/v1/sting -H 'Content-Type: application/json' -w "\n"

	#POST (insert)
	curl -X POST http://localhost:9001/api/v1/sting -d '{"note":"Hello World!"}' -H 'Content-Type: application/json' -w "\n"

	#PUT (update)
	curl -X PUT http://localhost:9001/api/v1/sting/1 -d '{"note":"Uhauuuuuuu!"}' -H 'Content-Type: application/json' -w "\n"

	#DELETE
	curl -X DELETE http://localhost:9001/api/v1/sting/1 -H 'Content-Type: application/json' -w "\n"

####What's under the hood
Take a look at the source code, it's self explanatory :)
More documentation and info about the code will be available soon.

Under the resources folder you can find a .htaccess file to put the api in production.

####Contributing

Fell free to contribute, fork, pull request, hack. Thanks!

####Author of Module


+	[@stanzheng](https://twitter.com/stanzheng)


## License MIT

see LICENSE file.
