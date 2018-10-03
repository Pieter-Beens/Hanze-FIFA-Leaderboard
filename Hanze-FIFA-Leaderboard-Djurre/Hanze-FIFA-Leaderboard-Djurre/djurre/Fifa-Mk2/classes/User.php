<?php
 class User {
     private    $_db,
                $_data,
                $_isLoggedIn;

     public function __construct($user = null) {
         $this->_db = new mysqli('localhost', 'root', '', 'fifa-project');

         if (!$user) {
             if (Session::exists('user')) {
                 $user = Session::get('user');

                 if ($this->find($user)) {
                     $this->_isLoggedIn = true;
                 } else {
                     //logout
                 }
             }
         } else {
             $this->find($user);
         }
     }

     public function update($fields = array(), $id = null){
         if(!$id && $this->isLoggedIn()) {
             $id = $this->data()->id;
         }

         $set = '';
         $x = 1;

         foreach ($fields as $name=> $value) {
             $set .= $name ."='". $value ."'";
             if ($x < count($fields)) {
                 $set .= ', ';
                 $x++;
             }
         }

         if(!$this->_db->query("UPDATE users SET ".$set." WHERE id='$id'")) {
             throw new Exception('There was a problem updating');
         }
     }

     public function create($fields = array()) {
         $values = '';
         $x = 1;
         foreach ($fields as $field) {
             $values .= "'".$field."'";
             if ($x < count($fields)) {
                 $values .= ', ';
             }
             $x++;
         }

         if(!$this->_db->query("INSERT INTO users (username, password, salt, name, permission) VALUES (". $values .")")) {
             throw new Exception('There was a problem creating an account');
         }
     }

     public function find($user = null) {
         if($user){
             $field = (is_numeric($user)) ? 'id' : 'username';
             $data = $this->_db->query("SELECT * FROM users WHERE ".$field."='$user'");

             if ($data->num_rows > 0) {
                 $this->_data = $data->fetch_object();
                 return true;
             }
         }
         return false;
     }

     public function login($username = null, $password = null, $remember = false) {
         if (!$username && !$password && $this->exists()) {
             Session::put('user', $this->data()->id);
         } else {
             $user = $this->find($username);
             if($user) {
                 if($this->data()->password === Hash::make($password, $this->data()->salt)) {
                     Session::put('user', $this->data()->id);

                     if ($remember){
                         $hash = Hash::unique();
                         $hashCheck = $this->_db->query("SELECT * FROM users_session WHERE user_id='".$this->data()->id."'");

                         if ($hashCheck->num_rows <= 0) {
                             $this->_db->query("INSERT INTO users_session (user_id, hash) VALUES ('".$this->data()->id."', '$hash')");
                         } else {
                             $value = $hashCheck->fetch_array();
                             $hash = $value['hash'];
                         }

                         Cookie::put('hash', $hash, 604800);
                     }
                     return true;
                 }
             }
         }
         return false;
     }

     public function hasPermission($key) {
         $group = $this->_db->query("SELECT * FROM permissions WHERE id='".$this->data()->permission."'")->fetch_object();

         if ($group) {
             $permissions = json_decode($group->level, true);

             if ($permissions[$key] == true) {
                 return true;
             }
         }
         return false;
     }

     public function exists(){
         return (!empty($this->_data)) ? true : false;
     }

     public function logout() {
         $this->_db->query("DELETE FROM users_session WHERE user_id='".$this->data()->id."'");

         Session::delete('user');
         Cookie::delete('hash');
     }

     public function data() {
         return $this->_data;
     }

     public function isLoggedIn() {
         return $this->_isLoggedIn;
     }
 }