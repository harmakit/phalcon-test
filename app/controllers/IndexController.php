<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $model = Region::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [
                0 => 3
            ]
        ]);

        echo $model->getName();
        die();
    }

}

