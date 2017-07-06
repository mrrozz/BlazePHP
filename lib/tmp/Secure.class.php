<?php
use Aws\Kms\KmsClient;


class Secure
{
	private static function crypt($type, $string, $contextArray)
	{
		if(empty($string)) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'The value to '.$type.' is empty.'
			)));
		}

		try{
			$client = KmsClient::factory(G::$env->awsKMSClientConfig);

			$encConfig = array();
			$encConfig['KeyId']     = G::$env->awsKMSARNKeyId;

			if(is_array($contextArray)) {
				$encConfig['EncryptionContext'] = $contextArray;
			}

			if($type === 'encrypt') {
				$encConfig['Plaintext'] = $string;
				$encrypted = $client->encrypt($encConfig);
				return base64_encode($encrypted['CiphertextBlob']);
			}
			elseif($type === 'decrypt') {
				$encConfig['CiphertextBlob'] = base64_decode($string);
				$decrypted = $client->decrypt($encConfig);
				return $decrypted['Plaintext'];
			}

		}
		catch(Exception $e) {
			throw new Exception( implode(' ', array(
				 __CLASS__.'::'.__FUNCTION__
				,'There was an error trying while encrypting a string with AWS KMS'."\nMessage: ".$e->getMessage()
			)));
		}
	}



	public static function decrypt($string, $contextArray=null)
	{
		return self::crypt('decrypt', $string, $contextArray);
	}

	public static function encrypt($string, $contextArray=null)
	{
		return self::crypt('encrypt', $string, $contextArray);
	}
}
