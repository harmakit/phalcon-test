<?php

class PeopleController extends \Phalcon\Mvc\Controller
{

    public function getByIdAction(int $id)
    {
        $start = microtime(true);

        $people = People::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => $id
            ]
        ]);

        if (!$people) {
            $this->response->setJsonContent([]);
            return $this->response;
        }

        $data = [
            'people' => $people->toArray(),
            'time' => microtime(true) - $start
        ];

        $this->response->setJsonContent($data);
        return $this->response;
    }

    public function getByRegionIdAction(int $regionId, int $page = 1, int $limit = 5)
    {
        $start = microtime(true);

        $people = People::find([
            'conditions' => 'region_id = ?0',
            'bind' => [
                0 => $regionId
            ]
        ]);

        if (!$people) {
            $this->response->setJsonContent([
                'people' => [],
                'current page' => $page,
                'pages' => 0,
                'time' => microtime(true) - $start
            ]);
            return $this->response;
        }

        $data = [
            'people' => array_slice(
                $people->toArray(),
                $limit * ($page - 1),
                $limit
            ),
            'current page' => $page,
            'pages' => ceil(count($people) / $limit),
            'time' => microtime(true) - $start
        ];

        $this->response->setJsonContent($data);
        return $this->response;
    }

}

