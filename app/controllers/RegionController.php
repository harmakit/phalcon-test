<?php

class RegionController extends \Phalcon\Mvc\Controller
{

    public function getChildrenRegionIdAction($id)
    {
        $region = Region::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => $id
            ]
        ]);

        $children = $region->children;

        $this->response->setJsonContent($children->toArray());
        return $this->response;
    }

}

