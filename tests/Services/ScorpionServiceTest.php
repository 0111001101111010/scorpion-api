<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\StingService;

date_default_timezone_set('America/Los_Angeles');

class ScorpionServiceTest extends \PHPUnit_Framework_TestCase
{

    private $noteService;

    public function setUp()
    {
        $app = new Application();
        $app->register(new DoctrineServiceProvider(), array(
            "db.options" => array(
                "driver" => "pdo_sqlite",
                "memory" => true
            ),
        ));
        $this->noteService = new StingService($app["db"]);

        $stmt = $app["db"]->prepare("CREATE TABLE Sting (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        seq VARCHAR NOT NULL,
        name VARCHAR NOT NULL,
        title VARCHAR NOT NULL,
        email VARCHAR NOT NULL,
        time  VARCHAR NOT NULL,
        pred_status BOOLEAN,
        sanitize BOOLEAN,
        pred_weights VARCHAR,
        pred_seq  VARCHAR,
        pred_time  VARCHAR)");
        $stmt->execute();
    }

    public function testGetAll()
    {
        $data = $this->noteService->getAll();
        $this->assertNotNull($data);
    }

    function testSave()
    {
        $note = array(
          "title" => "Wolf",
          "seq"   => "aaaaaacccaaaddddeeeeffaaaannnnnnnaaaccffaaaaaaeeeeeee",
          "email" => "test@email.com",
          "name"  => "animus caninus",
          "sanitize" => "no",
          "time" => date('Y-m-d H:i:s')
        );
        $data = $this->noteService->save($note);
        $data = $this->noteService->getAll();
        $this->assertEquals(1, count($data));
    }

    function testUpdate()
    {
        $note = array(
          "title" => "Wolf",
          "seq"   => "aaaaaacccaaaddddeeeeffaaaannnnnnnaaaccffaaaaaaeeeeeee",
          "email" => "test@email.com",
          "name"  => "animus caninus",
          "sanitize" => "no",
          "time" => date('Y-m-d H:i:s')
        );
        $this->noteService->save($note);
        $note = array(
          "title" => "Wolf",
          "seq"   => "aaaaaacccaaaddddeeeeffaaaannnnnnnaaaccffaaaaaaeeeeeee",
          "email" => "test@email.com",
          "name"  => "animus caninus",
          "sanitize" => "no",
          "time" => date('Y-m-d H:i:s')
        );
        $this->noteService->update(1, $note);
        $data = $this->noteService->getAll();
        $this->assertEquals("Wolf", $data[0]["title"]);

    }

    function testDelete()
    {
        $note = array(
          "title" => "Wolf",
          "seq"   => "aaaaaacccaaaddddeeeeffaaaannnnnnnaaaccffaaaaaaeeeeeee",
          "email" => "test@email.com",
          "name"  => "animus caninus",
          "sanitize" => "no",
          "time" => date('Y-m-d H:i:s')
        );
        $this->noteService->save($note);
        $this->noteService->delete(1);
        $data = $this->noteService->getAll();
        $this->assertEquals(0, count($data));
    }

}
