<?php

namespace App\Services;

class StingService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM Sting");
    }

    public function getOne($id)
    {
        return $this->db->fetchAll("SELECT * FROM Sting where id={$id}");
    }

    function save($note)
    {
        $this->db->insert("Sting", $note);
        return $this->db->lastInsertId();
    }

    function update($id, $job)
     {
        $jobcopy = $this->db->fetchAll("SELECT * FROM Sting where id={$id}")[0];
        foreach ($job as $key => $value) {
          if (!empty($value && $key !=="time")){
            $jobcopy[$key]=$value;
          }
        }
        $this->db->update('Sting', $jobcopy, ['id' => $id]);
        return $jobcopy;
    }

    function delete($id)
    {
        return $this->db->delete("Sting", array("id" => $id));
    }

}
