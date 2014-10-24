/**
Description Mocks
**/
var request = require('request');
var _ = require('lodash');
var url = "localhost:3000/jobs";

var makePrediction = function(){
  request(url, function(err, res){
    if (err){
      return err;
    }
      if(res.statusCode === 200){
        var data = _.random(res.body);
        var id = data._id;
        request.put(url +'/' +id, function(err, res){
          console.log(res + "Success");
        });
      }
  });
};

setTimeout(makePrediction, 50000);
