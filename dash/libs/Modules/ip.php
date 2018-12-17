<?php

    namespace Modules;

    class ip extends \ld\Modules\Module {
        protected $name = 'ip';

        public function getData($args=array()) {
            // First try to get the IPs using "ip"
            // First get list of links
            $command='/bin/ip -oneline link show | /usr/bin/awk \'{print $2}\' | /bin/sed "s/://"';

	    $result = array();

            exec($command, $result, $error);

            if ($error) { // It didn't work with "ip" , so we do it with ifconfig
                exec(
                    '/sbin/ifconfig | /bin/grep -B1 "inet addr" | /usr/bin/awk \'' .
                    '{ if ( $1 == "inet" ) { print $2 }' .
                    'else if ( $2 == "Link" ) { printf "%s:",$1 } }\' | /usr/bin/awk' .
                    ' -F: \'{ print $1","$3 }\'',
                    $result
                );

            } elseif ( !empty($result) ) {

                $resultCommand = implode(' ', $result);

                // Now use that list to get the ip-adresses
                $command = "for interface in {$resultCommand}; do" .
                   ' for family in inet inet6; do'.
                   ' /bin/ip -oneline -family $family addr show $interface |' .
                   ' /bin/grep -v fe80 | /usr/bin/awk \'{print $2","$4}\';' .
                   ' done; done';

		$result = array();

                exec($command, $result, $return_value);
            }

	    else {
		$result = "N/A";
	    }

            // Get external adress
            $result2 = file_get_contents('http://ipecho.net/plain');

            $data = array();
            $data[] = array('external ip', $result2);

            $x = 0;

            foreach ($result as $a) {

                $data[] = explode(',', $result[$x]);

                unset($result[$x],$a);

                $x++;
            }

            return $data;
        }
    }
