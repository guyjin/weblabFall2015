<?php
    $myArray = ['Bob','Tom','Bill'];

    class selectMenu {
        private $items;  // array of items.
        private $options; // hold all html options
        private $selectMenu; // final select menu

        function __construct($itemArray='') {
            $this->items = $itemArray;
        }

        private function buildOptions() {
            $myOptions = "<option value=''>Select a Name</option>";
            forEach($this->items as $item) {
                $myOptions .= "<option value='"
                . $item . "'>"
                . $item . "</option>";
            }
            
            return $myOptions;
        }

        private function buildSelect($options) {
            $this->selectMenu = "<select>".$options."</select>";
        }

        public function setOptions($array) {
            $this->items = $array;
        }

        public function makeMenu() {
            // $this->buildOptions();
            $this->buildSelect($this->buildOptions());
            return $this->selectMenu;
        }
    }

    $myMenu = new selectMenu;
    $myMenu->setOptions($myArray);
    echo $myMenu->makeMenu();
 ?>
