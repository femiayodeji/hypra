<?php
class JWT{
	public static $secret_key = "13cc1e0157737e212884b522071f9f44";//secret key

	public function JWT_encode($content){
        //header
		$header = base64_encode('{"alg": "HS256","typ": "JWT"}');

		// base64 encodes the payload json
		$payload = base64_encode($content);

		//Signature
		$header_payload = $header.'.'.$payload;
		$signature = base64_encode(hash_hmac('sha256', $header_payload, self::$secret_key, true));

		//json web token
		$token = $header_payload.'.'.$signature;

		return $token;		
	}

	public function JWT_isSignature($token){
		$tokenReceived = str_replace("\/", "/", $token);
		//json values
		$jwt_values = explode('.', $tokenReceived);
		if(count($jwt_values) == 3){
            //signature from the original JWT
            $signatureReceived = $jwt_values[2];
            
            //signature
            $header_payloadReceived = $jwt_values[0] . '.' . $jwt_values[1];            
            $resultedsignature = base64_encode(hash_hmac('sha256', $header_payloadReceived, self::$secret_key, true));
            //compare signatures
            if($resultedsignature == $signatureReceived){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
	}

    public function JWT_decode($token){
        $tokenReceived = $token;
        $result = array();
        //json values
        $jwt_values = explode('.', $tokenReceived);
        if(count($jwt_values) == 3){
            if(self::JWT_isSignature($token)){
                //payload received
                $payloadReceived = $jwt_values[1];
                //data 
                $data = json_decode(base64_decode($payloadReceived),true);
                $result = array("status"=>true,"message"=>"Valid Signature","data"=>$data);                
            }
            else{
                $result = array("status"=>false,"message"=>"Invalid Signature","data"=>null);                
            }
        }
        else{
            $result = array("status"=>false,"message"=>"Invalid Token","data"=>null);            
        }
        return $result;
    }

}
?>