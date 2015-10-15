<?php
    class Sample {
        public $public;
        protected $protected;
        private $private;

        public function __construct($foo="Bar") {
            $this->private = 'private';
            $this->public = $foo;
            $this->protected = 'protected';
        }

        public function showSample() {
            echo $this->private;
            echo $this->public;
            echo $this->protected;
        }

        public function setPrivate($foo) {
            $this->private = $foo;
        }

        public function getPrivate() {
            return $this->private;
        }
    }

    class newSample extends Sample {
        function showVars() {
            echo $this->getPrivate();
            echo $this->public;
            echo $this->protected;
        }
    }

    $test = new Sample('House');
    // $test->setPrivate('bar');
    // echo $test->getPrivate();
    // echo $test->public;

    $myTest = new newSample;
    echo $myTest->getPrivate();
    $myTest->showVars();













 ?>
