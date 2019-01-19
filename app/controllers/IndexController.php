<?php

class IndexController extends ControllerBase
{

    public function indexAction(int $id = 1)
    {
        $start = microtime(true);

        $children = $this->db->query('
            SELECT id, name, parent_id 
            FROM (SELECT * FROM region
                  ORDER BY parent_id, id) regions_sorted,
                 (SELECT @pv := \'' . $id . '\') initialization,
                 (SELECT @orig := \'' . $id . '\') initialization2
            WHERE (FIND_IN_SET(parent_id, @pv)
            AND LENGTH(@pv := concat(@pv, \',\', id)))
            OR id = @orig
        ')->fetchAll();

        $childrenIdentifiers = [];
        foreach ($children as $key => $child) {
            unset($children[$key][0], $children[$key][1], $children[$key][2]);
            $childrenIdentifiers[] = $child['id'];
        }
        unset($child);
        $childrenIdentifiers = '(' . implode(',', $childrenIdentifiers) . ')';

        $randomPeople = [];
        for ($i = 0; $i < 3; $i++) {
            $randomPeople[] = $this->db->query('
            SELECT p.* FROM people p
            JOIN ( SELECT RAND() * (SELECT MAX(id) FROM people) AS max_id ) AS m
            WHERE p.id >= m.max_id
            AND p.region_id in ' . $childrenIdentifiers . '
            ORDER BY p.id ASC
            LIMIT 1;')->fetch();
        }

        $findPath = function ($currentParentId, $path = []) use (&$findPath, $children) {
            $parent = null;
            foreach ($children as $region) {
                if ($region['id'] === $currentParentId) {
                    $parent = $region;
                    $path[] = [
                        'name' => $parent['name'],
                        'id' => $parent['id']
                    ];
                    break;
                }
            }

            if (null !== $parent) {
                $path = $findPath($parent['parent_id'], $path);
            }
             return $path;
        };

        $people = [];
        foreach ($randomPeople as $randomPerson) {
            $currentRegion = [];
            foreach ($children as $region) {
                if ($region['id'] === $randomPerson['region_id']) {
                    $currentRegion = $region;
                    break;
                }
            }
            $path = $findPath($currentRegion['parent_id']);
            $pathString = '';
            for ($i = count($path) - 1; $i >=0; $i--) {
                $pathString .= $path[$i]['name'] . '[' . $path[$i]['id'] . '] -> ';
            }
            $pathString .= $currentRegion['name'] . '[' . $currentRegion['id'] . ']';

            $people[] = [
                'id' => $randomPerson['id'],
                'region_id' => $randomPerson['region_id'],
                'name' => $randomPerson['name'],
                'path' => $pathString
            ];
        }

        $data = [
            'people' => $people,
            'time' => microtime(true) - $start
        ];

        $this->response->setJsonContent($data);
        return $this->response;
    }

}

