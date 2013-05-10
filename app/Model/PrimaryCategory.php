<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'SecondaryCategory.php';
/**
 * Description of PrimaryCategory
 *
 * @author baba
 */
class PrimaryCategory implements Iterator {
    private $subject = '';
    private $total_price = 0;
    private $rate = 0;
    private $children = array();
    
    public function __construct($subject) {
        $this->subject = $subject;
    }
    
    public function subject() {
        return $this->subject;
    }
    
    public function totalPrice() {
        return $this->total_price;
    }
    
    public function rate() {
        return $this->rate;
    }
    
    public function add($secondary_category, $price) {
        if (isset($secondary_category)) {
            if (array_key_exists($secondary_category, $this->children)) {
                $this->children[$secondary_category]->add($price);
            } else {
                $child = new SecondaryCategory($secondary_category);
                $child->add($price);
                $this->children[$secondary_category] = $child;
            }
            $this->total_price += $price;
        }
    }

    public function current() {
        return current($this->children);
    }

    public function key() {
        return key($this->children);
    }

    public function next() {
        return next($this->children);
    }

    public function rewind() {
        reset($this->children);
    }

    public function valid() {
        return ($this->current() != false);
    }
    
    public function calcRate($total) {
        $this->rate = round(((double)$this->total_price / $total) * 100);
        
        foreach ($this->children as $child) {
            $child->calcRate($total);
        }
    }
}

?>
