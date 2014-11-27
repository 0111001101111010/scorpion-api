scorpion-api
============

Bioinformatics API for Old Dominion University C3Scorpion

Built with
---
- PHP 5.3+
- SQLite3
- Composer

Install composer
```
git clone http://github.com/stanzheng/scorpion-api
cd scorpion-api
curl -sS https://getcomposer.org/installer | php
composer install
sqlite3 app.db < resources/sql/schema.sql
php -S 0:9001 -t web/

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
  curl -X POST http://localhost:9001/api/v1/sting -d '{"title":"Canine!", "email": test@cs.odu.edu, "seq": "AA...AA", "name": "DogInfo", "sanitize":"no"}' -H 'Content-Type: application/json' -w "\n"

  #PUT (update)
  curl -X PUT http://localhost:9001/api/v1/sting/1 -d '{"title":"test"}' -H 'Content-Type: application/json' -w "\n"

  #DELETE
  curl -X DELETE http://localhost:9001/api/v1/sting/1 -H 'Content-Type: application/json' -w "\n"
