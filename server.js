var Hapi = require('hapi');
var server = new Hapi.Server(3000);

var db = require('mongoskin').db('localhost:27017/scorpion');

server.route({
    method: 'GET',
    path: '/job',
    handler: function (request, reply) {
      var response = db.collection('scorpion').find().toArray(function(err, result) {
      if (err) throw err;
      console.log(result);
        });
        reply(response);
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
      var response = db.collection('scorpion').find().toArray(function(err, result) {
      if (err) throw err;
      console.log(result);
        });
        reply(response);
    }
});

server.start(function () {
    console.log('Server running at: Http://localhost:' + server.info.port);
});
