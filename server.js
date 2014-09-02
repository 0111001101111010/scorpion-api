var Hapi = require('hapi');
var server = new Hapi.Server(3000);

var ms = require('mongoskin');
var db = ms.db('mongodb://localhost:27017/scorpion');

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

server.route({
    method: 'POST',
    path: '/jobs',
    handler: function (request, reply) {
      console.log(request.payload);

      db.collection('scorpion').insert(request.payload, function(err, result) {
        if (err) {
          throw err;
        }
        if (result) {
          console.log('Added!');
          reply(result);
        }
      });
    }
});

server.start(function () {
    console.log('Server running at: Http://localhost:' + server.info.port);
});
