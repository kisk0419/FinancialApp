<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'PrimaryCategory.php';
/**
 * Description of CategorySummary
 *
 * @author baba
 */
class CategorySummary implements Iterator {
    private $categories = array();
    
    public function add($primary_category, $secondary_category, $price) {
        if (isset($primary_category)) {
            if (!array_key_exists($primary_category, $this->categories)) {
                $this->categories[$primary_category] = new PrimaryCategory($primary_category);
            }
            $this->categories[$primary_category]->add($secondary_category, $price);
        }
    }
    
    public function totalPrice() {
        $total_price = 0;
        foreach ($this->categories as $category) {
            $total_price += $category->totalPrice();
        }
        return $total_price;
    }
    
    public function calcRate() {
        $total_price = $this->totalPrice();
        foreach ($this->categories as $category) {
           $category->calcRate($total_price);
        }
    }
    
    public function current() {
        return current($this->categories);
    }

    public function key() {
        return key($this->categories);
    }

    public function next() {
        return next($this->categories);
    }

    public function rewind() {
        reset($this->categories);
    }

    public function valid() {
        return ($this->current() != false);
    }
}

?>
