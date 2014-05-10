<?
if (!isset( $_SERVER["HTTPS"]) || strtolower($_SERVER["HTTPS"]) != "on" ) {
    echo "<html><body>Use HTTPS</body></html>";
    die();
}


session_start();
if (!isset($_SESSION['phpCAS']['user'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR .
"/groups/courserequest/public_html/php/p/CAS-1.3.2");
    require_once('CAS.php');
    phpCAS::setDebug();
    phpCAS::client(CAS_VERSION_2_0, 'muidp.muohio.edu', 443, '/cas');
    phpCAS::setNoCasServerValidation();
    phpCAS::forceAuthentication();
}

$USER = $_SESSION['phpCAS']['user'];
?>
