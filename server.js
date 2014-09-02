var Hapi = require('hapi');
var server = new Hapi.Server(3000);

var db = require('mongoskin').db('mongodb://localhost:27017/scorpion');

server.route({
    method: 'GET',
    path: '/job',
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
    path: '/job/{id}',
    handler: function (request, reply) {
        reply('Job, ' + encodeURIComponent(request.params.id) + '!');
    }
});

server.route({
    method: 'POST',
    path: '/job',
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
