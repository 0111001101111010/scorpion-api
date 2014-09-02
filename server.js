var Hapi = require('hapi');
var server = new Hapi.Server(3000);

var db = require('mongoskin').db('localhost:27017/scorpion');

server.route({
    method: 'GET',
    path: '/job',
    handler: function (request, reply) {
        reply(db.scorpion.find());
    }
});

server.route({
    method: 'GET',
    path: '/job/{id}',
    handler: function (request, reply) {
        reply('Job, ' + encodeURIComponent(request.params.id) + '!');
    }
});

server.start(function () {
    console.log('Server running at: Http://localhost:' + server.info.port);
});
