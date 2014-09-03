var assert = require("assert");
var request = require("request");
var scorpion = require("../server");

var ms = require('mongoskin');
var db = ms.db('mongodb://localhost:27017/scorpion');


describe('Server', function(){
    it('Test Root Path', function(done){
      this.timeout(100000);
      var url = 'http://localhost:'+ process.env.PORT +'/jobs';
      console.log(url);
      request(url, function (err, res, html){
        if(res.statusCode === 200){
          console.log(res.body);
          assert.notEqual(res.body,[]);
          done();
        }
    });
  });
});

describe.skip('Request', function(){
    it('REQUEST Bob', function(done){
      this.timeout(10000);
      request('http://localhost:3000/bob', function (err, res, html){
        if(res.statusCode === 200){
          assert.equal(res.body,"Hello, bob!");
          done();
        }
    });
  });
});
