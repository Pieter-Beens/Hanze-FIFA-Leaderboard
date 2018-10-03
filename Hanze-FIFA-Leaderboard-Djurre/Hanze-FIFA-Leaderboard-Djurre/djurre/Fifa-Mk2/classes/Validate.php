<?php
class Validate {
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct(){
        $this->_db = new mysqli('localhost', 'root', '', 'fifa-project');
    }

    public function check($input, $items = array()){
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value){
                $value = trim($input[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                        break;
                        case 'matches':
                            if($value != $input[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->query("SELECT id FROM " .$rule_value. " WHERE " .$item. " = '$value'");
                            if($check->num_rows > 0){
                                $this->addError("{$item} already exists");
                            }
                        break;
                    }
                }
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}