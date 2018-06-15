<?php

Class Crypt {

	private static $encryptionKey = 'Hs9kE8zXRKzoaH6UIhuaK3Iu5Z0KACic5ICCt2gT';
	private static $options = 0;


	public static function encrypt($data)
	{
		$initializationVector = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		return openssl_encrypt(serialize($data), 'aes-256-cbc', self::$encryptionKey, self::$options, $initializationVector).':'.$initializationVector;
	}


	public static function decrypt($encryptedData)
	{
		$dataArray = explode(':' , $encryptedData);

		$initializationVector = array_pop($dataArray);

		$encrypted = implode(':', $dataArray);

		return unserialize(openssl_decrypt($encrypted, 'aes-256-cbc', self::$encryptionKey, self::$options, $initializationVector));
	}


	public static function sqlEncrypt($pdoKey)
	{
		return 'AES_ENCRYPT('.$pdoKey.', "'.hash('sha512', self::$encryptionKey).'")';
	}


	public static function sqlDecrypt($column)
	{
		return 'AES_ENCRYPT('.$column.', "'.hash('sha512', self::$encryptionKey).'")';
	}


}
