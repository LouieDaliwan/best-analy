<?php

$ldap_dn = "OU=01_Users,dc=gov,dc=ae";
$ldap_pass = $_GET['password'] ?? null;

$ldap_con = ldap_connect('khalifafund.gov.ae');
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);

if (ldap_bind($ldap_con, $ldap_dn)) {
    echo '<br>'."Authenticated".PHP_EOL.'<br>';
}

return json_encode(['success' => true]);
