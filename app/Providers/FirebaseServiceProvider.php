<?php

namespace App\Providers;

use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider {
    private $credentials = __DIR__ . "/../../credentials.json";
    private $firebase, $table, $database, $reference;

    // Connection Parameter reference to table
    public function connect($reference = ""){
        $this->firebase = (new Factory)
            ->withServiceAccount($this->credentials)
            ->withDatabaseUri("https://pbo-campway-default-rtdb.asia-southeast1.firebasedatabase.app");
        $this->database = $this->firebase->createDatabase();

        if ($reference != "") {
            $this->reference = $reference;
            $this->table = $this->database->getReference($reference);
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
        $this->table = $this->table
            ->orderByKey()
            ->equalTo($uuid);

        return $this;
    }


    public function findByChild($child, $value){
        $this->table = $this->table
            ->orderByChild($child)
            ->equalTo($value);

        return $this;
    }

    // Get Data
    public function equalTo($child ,$value){
        return $this->table
                    ->orderByChild($child)
                    ->equalTo($value)
                    ->getValue();
    }


    // Get Data
    public function get(){
        return $this->table->getvalue();
    }


    // Yah Where lahya
    public function where($column,$operator,$valueWhere){
        $this->table = $this->table
                        ->orderByChild($column);
        $data = $this->table->getvalue();    
        $arr = [];
        
        switch ($operator) {
            case 'like':
                foreach ($data as $key => $value) {
                    if (is_int(strpos($value[$column],$valueWhere))) {
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
                    if ($value[$column] == $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '>':
                foreach ($data as $key => $value) {
                    if ($value[$column] == $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '>=':
                foreach ($data as $key => $value) {
                    if ($value[$column] == $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            case '<=':
                foreach ($data as $key => $value) {
                    if ($value[$column] == $valueWhere) {
                        $arr[$key] = $value;
                    }
                }
                break;
            default:
                break;
        }

        return $arr;
    }
}