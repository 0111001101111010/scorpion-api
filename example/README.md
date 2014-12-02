Scorpion Example
----


Show supported HTTP RESTful conventions in various languages
---

- CURL
- NODE
- PYTHON
- PHP
- RUBY

```python
import urllib2
#GET
urllib2.urlopen("http://localhost:9001/api/v1/sting").read()

```

```ruby
require "net/http"

#GET
uri = URI("http://localhost:9001/api/v1/sting")
res = Net::HTTP.get_response(uri)
puts res.body if res.is_a?(Net::HTTPSuccess)

```
