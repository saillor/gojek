  <?php
#AUTO CLAIM VOC GOJEK no tf RP 1
#Created By Alip Dzikri X Apri AMsyah
#Reedit Arief
#####################################
$tanggal = date('l, d-m-Y');
$secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
$headers = array();

$headers[] = "Accept: application/json";
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Platform: Android';
$headers[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$headers[] = 'X-AppVersion: 3.35.1';
$headers[] = 'X-AppId: com.gojek.app';
$headers[] = "X-User-Locale: en_ID";
$headers[] = 'X-Location: 3.6426183,98.5294049';
$headers[] = "Connection: keep-alive";
$headers[] = "X-Platform: Android";
$headers[] = "Host: api.gojekapi.com";
$headers[] = "X-DeviceOS: Android,5.1.1";
$headers[] = "Accept-Language: en-ID";

#CURL NAMA
	function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}
function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}

echo "\n RECODE 16, NOVEMBER - 2019 \n[+] Menu: Masuk = 1 & Daftar = 2: ";
$type = trim(fgets(STDIN));

if($type == 2){
		echo " ~ ANDA MEMILIH DAFTAR ~\n";
		echo "[+] Masukkan Nomor HP : ";
		$number = trim(fgets(STDIN));
		$numbers = $number[0].$number[1];
		$numberx = $number[5];
		if($numbers == "08") { 
			$number = str_replace("08","628",$number);
		} elseif ($numberx == " ") {
			$number = preg_replace("/[^0-9]/", "",$number);
			$number = "1".$number;
		}
		$nama = nama();
		$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
		$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
		$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
		$regs = json_decode($reg[0]);
		// Verif OTP
		if($regs->success == true) {
			echo "[+] Masukkan OTP: ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				// Claim Voucher
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-accounts.txt";
				$boba = "live-boba.txt";
    // $fopen1 = fopen($live, "a+");
    // $fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \n NOMOR => ".$number." \n");
    // fclose($fopen1);
	// echo "[+] File Token saved in ".$live." \n";
	echo "[-] Token : $token \n";
    echo "[+] Process Redeem GOFOODSANTAI19 \n";
				$data19 = '{"promo_code":"GOFOODSANTAI19"}';
				$claim19 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data19, $headers);
				$claims19 = json_decode($claim19[0]);
					if($claims19->success == TRUE) {
						echo $claims19->data->message;
						echo "\n";
						sleep(6);
			echo "[+] Process Redeem COBAINGOJEK \n";
				$datacoba = '{"promo_code":"COBAINGOJEK"}';
				$claimcoba = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $datacoba, $headers);
				$claimscoba = json_decode($claimcoba[0]);
						echo $claimscoba->data->message."\n";
						
						sleep(6);
			echo "[+] Process Redeem AYOCOBAGOJEK \n";
				$dataayo = '{"promo_code":"AYOCOBAGOJEK"}';
				$claimayo = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $dataayo, $headers);
				$claimsayo = json_decode($claimayo[0]);
						echo $claimsayo->data->message."\n";
						
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 20K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 20K GOFOOD in $boba\n";
						exit;
					}else{
						echo "[-] Failed Claim GOFOODSANTAI19\n";
					}
	sleep(6);
	echo "[+] Process Redeem GOFOODSANTAI11 \n";
				$data11 = '{"promo_code":"GOFOODSANTAI11"}';
				$claim11 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data11, $headers);
				$claims11 = json_decode($claim11[0]);
					if($claims11->success == TRUE) {
						echo $claims11->data->message;
						echo "\n";
						sleep(6);
			echo "[+] Process Redeem COBAINGOJEK \n";
				$datacoba = '{"promo_code":"COBAINGOJEK"}';
				$claimcoba = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $datacoba, $headers);
				$claimscoba = json_decode($claimcoba[0]);
						echo $claimscoba->data->message."\n";
						
						sleep(6);
			echo "[+] Process Redeem AYOCOBAGOJEK \n";
				$dataayo = '{"promo_code":"AYOCOBAGOJEK"}';
				$claimayo = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $dataayo, $headers);
				$claimsayo = json_decode($claimayo[0]);
						echo $claimsayo->data->message."\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 15K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 15K GOFOOD in $boba\n";
						exit;
					}else{
						echo "[-] Failed Claim GOFOODSANTAI11\n";
					}
	sleep(6);
	echo "[+] Process Redeem GOFOODSANTAI08 \n";
				$data08 = '{"promo_code":"GOFOODSANTAI08"}';
				$claim08 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data08, $headers);
				$claims08 = json_decode($claim08[0]);
					if($claims08->success == TRUE) {
						echo $claims08->data->message;
						echo "\n";
						sleep(6);
			echo "[+] Process Redeem COBAINGOJEK \n";
				$datacoba = '{"promo_code":"COBAINGOJEK"}';
				$claimcoba = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $datacoba, $headers);
				$claimscoba = json_decode($claimcoba[0]);
						echo $claimscoba->data->message."\n";
						
						sleep(6);
			echo "[+] Process Redeem AYOCOBAGOJEK \n";
				$dataayo = '{"promo_code":"AYOCOBAGOJEK"}';
				$claimayo = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $dataayo, $headers);
				$claimsayo = json_decode($claimayo[0]);
						echo $claimsayo->data->message."\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 10K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 10K GOFOOD in $boba\n";
						exit;
					}else{
						echo "[-] Failed Claim GOFOODSANTAI08\n";
					}
	
						echo "\n\n[=] SELESAI MENGEKSEKUSI\n";	
						
					}else{
						echo "Kode OTP SALAH!!!!!\n";
					}
		}else{
			echo "Nomor udah dipake\n";
		} 		
} #END TYPE DAFTAR
else if($type == 1){
		echo " ~ ANDA MEMILIH MASUK ~\n";
		echo "[+] Masukkan Nomor HP : ";
		$number = trim(fgets(STDIN));
		$numbers = $number[0].$number[1];
		$numberx = $number[5];
		if($numbers == "08") { 
			$number = str_replace("08","628",$number);
		} elseif ($numberx == " ") {
			$number = preg_replace("/[^0-9]/", "",$number);
			$number = "1".$number;
		}
		$data = '{"phone":"+'.$number.'"}';
		$login = curl('https://api.gojekapi.com/v4/customers/login_with_phone', $data, $headers);
		$regs = json_decode($login[0]);
		// Verif OTP
		if($regs->success == true) {
			echo "[+] Masukkan OTP: ";
			$otp = trim(fgets(STDIN));
			$tokennya = $regs->data->login_token;
			$data2 = '{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"' . $otp . '","otp_token":"'.$tokennya.'"},"grant_type":"otp","scopes":"gojek:customer:transaction gojek:customer:readonly"}';
			$verif = curl('https://api.gojekapi.com/v4/customers/login/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
		if($verifs->success == true) {
				// Claim Voucher
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-accounts.txt";
				$boba = "live-boba.txt";
    // $fopen1 = fopen($live, "a+");
    // $fwrite1 = fwrite($fopen1, "TOKEN => ".$token." \n NOMOR => ".$number." \n");
    // fclose($fopen1);
	// echo "[+] File Token saved in ".$live." \n";
	echo "\n BERHASIL MASUK \n";
	echo "[-] Token : $token \n";
	echo "[+] Process CHECK VOUCHER \n";
		$checkvoc = curl('https://api.gojekapi.com/gopoints/v3/wallet/vouchers', $headers);
		$checkvocc = json_decode($checkvoc[0]);
		echo implode(', ', $checkvoc);
	if($checkvocc->success == true) {
						echo $checkvoc->total_vouchers;
						echo $checkvoc;
					}else{
						echo "[-] Failed Claim GOFOODSANTAI19\n";
					}
					sleep(60);
	
    echo "[+] Process Redeem GOFOODSANTAI19 \n";
				$data19 = '{"promo_code":"GOFOODSANTAI19"}';
				$claim19 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data19, $headers);
				$claims19 = json_decode($claim19[0]);
					if($claims19->success == TRUE) {
						echo $claims19->data->message;
						echo "\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 20K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 20K GOFOOD in $boba\n";
					}else{
						echo "[-] Failed Claim GOFOODSANTAI19\n";
					}
	sleep(6);
	echo "[+] Process Redeem GOFOODSANTAI11 \n";
				$data11 = '{"promo_code":"GOFOODSANTAI11"}';
				$claim11 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data11, $headers);
				$claims11 = json_decode($claim11[0]);
					if($claims11->success == TRUE) {
						echo $claims11->data->message;
						echo "\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 20K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 15K GOFOOD in $boba\n";
					}else{
						echo "[-] Failed Claim GOFOODSANTAI11\n";
					}
	sleep(6);
	echo "[+] Process Redeem GOFOODSANTAI08 \n";
				$data08 = '{"promo_code":"GOFOODSANTAI08"}';
				$claim08 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data08, $headers);
				$claims08 = json_decode($claim08[0]);
					if($claims08->success == TRUE) {
						echo $claims08->data->message;
						echo "\n";
						$fopen1 = fopen($boba, "a+");
						$fwrite1 = fwrite($fopen1, "TOKEN 20K GOFOOD => ".$token." \nNOMOR HP => ".$number." \nDIBUAT PADA => ".$tanggal." \n\n");
						fclose($fopen1);
						echo "[+] Success Save Token 10K GOFOOD in $boba\n";
					}else{
						echo "[-] Failed Claim GOFOODSANTAI08\n";
					}
	sleep(6);
	echo "[+] Process Redeem COBAINGOJEK \n";
				$datacoba = '{"promo_code":"COBAINGOJEK"}';
				$claimcoba = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $datacoba, $headers);
				$claimscoba = json_decode($claimcoba[0]);
						echo $claimscoba->data->message."\n";
						
	sleep(6);
	echo "[+] Process Redeem AYOCOBAGOJEK \n";
				$dataayo = '{"promo_code":"AYOCOBAGOJEK"}';
				$claimayo = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $dataayo, $headers);
				$claimsayo = json_decode($claimayo[0]);
						echo $claimsayo->data->message."\n";
	sleep(5);						
					}else{
						echo "Kode OTP SALAH!!!!!\n";
					}
		}else{
			echo "Nomor belum terdaftar di GOJEK\n";
		} 
} else {
	echo "\n[-] ERROR! PILIH 1 (LOGIN) atau 2 (DAFTAR) \n";
}
