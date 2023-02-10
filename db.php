<?php
$conn=mysqli_connect($_SERVERNAME,$_USERNAME,$_PASSWORD);
mysqli_select_db($conn,$_DBNAME);

mysqli_query($conn,'SET NAMES "utf8" COLLATE "utf8_general_ci"' );
mysqli_query($conn,"SET time_zone='-4:00';");
date_default_timezone_set('US/Eastern');

$websiteName="";

function encrypt($str)
{
	$key = '1xd2ws3a';
    # Add PKCS7 padding.
    $block = mcrypt_get_block_size('des', 'ecb');
    if (($pad = $block - (strlen($str) % $block)) < $block) {
      $str .= str_repeat(chr($pad), $pad);
    }

    return mcrypt_encrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
}

function decrypt($str)
{
	$key = '1xd2ws3a';
    $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);

    # Strip padding out.
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    if ($pad && $pad < $block && preg_match(
          '/' . chr($pad) . '{' . $pad . '}$/', $str
                                            )
       ) {
      return substr($str, 0, strlen($str) - $pad);
    }
    return $str;
}

function encrypt1($string) {
  $key = '1xd2ws3a';
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }

  return base64_encode($result);
}

function decrypt1($string) {
	$key = '1xd2ws3a';
  $result = '';
  $string = base64_decode($string);

  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }

  return $result;
}


function rand_string( ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$length =20;
	$str = "";
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


?>