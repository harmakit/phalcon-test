<?php

class PeopleController extends \Phalcon\Mvc\Controller
{

    public function getByIdAction(int $id)
    {
        $people = People::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => $id
            ]
        ]);

        $this->response->setJsonContent($people->toArray());
        return $this->response;
    }
    public function getByRegionIdAction(int $regionId)
    {
        $region = Region::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => $regionId
            ]
        ]);

        $people = $region->people;

        $this->response->setJsonContent($people->toArray());
        return $this->response;
    }

}

