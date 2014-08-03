var assert = require("assert");
var request = require("request");
var scorpion = require("../server");



describe('Server', function(){
    beforeEach(function(){
      console.log('Test Requests');
    });
    it('Test Root Path', function(done){
      this.timeout(10000);
      request('http://localhost:3000', function (err, res, html){
        console.log(res.statusCode);
        if(res.statusCode === 200){
          console.log(res.body);
          assert.equal(res.body,"Hello, world!");
          done();
        }
    });
  });
});
