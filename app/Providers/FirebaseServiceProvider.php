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
            ->withDatabaseUri(env("FIREBASE_URL"));
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


    // Get Data
    public function get(){
        return $this->table->getvalue();
    }


    // Yah Where lahya
    public function where($column,$operator,$value){
        $this->table = $this->table
                        ->orderByChild($column);
        $data = $this->table->getvalue();    
        $arr = [];
        
        switch ($operator) {
            case 'like':
                foreach ($data as $dt) {
                    if (is_int(strpos($dt[$column],$value))) {
                        array_push($arr,$dt);
                    }
                }
                break;
            case '=':
                foreach ($data as $dt) {
                    if ($dt[$column] == $value) {
                        array_push($arr,$dt);
                    }
                }
                break;
            case '<':
                foreach ($data as $dt) {
                    if ($dt[$column] < $value) {
                        array_push($arr,$dt);
                    }
                }
                break;
            case '>':
                foreach ($data as $dt) {
                    if ($dt[$column] > $value) {
                        array_push($arr,$dt);
                    }
                }
                break;
            case '>=':
                foreach ($data as $dt) {
                    if ($dt[$column] >= $value) {
                        array_push($arr,$dt);
                    }
                }
                break;
            case '<=':
                foreach ($data as $dt) {
                    if ($dt[$column] <= $value) {
                        array_push($arr,$dt);
                    }
                }
                break;
            default:
                # code...
                break;
        }

        return $arr;
    }
}