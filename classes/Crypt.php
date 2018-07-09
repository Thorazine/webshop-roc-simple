<?php

Class Crypt {

	private static $encryptionKey = 'Hs9kE8zXRKzoaH6UIhuaK3Iu5Z0KACic5ICCt2gT';
	private static $sqlEncryptionKey = 'DDRpl5IUvbVHf5gydx2fCWiC1LnAzrSsAP8gGSTQ';
	private static $options = 0;
	private static $method = 'AES-128-CBC';
	private static $seperator = ':';

    /**
     * Returns an instance of the Encryptor class or creates the new instance if the instance is not created yet.
     * @return Encryptor
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Encryptor();
        }
        return self::$instance;
    }

    /**
     * Generates the initialization vector
     * @return string
     */
    private static function getIv()
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$method));
    }

    /**
     * @param string $data
     * @return string
     */
    public static function encrypt($data)
    {
        $iv = self::getIv();
        return base64_encode(openssl_encrypt($data, self::$method, self::$encryptionKey, 0, $iv) . self::$seperator . base64_encode($iv));
    }

    /**
     * @param string $dataAndVector
     * @return string
     */
    public static function decrypt($dataAndVector)
    {
        $parts = explode(self::$seperator, base64_decode($dataAndVector));
        // $parts[0] = encrypted data
        // $parts[1] = initialization vector
        return openssl_decrypt($parts[0], self::$method, self::$encryptionKey, 0, base64_decode($parts[1]));
    }


	public static function sqlEncrypt($pdoKey)
	{
		return 'AES_ENCRYPT('.$pdoKey.', \''.hash('sha512', self::$sqlEncryptionKey).'\')';
	}


	public static function sqlDecrypt($column)
	{
		return 'AES_DECRYPT('.$column.', \''.hash('sha512', self::$sqlEncryptionKey).'\')';
	}


}


$encrypted = Crypt::encrypt('1');
echo $encrypted.'<br><br>';
var_dump(Crypt::decrypt($encrypted));

echo '<br><br>';

echo 'INSERT INTO users
	(gender, active, first_name, last_name)
	VALUES
	("male", "1", "'.Crypt::sqlEncrypt(':first_name').'", "'.Crypt::sqlEncrypt(':last_name').'")';

echo '<br><br>';

echo 'SELECT id, gender, active, '.Crypt::sqlDecrypt('first_name').', '.Crypt::sqlDecrypt('last_name').' FROM users';
