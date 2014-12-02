Scorpion Example
----


Show supported HTTP RESTful conventions in various languages
---

- CURL
- NODE
- PYTHON
- PHP
- RUBY

```javascript
var http = require('http');

http.get("http://localhost:9001/api/v1/sting", function(res) {
  console.log("Got response: " + res.statusCode);
  }).on('error', function(e) {
    console.log("Got error: " + e.message);
    });
```

```python
import urllib2
#GET
urllib2.urlopen("http://localhost:9001/api/v1/sting").read()

```

```php
<?php

$json = file_get_contents('http://localhost:9001/api/v1/sting');

print $json;
```

```ruby
require "net/http"

#GET
uri = URI("http://localhost:9001/api/v1/sting")
res = Net::HTTP.get_response(uri)
puts res.body if res.is_a?(Net::HTTPSuccess)

```
