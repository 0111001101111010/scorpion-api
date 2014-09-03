var Hapi = require('hapi');
var server = new Hapi.Server(process.env.PORT || 3000);
var Joi = require('joi');
var moment = require('moment');

var ms = require('mongoskin');

var mongoUri = process.env.MONGOLAB_URI ||
  process.env.MONGOHQ_URL ||
  'mongodb://localhost:27017/scorpion';
var db = ms.db(mongoUri);
/*
Job Object:
@param title - name of string submission REQ
@param input_seq - sequence
@param email - REQ
@param fasta_format - default false
*/

var Job = function Job(obj) {
  return {
    "title": obj.title,
    "input_seq":  obj.input_seq,
    "email": obj.email,
    "fasta_format": obj.fasta_format,
  };
}

var Status = function Status(job) {
  return {
    "job": job,
    "completed": false,
    "time": moment().format()
  };
}
/*
Data Scheme


*/

server.route({
    method: 'GET',
    path: '/jobs',
    handler: function (request, reply) {
      db.collection('scorpion').find().toArray(function(err, result) {
          if (err) throw err;
          console.log(result);
          reply(result);
      });
    }
});

/** Get a specific Job **/
server.route({
    method: 'GET',
    path: '/jobs/{id}',
    handler: function (request, reply) {
    db.collection('scorpion').find({'_id':ms.ObjectID(request.params.id)}).toArray(function(err, result) {
      if (err) throw err;
      console.log(result);
      reply(result);
    });
    }
});

/** Update from the server job response**/
server.route({
    method: 'PUT',
    path: '/jobs/{id}',
    handler: function (request, reply) {
    db.collection('scorpion').update({'_id':ms.ObjectID(request.params.id)},
    {
    '$set': {
         response: "MYSTRINGHEREOFGENETICS",
         completed: true
      }
  },
  function(err, result) {
      if (err) throw err;
      console.log(result);
      reply(result);
    });
    }
});

server.route({
    method: 'POST',
    path: '/jobs',
    config: {
    handler: function (request, reply) {
      console.log(request.payload);
      var j = new Job(request.payload);
      var doc = new Status(j);
      db.collection('scorpion').insert(doc, function(err, result) {
        if (err) {
          throw err;
        }
        if (result) {
          console.log('Added!');
          reply(result);
        }
      });
    },
      validate: {
        payload: {
          title: Joi.string().required(),
          input_seq: Joi.string().required(),
          email: Joi.string().required(),
          fasta_format: Joi.string().optional()
        }
      }
    }
});



server.start(function () {
    console.log('Server running at: Http://localhost:' + server.info.port);
});
