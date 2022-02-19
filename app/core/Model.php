<?php

class Model
{
    protected $fileName;
    private $fileWay, $dataJson, $dataArray;


    protected function __construct()
    {
        $this->fileWay = "app/database/$this->fileName.json";
        $this->dataJson = file_get_contents($this->fileWay);
        $this->dataArray = json_decode($this->dataJson, true);
    }


    // Общая функция для получения данных (всей таблицы или конкретных данных)
    protected function getList($select, $filter = [])
    {
        if (!empty($filter)) {
            $desiredArrays = $this->filter($filter);
        }
        else {
            $desiredArrays = $this->dataArray;
        }

        if (!empty($select)) {
            $result = $this->select($desiredArrays, $select);
        }
        else {
            $result = $desiredArrays;
        }

        return $result;
    }


    // Для отбора нужных массивов
    private function filter($filter)
    {
        $countFilter = count($filter);
        $desiredArrays = [];
        
        foreach ($this->dataArray as $key => $array) {
            $count = 0;
            $found = 'not found';
            foreach ($filter as $param => $value) {
                if ($array[$param] == $value) {
                    $count++;
                    if ($count == $countFilter) {
                        $found = 'found';
                    }
                }
                else {
                    break;
                }
            }
            if ($found == 'found') {
                $desiredArrays += [$key => $array];
            }
        }

        return $desiredArrays;
    }


    // Для отбора конкретных данных
    private function select($desiredArrays, $select)
    {
        $selectArray = explode(", ", $select);
        $result = [];

        foreach ($desiredArrays as $key => $array) {
            $result += [$key => []];
            foreach ($selectArray as $param) {
                $result[$key] += [$param => $array[$param]];
            }
        }

        return $result;
    }


    // Общая функция для удаления данных
    protected function deleteList($filter = [])
    {
        if (!empty($filter)) {
            $desiredArrays = $this->filter($filter);
        }
        else {
            $desiredArrays = $this->dataArray;
        }

        foreach ($desiredArrays as $key => $array) {
            unset($this->dataArray[$key]);
        }

        $this->dataJson = json_encode($this->dataArray);
        file_put_contents($this->fileWay, $this->dataJson);
    }


    // Общая функция для обновления данных
    protected function updateList($set = [], $filter = [])
    {
        if (!empty($filter)) {
            $desiredArrays = $this->filter($filter);
        }
        else {
            $desiredArrays = $this->dataArray;
        }

        foreach ($desiredArrays as $key => $array) {
            foreach ($set as $param => $value) {
                $this->dataArray[$key][$param] = $value;
            }
        }

        $this->dataJson = json_encode($this->dataArray);
        file_put_contents($this->fileWay, $this->dataJson);
    }
    

    // Общая функция для добавления данных
    protected function insertList($data = [])
    {
        array_push($this->dataArray, $data);

        $this->dataJson = json_encode($this->dataArray);
        file_put_contents($this->fileWay, $this->dataJson);
    }
}
