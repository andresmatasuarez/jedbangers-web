<?php
/**
 * Jedbangers config file.
 */

abstract class Config {

  static $ENV                  = null;
  static $RECAPTCHA_SECRET     = null;
  static $RECAPTCHA_PUBLIC     = null;
  static $SENDGRID_USERNAME    = null;
  static $SENDGRID_PASSWORD    = null;
  static $SENDGRID_OPTIONS     = null;
  static $CONTACT_FORM_TO      = null;
  static $SUBSCRIPTION_FORM_TO = null;
  static $FB_APP_ID            = null;

  static $DATABASE_URL         = null;
  static $TABLE_PREFIX         = null;

  static $AUTH_KEY             = null;
  static $SECURE_AUTH_KEY      = null;
  static $LOGGED_IN_KEY        = null;
  static $NONCE_KEY            = null;
  static $AUTH_SALT            = null;
  static $SECURE_AUTH_SALT     = null;
  static $LOGGED_IN_SALT       = null;
  static $NONCE_SALT           = null;

}

Config::$ENV                  = getenv('ENV')                  ? getenv('ENV')                  : 'development';
Config::$RECAPTCHA_SECRET     = getenv('RECAPTCHA_SECRET_KEY') ? getenv('RECAPTCHA_SECRET_KEY') : '6LdJQPsSAAAAAPR785D6gMWnB6wWppIqTzWmt8B1';
Config::$RECAPTCHA_PUBLIC     = getenv('RECAPTCHA_PUBLIC_KEY') ? getenv('RECAPTCHA_PUBLIC_KEY') : '6LdJQPsSAAAAANTzbkrSJBRnZ5emZm_emcxQaYiK';
Config::$SENDGRID_USERNAME    = getenv('SENDGRID_USERNAME')    ? getenv('SENDGRID_USERNAME')    : 'app32279133@heroku.com';
Config::$SENDGRID_PASSWORD    = getenv('SENDGRID_PASSWORD')    ? getenv('SENDGRID_PASSWORD')    : 'nmurhx20';
Config::$FB_APP_ID            = getenv('FB_APP_ID')            ? getenv('FB_APP_ID')            : '660565487397732'; // fbAppId: '369629269872839' // PRODUCTION
Config::$SENDGRID_OPTIONS     = getenv('ENV') !== 'production' ? array('turn_off_ssl_verification' => true) : array();

Config::$CONTACT_FORM_TO      = 'amatasuarez@gmail.com';
Config::$SUBSCRIPTION_FORM_TO = 'amatasuarez@gmail.com';

// DB settings
if (getenv('DATABASE_URL')){
  Config::$DATABASE_URL = getenv('DATABASE_URL');
} else if (getenv('CLEARDB_DATABASE_URL')){
  Config::$DATABASE_URL = getenv('CLEARDB_DATABASE_URL');
} else {
  Config::$DATABASE_URL = 'mysql://admin_jeds:1@localhost/jeds';
}

Config::$TABLE_PREFIX = getenv('TABLE_PREFIX') ? getenv('TABLE_PREFIX') : 'jeds_wp_';

// Wordpress auth keys
Config::$AUTH_KEY         = getenv('AUTH_KEY')         ? getenv('AUTH_KEY')         : '&{zy^EZ#4 fNec5dqnb+D(9F pCu[kE*[GVRx}xK~iUWWwS<`O|[Fy#HES!RGrT}';
Config::$SECURE_AUTH_KEY  = getenv('SECURE_AUTH_KEY')  ? getenv('SECURE_AUTH_KEY')  : '^%~L%2trYf+}?wqt5m*FH-,Qd-q`gV9Jl7keV/~YKt8H%9^v6i)HUF*:(&n~m0j|';
Config::$LOGGED_IN_KEY    = getenv('LOGGED_IN_KEY')    ? getenv('LOGGED_IN_KEY')    : '*+Xclmn+AyqTw/T_iDc7Zce(J~_@eunGQat^q:|*>~|R|6}1!%Uq3K=l;X|+YaTm';
Config::$NONCE_KEY        = getenv('NONCE_KEY')        ? getenv('NONCE_KEY')        : 'wL;$ZO:#^*Oq&#UN4BPx0-e}Zzzm=(^Ps I++T+`abtgO29XJxB8eE,%9Jvf`2BC';
Config::$AUTH_SALT        = getenv('AUTH_SALT')        ? getenv('AUTH_SALT')        : 'dtxc&:v56%Kx-4 kRcx_*ui@&G_6Q/f>|b:6=OsEA~eNlPxlPv4?C(;q{|^@yI)6';
Config::$SECURE_AUTH_SALT = getenv('SECURE_AUTH_SALT') ? getenv('SECURE_AUTH_SALT') : '{cFUTp&]OPNSa:/H*(=-|=Q<!h;PnUCmD=.AXR+<en|MrunjQ{h[Dq(HjwoN50@G';
Config::$LOGGED_IN_SALT   = getenv('LOGGED_IN_SALT')   ? getenv('LOGGED_IN_SALT')   : 'phf:{C?p@6`oPNQQwldlc;%LNEU~hM4+aH7 q[nlBu5DiBslir.xL-^o/x|<=izp';
Config::$NONCE_SALT       = getenv('NONCE_SALT')       ? getenv('NONCE_SALT')       : '(xF${={k9>rM^8=U 1+5#8$:oa]07(?VBW}t|3a$:A(XL1/wIZGa$@])H J|D4(v';


?>
