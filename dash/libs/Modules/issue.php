<?php

    namespace Modules;

    class issue extends \ld\Modules\Module {
        protected $name = 'issue';

        public function getData($args=array()) {
            return shell_exec('/usr/bin/lsb_release -ds;/bin/uname -r');
        }
    }
