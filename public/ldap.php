<?php

$ldap_dn = "OU=".$_GET['username'].",dc=gov,dc=ae";
$ldap_pass = $_GET['password'] ?? null;

$ldap_con = ldap_connect('khalifafund.gov.ae');
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

if (ldap_bind($ldap_con, $ldap_dn, $ldap_pass)) {
    echo "Authenticated".PHP_EOL;
    $filter = "(OU=01_Users)";
    $result = ldap_search($ldap_con, "dc=gov,dc=ae", $filter) or exit('x');
    $entries = ldap_get_entries($ldap_con, $result);

    print("<pre>");
    print_r($entries);
    print("</pre>");
}

echo "done";
