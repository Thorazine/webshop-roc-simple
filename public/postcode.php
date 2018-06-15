

<?php
$postcode = '1111aa';

echo standardizePostcode($postcode); // 1111 AA

function standardizePostcode($postcode)
{
	if(strlen($postcode) === 6){
       return strtoupper(preg_replace('/^.{4}/', "$0 ", $postcode));
	}
	else{
		return strtoupper($postcode);
	}
}

echo '<br>';

echo standardizePostcode1($postcode); // 1111 AA

function standardizePostcode1($postcode)
{
	return strtoupper(chunk_split($postcode, 4, ' '));
}
