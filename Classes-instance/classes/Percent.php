<?php

class Percent {
    public $absolute;
    public $relative;
    public $hundred;
    public $nominal;

    public function __construct($new, $unit) {
        if ($unit == 0) {
            throw new Exception("Unit cannot be zero.");
        }

        $this->absolute = $this->formatNumber($new / $unit);
        $this->relative = $this->formatNumber(($new / $unit) - 1);
        $this->hundred  = $this->formatNumber(($new / $unit) * 100);

        if ($new / $unit > 1) {
            $this->nominal = 'positive';
        } elseif ($new / $unit == 1) {
            $this->nominal = 'status-quo';
        } else {
            $this->nominal = 'negative';
        }
    }

    public function formatNumber($number) {
        return number_format($number, 2, '.', '');
    }
}
