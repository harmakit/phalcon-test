<?php

class RegionController extends \Phalcon\Mvc\Controller
{

    public function getChildrenRegionIdAction(int $id, int $page = 1, int $limit = 5)
    {
        $start = microtime(true);

        $region = Region::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => $id
            ]
        ]);

        if (!$region) {
            $this->response->setJsonContent([
                'people' => [],
                'current page' => $page,
                'pages' => 0,
                'time' => microtime(true) - $start
            ]);
            return $this->response;
        }

        $children = $region->children;

        $data = [
            'people' => array_slice(
                $children->toArray(),
                $limit * ($page - 1),
                $limit
            ),
            'current page' => $page,
            'pages' => ceil(count($children) / $limit),
            'time' => microtime(true) - $start
        ];

        $this->response->setJsonContent($data);
        return $this->response;
    }

}

