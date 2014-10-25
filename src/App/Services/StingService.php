<?php

namespace App\Services;

class StingService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM Sting");
    }

    function save($note)
    {
        $this->db->insert("Sting", $note);
        return $this->db->lastInsertId();
    }

    function update($id, $note)
    {
        return $this->db->update('Sting', $note, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("Sting", array("id" => $id));
    }

}
