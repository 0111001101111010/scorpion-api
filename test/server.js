var assert = require("assert");
var request = require("request");
var scorpion = require("../server");



describe('Server', function(){
    it('Test Root Path', function(done){
      this.timeout(10000);
      request('http://localhost:3000', function (err, res, html){
        if(res.statusCode === 200){
          console.log(res.body);
          assert.equal(res.body,"Hello, world!");
          done();
        }
    });
  });
});

describe('Request', function(){
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
