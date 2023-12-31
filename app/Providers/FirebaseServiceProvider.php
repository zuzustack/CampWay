<?php

namespace App\Providers;

use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider {
    private $credentials = __DIR__ . "/../../credentials.json";
    private $firebase, $table, $database, $reference, $result;
    private $afterQuery = false;

    // Connection Parameter reference to table
    public function connect($reference = ""){
        $this->firebase = (new Factory)
            ->withServiceAccount($this->credentials)
            ->withDatabaseUri("https://pbo-campway-default-rtdb.asia-southeast1.firebasedatabase.app");
        $this->database = $this->firebase->createDatabase();

        if ($reference != "") {
            $this->afterQuery = true;
            $this->reference = $reference;
            $this->table = $this->database->getReference($reference);
            $this->result = $this->table->getValue();
        }
        return $this;
    }

    // Set Table / Reference
    public function setTable($reference){
        $this->reference = $reference;
        $this->table = $this->database->getReference($reference);
        return $this;
    }

    // Create
    public function create($build){
        $this->table->push($build);
        return $this->table->getvalue();
    }


    // Update
    public function update($uuid,$build){
        $table = $this->database->getReference("$this->reference/$uuid")->update($build);
        return $table->getvalue();
    }


    // Delete
    public function delete($uuid){
        $table = $this->database->getReference("$this->reference/$uuid")->remove();
        return $this->table->getvalue();
    }


    // Find by id
    public function find($uuid){
        $this->afterQuery = true;
        $this->result = $this->table
            ->orderByKey()
            ->equalTo($uuid)
            ->getValue();

        return $this;
    }


    public function findByChild($child, $value){
        $this->afterQuery = true;
        $this->result = $this->table
            ->orderByChild($child)
            ->equalTo($value)
            ->get();

        return $this;
    }

    public function orderBy($child, $by = "asc"){
        uasort($this->result, function($a,$b) use($child, $by) {
            $valueA = (string)$a[$child];
            $valueB = (string)$b[$child];

            if ($by == "asc") {
                $test = strcmp($valueA,$valueB);
            } else {
                $test = strcmp($valueB,$valueA);
            }

            if ($test == 0) {
                return 0;
            } else if ($test > 0) {
                return 1;
            } else {
                return -1;
            }

        });
        return $this;
    }


    // JOIN LAH YA
    public function join($reference, $foreignId, $localId, $name = "join1"){
        $this->afterQuery = true;
        $table = $this->database->getReference($reference)->getValue();

        foreach ($this->result as $key => $value) {
            foreach ($table as $keyT => $valueT) {
                if ($localId == 'id' && $value[$foreignId] == $keyT) {
                    $this->result[$key][$name] = $valueT;
                    $this->result[$key][$name]['uuid'] = $keyT;
                }
            }
        }

        return $this;
    }

    public function limitAndSkip($limit, $skip){
        $arr = [];
        $index = 1;
        foreach ($this->result as $key => $value) {
            if ($index > $skip) {
                $arr[$key] = $value;
            }

            if ($index >= ($limit + $skip)) {
                break;
            } else {
                $index++;
            }
        }

        $this->result = $arr;
        return $this;
    }

    // Get Data
    public function equalTo($child ,$value){
        $this->afterQuery = true;
        $this->result = $this->table
            ->orderByChild($child)
            ->equalTo($value)
            ->getValue();
        return $this;
    }


    // Get Data
    public function get(){
        if ($this->afterQuery) {
            return $this->result;
        } else {
            return $this->table->getValue();
        }
    }


    // Yah Where lahya
    public function where($column,$operator,$valueWhere){
        if (!$this->afterQuery) {
            $this->table = $this->table
                ->orderByChild($column);
            $data = $this->table->getvalue(); 
        } else {
            $data = $this->result;
        }
        $this->afterQuery = true;

        $arr = [];
        
        switch ($operator) {
            case 'like':
                foreach ($data as $key => $value) {
                    if (is_int(strpos($value[$column],$valueWhere))) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case 'ilike':
                foreach ($data as $key => $value) {
                    if (is_int(strpos(strtolower($value[$column]),strtolower($valueWhere)))) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '=':
                foreach ($data as $key => $value) {
                    if ($value[$column] == $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '<':
                foreach ($data as $key => $value) {
                    if ($value[$column] < $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '>':
                foreach ($data as $key => $value) {
                    if ($value[$column] > $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '>=':
                foreach ($data as $key => $value) {
                    if ($value[$column] >= $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '<=':
                foreach ($data as $key => $value) {
                    if ($value[$column] <= $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            default:
                break;
        }

        $this->result = $arr;
        return $this;
    }
}