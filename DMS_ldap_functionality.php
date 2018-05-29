<?php
require 'DMS_general_functions.php';
date_default_timezone_set('America/Chicago');
        class ldap { //Begin class
                //Global Vars
                var $config = array();

                /*------------------------------------------------------------------------------------------------*/
                /*  ldap($file): Reads the configuration file and loads information into an array             */
                /*------------------------------------------------------------------------------------------------*/
                public function ldap($file) {
                        $this->config = parse_ini_file($file, "ldap");
                }//end function ldap

                /*------------------------------------------------------------------------------------------------*/
                /*  ldapConnect(): Connects to the ldap server using PHP's ldap_connection function and loading   *
                /*                   information from the $this->config array. This is a private method.          */
                /*------------------------------------------------------------------------------------------------*/
                private function ldapConnect(){
                        $ldapConn = ldap_connect($this->config['ldap']['hosts'], $this->config['ldap']['port']);
                        if ($ldapConn) {
                                return $ldapConn;
                        }
                        else {
                                return false;
                        }
                }//end function ldapConnect

                /*------------------------------------------------------------------------------------------------*/
                /*  ldapBind($username, $password, $ldapConn): This method does three things:                     */
                /*                  1) Uses PHP's bind function to bind to LDAP and prepare for an action         */
                /*                  2) Searches ou=groups for the person attempting to login in LDAP              */
                /*                  3) If the person attempting to login is found, then searches ou=people        */
                /*                     for full name                                                              */
                /*              If the person attempting to login is found, returns full name, else return false  */
                /*------------------------------------------------------------------------------------------------*/
                private function ldapBind($username, $password, $ldapConn) {
                        ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
                        //echo "uid=" . $username . ",ou=people,dc=entdir,dc=utexas,dc=edu", $password;
                        @$ldapBind = ldap_bind( $ldapConn, "uid=" . $username. "," .
                                $this->config['ldap']['dn'], $password);
                        if (!$ldapBind) {
                                return "Unable to bind to ldap server!";
                        }
                        $ldapSearch = ldap_search( $ldapConn, $this->config['ldap']['group'], "(memberuid=" .
                                $username . ")", array( 'memberuid' ) );
                        $ldapInfo = ldap_get_entries( $ldapConn, $ldapSearch );
                        //var_dump($ldapInfo);
                        if ( $ldapInfo['count'] ) {
                            $sr = ldap_search($ldapConn, $this->config['ldap']['dn'], "uid=$username");
                            $info = ldap_get_entries($ldapConn, $sr);
                            //$name = $info[0]['cn'][0];
                        return $info;
                        }
                        else {
                            return(false);
                        }
                }//end function ldapBind

                /*------------------------------------------------------------------------------------------------*/
                /*  login($username, $password): Is used to verify the personal attempting to login is a valid    */
                /*            user. Method calls private methods ldapConn and ldapSearch                          */
                /*------------------------------------------------------------------------------------------------*/
                public function login($username, $password) {
                        //echo $username . "<br /> " . $password . PHP_EOL;

                        $ldapConn = $this->ldapConnect();
                        $ldapSearch = $this->ldapBind($username, $password, $ldapConn);
                        if (is_array($ldapSearch) ){
                                $_SESSION['username'] = $username;
                                $_SESSION['firstName'] = $ldapSearch[0]['givenname'][0];
                                $_SESSION['lastName'] = $ldapSearch[0]['sn'][0];
                                return(true);
                        }
                        else {
                                return(false);
                        }

                } //end function login

    }//end class ldap
	
?>