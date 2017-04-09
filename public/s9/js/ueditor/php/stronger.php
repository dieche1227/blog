<?php
//utils.php
function Qiniu_Encode($str) // URLSafeBase64Encode
{
	$find = array('+', '/');
	$replace = array('-', '_');
	return str_replace($find, $replace, base64_encode($str));
}


function Qiniu_Decode($str)
{
	$find = array('-', '_');
	$replace = array('+', '/');
	return base64_decode(str_replace($find, $replace, $str));
}

//conf.php
global $SDK_VER;
global $QINIU_UP_HOST;
global $QINIU_RS_HOST;
global $QINIU_RSF_HOST;
 
global $QINIU_ACCESS_KEY;
global $QINIU_SECRET_KEY;

$SDK_VER = "6.1.9";

$QINIU_UP_HOST	= 'http://up.qiniu.com';
$QINIU_RS_HOST	= 'http://rs.qbox.me';
$QINIU_RSF_HOST	= 'http://rsf.qbox.me';

$QINIU_ACCESS_KEY	= '6IzgrwVEGDeGrTGBjDQjQGOMn9wibc77yTGpJiED';
$QINIU_SECRET_KEY	= 'XleHJTICW0OG4lSvJRuHgoXoF-CjH7oDsjQs4Xja';

//auth_digest.php

class Qiniu_Mac {

	public $AccessKey;
	public $SecretKey;

	public function __construct($accessKey, $secretKey)
	{
		$this->AccessKey = $accessKey;
		$this->SecretKey = $secretKey;
	}

	public function Sign($data) // => $token
	{
		$sign = hash_hmac('sha1', $data, $this->SecretKey, true);
		return $this->AccessKey . ':' . Qiniu_Encode($sign);
	}

	public function SignWithData($data) // => $token
	{
		$data = Qiniu_Encode($data);
		return $this->Sign($data) . ':' . $data;
	}

	public function SignRequest($req, $incbody) // => ($token, $error)
	{
		$url = $req->URL;
		$url = parse_url($url['path']);
		$data = '';
		if (isset($url['path'])) {
			$data = $url['path'];
		}
		if (isset($url['query'])) {
			$data .= '?' . $url['query'];
		}
		$data .= "\n";

		if ($incbody) {
			$data .= $req->Body;
		}
		return $this->Sign($data);
	}

	public function VerifyCallback($auth, $url, $body) // ==> bool
	{
		$url = parse_url($url);
		$data = '';
		if (isset($url['path'])) {
			$data = $url['path'];
		}
		if (isset($url['query'])) {
			$data .= '?' . $url['query'];
		}
		$data .= "\n";

		$data .= $body;
		$token = 'QBox ' . $this->Sign($data);
		return $auth === $token;
	}
}

function Qiniu_SetKeys($accessKey, $secretKey)
{
	global $QINIU_ACCESS_KEY;
	global $QINIU_SECRET_KEY;

	$QINIU_ACCESS_KEY = $accessKey;
	$QINIU_SECRET_KEY = $secretKey;
}

function Qiniu_RequireMac($mac) // => $mac
{
	if (isset($mac)) {
		return $mac;
	}

	global $QINIU_ACCESS_KEY;
	global $QINIU_SECRET_KEY;

	return new Qiniu_Mac($QINIU_ACCESS_KEY, $QINIU_SECRET_KEY);
}

function Qiniu_Sign($mac, $data) // => $token
{
	return Qiniu_RequireMac($mac)->Sign($data);
}

function Qiniu_SignWithData($mac, $data) // => $token
{
	return Qiniu_RequireMac($mac)->SignWithData($data);
}

//http.php

class Qiniu_Error
{
	public $Err;	 // string
	public $Reqid;	 // string
	public $Details; // []string
	public $Code;	 // int

	public function __construct($code, $err)
	{
		$this->Code = $code;
		$this->Err = $err;
	}
}

// --------------------------------------------------------------------------------
// class Qiniu_Request

class Qiniu_Request
{
	public $URL;
	public $Header;
	public $Body;
	public $UA;

	public function __construct($url, $body)
	{
		$this->URL = $url;
		$this->Header = array();
		$this->Body = $body;
		$this->UA = Qiniu_UserAgent();
	}
}

// --------------------------------------------------------------------------------
// class Qiniu_Response

class Qiniu_Response
{
	public $StatusCode;
	public $Header;
	public $ContentLength;
	public $Body;

	public function __construct($code, $body)
	{
		$this->StatusCode = $code;
		$this->Header = array();
		$this->Body = $body;
		$this->ContentLength = strlen($body);
	}
}

// --------------------------------------------------------------------------------
// class Qiniu_Header

function Qiniu_Header_Get($header, $key) // => $val
{
	$val = @$header[$key];
	if (isset($val)) {
		if (is_array($val)) {
			return $val[0];
		}
		return $val;
	} else {
		return '';
	}
}

function Qiniu_ResponseError($resp) // => $error
{
	$header = $resp->Header;
	$details = Qiniu_Header_Get($header, 'X-Log');
	$reqId = Qiniu_Header_Get($header, 'X-Reqid');
	$err = new Qiniu_Error($resp->StatusCode, null);

	if ($err->Code > 299) {
		if ($resp->ContentLength !== 0) {
			if (Qiniu_Header_Get($header, 'Content-Type') === 'application/json') {
				$ret = json_decode($resp->Body, true);
				$err->Err = $ret['error'];
			}
		}
	}
	$err->Reqid = $reqId;
	$err->Details = $details;
	return $err;
}

// --------------------------------------------------------------------------------
// class Qiniu_Client

function Qiniu_Client_incBody($req) // => $incbody
{
	$body = $req->Body;
	if (!isset($body)) {
		return false;
	}

	$ct = Qiniu_Header_Get($req->Header, 'Content-Type');
	if ($ct === 'application/x-www-form-urlencoded') {
		return true;
	}
	return false;
}

function Qiniu_Client_do($req) // => ($resp, $error)
{
	$ch = curl_init();
	$url = $req->URL;
	$options = array(
		CURLOPT_USERAGENT => $req->UA,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_HEADER => true,
		CURLOPT_NOBODY => false,
		CURLOPT_CUSTOMREQUEST  => 'POST',
		CURLOPT_URL => $url['path']
	);
	$httpHeader = $req->Header;
	if (!empty($httpHeader))
	{
		$header = array();
		foreach($httpHeader as $key => $parsedUrlValue) {
			$header[] = "$key: $parsedUrlValue";
		}
		$options[CURLOPT_HTTPHEADER] = $header;
	}
	$body = $req->Body;
	if (!empty($body)) {
		$options[CURLOPT_POSTFIELDS] = $body;
	} else {
		$options[CURLOPT_POSTFIELDS] = "";
	}
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);
	$ret = curl_errno($ch);
	if ($ret !== 0) {
		$err = new Qiniu_Error(0, curl_error($ch));
		curl_close($ch);
		return array(null, $err);
	}
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	curl_close($ch);

	$responseArray = explode("\r\n\r\n", $result);
	$responseArraySize = sizeof($responseArray);
	$respHeader = $responseArray[$responseArraySize-2];
	$respBody = $responseArray[$responseArraySize-1];

	list($reqid, $xLog) = getReqInfo($respHeader);

	$resp = new Qiniu_Response($code, $respBody);
	$resp->Header['Content-Type'] = $contentType;
	$resp->Header["X-Reqid"] = $reqid;
	return array($resp, null);
}

function getReqInfo($headerContent) {
	$headers = explode("\r\n", $headerContent);
	$reqid = null;
	$xLog = null;
	foreach($headers as $header) {
		$header = trim($header);
		if(strpos($header, 'X-Reqid') !== false) {
			list($k, $v) = explode(':', $header);
			$reqid = trim($v);
		} elseif(strpos($header, 'X-Log') !== false) {
			list($k, $v) = explode(':', $header);
			$xLog = trim($v);
		}
	}
	return array($reqid, $xLog);
}

class Qiniu_HttpClient
{
	public function RoundTrip($req) // => ($resp, $error)
	{
		return Qiniu_Client_do($req);
	}
}

class Qiniu_MacHttpClient
{
	public $Mac;

	public function __construct($mac)
	{
		$this->Mac = Qiniu_RequireMac($mac);
	}

	public function RoundTrip($req) // => ($resp, $error)
	{
		$incbody = Qiniu_Client_incBody($req);
		$token = $this->Mac->SignRequest($req, $incbody);
		$req->Header['Authorization'] = "QBox $token";
		return Qiniu_Client_do($req);
	}
}

// --------------------------------------------------------------------------------

function Qiniu_Client_ret($resp) // => ($data, $error)
{
	$code = $resp->StatusCode;
	$data = null;
	if ($code >= 200 && $code <= 299) {
		if ($resp->ContentLength !== 0) {
			$data = json_decode($resp->Body, true);
			if ($data === null) {
				$err_msg = function_exists('json_last_error_msg') ? json_last_error_msg() : "error with content:" . $resp->Body;
				$err = new Qiniu_Error(0, $err_msg);
				return array(null, $err);
			}
		}
		if ($code === 200) {
			return array($data, null);
		}
	}
	return array($data, Qiniu_ResponseError($resp));
}

function Qiniu_Client_Call($self, $url) // => ($data, $error)
{
	$u = array('path' => $url);
	$req = new Qiniu_Request($u, null);
	list($resp, $err) = $self->RoundTrip($req);
	if ($err !== null) {
		return array(null, $err);
	}
	return Qiniu_Client_ret($resp);
}

function Qiniu_Client_CallNoRet($self, $url) // => $error
{
	$u = array('path' => $url);
	$req = new Qiniu_Request($u, null);
	list($resp, $err) = $self->RoundTrip($req);
	if ($err !== null) {
		return array(null, $err);
	}
	if ($resp->StatusCode === 200) {
		return null;
	}
	return Qiniu_ResponseError($resp);
}

function Qiniu_Client_CallWithForm(
	$self, $url, $params, $contentType = 'application/x-www-form-urlencoded') // => ($data, $error)
{
	$u = array('path' => $url);
	if ($contentType === 'application/x-www-form-urlencoded') {
		if (is_array($params)) {
			$params = http_build_query($params);
		}
	}
	$req = new Qiniu_Request($u, $params);
	if ($contentType !== 'multipart/form-data') {
		$req->Header['Content-Type'] = $contentType;
	}
	list($resp, $err) = $self->RoundTrip($req);
	if ($err !== null) {
		return array(null, $err);
	}
	return Qiniu_Client_ret($resp);
}

// --------------------------------------------------------------------------------

function Qiniu_Client_CallWithMultipartForm($self, $url, $fields, $files)
{
	list($contentType, $body) = Qiniu_Build_MultipartForm($fields, $files);
	return Qiniu_Client_CallWithForm($self, $url, $body, $contentType);
}

function Qiniu_Build_MultipartForm($fields, $files) // => ($contentType, $body)
{
	$data = array();
	$mimeBoundary = md5(microtime());

	foreach ($fields as $name => $val) {
		array_push($data, '--' . $mimeBoundary);
		array_push($data, "Content-Disposition: form-data; name=\"$name\"");
		array_push($data, '');
		array_push($data, $val);
	}

	foreach ($files as $file) {
		array_push($data, '--' . $mimeBoundary);
		list($name, $fileName, $fileBody, $mimeType) = $file;
		$mimeType = empty($mimeType) ? 'application/octet-stream' : $mimeType;
		$fileName = Qiniu_escapeQuotes($fileName);
		array_push($data, "Content-Disposition: form-data; name=\"$name\"; filename=\"$fileName\"");
		array_push($data, "Content-Type: $mimeType");
		array_push($data, '');
		array_push($data, $fileBody);
	}

	array_push($data, '--' . $mimeBoundary . '--');
	array_push($data, '');

	$body = implode("\r\n", $data);
	$contentType = 'multipart/form-data; boundary=' . $mimeBoundary;
	return array($contentType, $body);
}

function Qiniu_UserAgent() {
	global $SDK_VER;
	$sdkInfo = "QiniuPHP/$SDK_VER";

	$systemInfo = php_uname("s");
	$machineInfo = php_uname("m");

	$envInfo = "($systemInfo/$machineInfo)";

	$phpVer = phpversion();

	$ua = "$sdkInfo $envInfo PHP/$phpVer";
	return $ua;
}

function Qiniu_escapeQuotes($str)
{
	$find = array("\\", "\"");
	$replace = array("\\\\", "\\\"");
	return str_replace($find, $replace, $str);
}


//io.php


class Qiniu_PutExtra
{
	public $Params = null;
	public $MimeType = null;
	public $Crc32 = 0;
	public $CheckCrc = 0;
}

function Qiniu_Put($upToken, $key, $body, $putExtra) // => ($putRet, $err)
{
	global $QINIU_UP_HOST;

	if ($putExtra === null) {
		$putExtra = new Qiniu_PutExtra;
	}

	$fields = array('token' => $upToken);
	if ($key === null) {
		$fname = '?';
	} else {
		$fname = $key;
		$fields['key'] = $key;
	}
	if ($putExtra->CheckCrc) {
		$fields['crc32'] = $putExtra->Crc32;
	}
	if ($putExtra->Params) {
		foreach ($putExtra->Params as $k=>$v) {
			$fields[$k] = $v;
		}
	}

	$files = array(array('file', $fname, $body, $putExtra->MimeType));

	$client = new Qiniu_HttpClient;
	return Qiniu_Client_CallWithMultipartForm($client, $QINIU_UP_HOST, $fields, $files);
}

function createFile($filename, $mime)
{
    // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
    // See: https://wiki.php.net/rfc/curl-file-upload
    if (function_exists('curl_file_create')) {
        return curl_file_create($filename, $mime);
    }

    // Use the old style if using an older version of PHP
    $value = "@{$filename}";
    if (!empty($mime)) {
        $value .= ';type=' . $mime;
    }

    return $value;
}

function Qiniu_PutFile($upToken, $key, $localFile, $putExtra) // => ($putRet, $err)
{
	global $QINIU_UP_HOST;

	if ($putExtra === null) {
		$putExtra = new Qiniu_PutExtra;
	}

	$fields = array('token' => $upToken, 'file' => createFile($localFile, $putExtra->MimeType));
	if ($key === null) {
		$fname = '?';
	} else {
		$fname = $key;
		$fields['key'] = $key;
	}
	if ($putExtra->CheckCrc) {
		if ($putExtra->CheckCrc === 1) {
			$hash = hash_file('crc32b', $localFile);
			$array = unpack('N', pack('H*', $hash));
			$putExtra->Crc32 = $array[1];
		}
		$fields['crc32'] = sprintf('%u', $putExtra->Crc32);
	}
	if ($putExtra->Params) {
		foreach ($putExtra->Params as $k=>$v) {
			$fields[$k] = $v;
		}
	}

	$client = new Qiniu_HttpClient;
	return Qiniu_Client_CallWithForm($client, $QINIU_UP_HOST, $fields, 'multipart/form-data');
}

// ----------------------------------------------------------

//rs.php
// class Qiniu_RS_GetPolicy

class Qiniu_RS_GetPolicy
{
	public $Expires;

	public function MakeRequest($baseUrl, $mac) // => $privateUrl
	{
		$deadline = $this->Expires;
		if ($deadline == 0) {
			$deadline = 3600;
		}
		$deadline += time();

		$pos = strpos($baseUrl, '?');
		if ($pos !== false) {
			$baseUrl .= '&e=';
		} else {
			$baseUrl .= '?e=';
		}
		$baseUrl .= $deadline;

		$token = Qiniu_Sign($mac, $baseUrl);
		return "$baseUrl&token=$token";
	}
}

function Qiniu_RS_MakeBaseUrl($domain, $key) // => $baseUrl
{
	$keyEsc = str_replace("%2F", "/", rawurlencode($key));
	return "http://$domain/$keyEsc";
}

// --------------------------------------------------------------------------------
// class Qiniu_RS_PutPolicy

class Qiniu_RS_PutPolicy
{
	public $Scope;                  //必填
	public $Expires;                //默认为3600s
	public $CallbackUrl;
	public $CallbackBody;
	public $ReturnUrl;
	public $ReturnBody;
	public $AsyncOps;
	public $EndUser;
	public $InsertOnly;             //若非0，则任何情况下无法覆盖上传
	public $DetectMime;             //若非0，则服务端根据内容自动确定MimeType
	public $FsizeLimit;
	public $SaveKey;
	public $PersistentOps;
	public $PersistentNotifyUrl;
	public $FopTimeout;
	public $MimeLimit;

	public function __construct($scope)
	{
		$this->Scope = $scope;
	}

	public function Token($mac) // => $token
	{
		$deadline = $this->Expires;
		if ($deadline == 0) {
			$deadline = 3600;
		}
		$deadline += time();

		$policy = array('scope' => $this->Scope, 'deadline' => $deadline);
		if (!empty($this->CallbackUrl)) {
			$policy['callbackUrl'] = $this->CallbackUrl;
		}
		if (!empty($this->CallbackBody)) {
			$policy['callbackBody'] = $this->CallbackBody;
		}
		if (!empty($this->ReturnUrl)) {
			$policy['returnUrl'] = $this->ReturnUrl;
		}
		if (!empty($this->ReturnBody)) {
			$policy['returnBody'] = $this->ReturnBody;
		}
		if (!empty($this->AsyncOps)) {
			$policy['asyncOps'] = $this->AsyncOps;
		}
		if (!empty($this->EndUser)) {
			$policy['endUser'] = $this->EndUser;
		}
		if (!empty($this->InsertOnly)) {
			$policy['exclusive'] = $this->InsertOnly;
		}
		if (!empty($this->DetectMime)) {
			$policy['detectMime'] = $this->DetectMime;
		}
		if (!empty($this->FsizeLimit)) {
			$policy['fsizeLimit'] = $this->FsizeLimit;
		}
		if (!empty($this->SaveKey)) {
			$policy['saveKey'] = $this->SaveKey;
		}
		if (!empty($this->PersistentOps)) {
			$policy['persistentOps'] = $this->PersistentOps;
		}
		if (!empty($this->PersistentNotifyUrl)) {
			$policy['persistentNotifyUrl'] = $this->PersistentNotifyUrl;
		}
		if (!empty($this->FopTimeout)) {
			$policy['fopTimeout'] = $this->FopTimeout;
		}
		if (!empty($this->MimeLimit)) {
			$policy['mimeLimit'] = $this->MimeLimit;
		}


		$b = json_encode($policy);
		return Qiniu_SignWithData($mac, $b);
	}
}

// ----------------------------------------------------------
// class Qiniu_RS_EntryPath

class Qiniu_RS_EntryPath
{
	public $bucket;
	public $key;

	public function __construct($bucket, $key)
	{
		$this->bucket = $bucket;
		$this->key = $key;
	}
}

// ----------------------------------------------------------
// class Qiniu_RS_EntryPathPair

class Qiniu_RS_EntryPathPair
{
	public $src;
	public $dest;

	public function __construct($src, $dest)
	{
		$this->src = $src;
		$this->dest = $dest;
	}
}

// ----------------------------------------------------------

function Qiniu_RS_URIStat($bucket, $key)
{
	return '/stat/' . Qiniu_Encode("$bucket:$key");
}

function Qiniu_RS_URIDelete($bucket, $key)
{
	return '/delete/' . Qiniu_Encode("$bucket:$key");
}

function Qiniu_RS_URICopy($bucketSrc, $keySrc, $bucketDest, $keyDest)
{
	return '/copy/' . Qiniu_Encode("$bucketSrc:$keySrc") . '/' . Qiniu_Encode("$bucketDest:$keyDest");
}

function Qiniu_RS_URIMove($bucketSrc, $keySrc, $bucketDest, $keyDest)
{
	return '/move/' . Qiniu_Encode("$bucketSrc:$keySrc") . '/' . Qiniu_Encode("$bucketDest:$keyDest");
}

// ----------------------------------------------------------

function Qiniu_RS_Stat($self, $bucket, $key) // => ($statRet, $error)
{
	global $QINIU_RS_HOST;
	$uri = Qiniu_RS_URIStat($bucket, $key);
	return Qiniu_Client_Call($self, $QINIU_RS_HOST . $uri);
}

function Qiniu_RS_Delete($self, $bucket, $key) // => $error
{
	global $QINIU_RS_HOST;
	$uri = Qiniu_RS_URIDelete($bucket, $key);
	return Qiniu_Client_CallNoRet($self, $QINIU_RS_HOST . $uri);
}

function Qiniu_RS_Move($self, $bucketSrc, $keySrc, $bucketDest, $keyDest) // => $error
{
	global $QINIU_RS_HOST;
	$uri = Qiniu_RS_URIMove($bucketSrc, $keySrc, $bucketDest, $keyDest);
	return Qiniu_Client_CallNoRet($self, $QINIU_RS_HOST . $uri);
}

function Qiniu_RS_Copy($self, $bucketSrc, $keySrc, $bucketDest, $keyDest) // => $error
{
	global $QINIU_RS_HOST;
	$uri = Qiniu_RS_URICopy($bucketSrc, $keySrc, $bucketDest, $keyDest);
	return Qiniu_Client_CallNoRet($self, $QINIU_RS_HOST . $uri);
}

// ----------------------------------------------------------
// batch

function Qiniu_RS_Batch($self, $ops) // => ($data, $error)
{
	global $QINIU_RS_HOST;
	$url = $QINIU_RS_HOST . '/batch';
	$params = 'op=' . implode('&op=', $ops);
	return Qiniu_Client_CallWithForm($self, $url, $params);
}

function Qiniu_RS_BatchStat($self, $entryPaths)
{
	$params = array();
	foreach ($entryPaths as $entryPath) {
		$params[] = Qiniu_RS_URIStat($entryPath->bucket, $entryPath->key);
	}
	return Qiniu_RS_Batch($self,$params);
}

function Qiniu_RS_BatchDelete($self, $entryPaths)
{
	$params = array();
	foreach ($entryPaths as $entryPath) {
		$params[] = Qiniu_RS_URIDelete($entryPath->bucket, $entryPath->key);
	}
	return Qiniu_RS_Batch($self, $params);
}

function Qiniu_RS_BatchMove($self, $entryPairs)
{
	$params = array();
	foreach ($entryPairs as $entryPair) {
		$src = $entryPair->src;
		$dest = $entryPair->dest;
		$params[] = Qiniu_RS_URIMove($src->bucket, $src->key, $dest->bucket, $dest->key);
	}
	return Qiniu_RS_Batch($self, $params);
}

function Qiniu_RS_BatchCopy($self, $entryPairs)
{
	$params = array();
	foreach ($entryPairs as $entryPair) {
		$src = $entryPair->src;
		$dest = $entryPair->dest;
		$params[] = Qiniu_RS_URICopy($src->bucket, $src->key, $dest->bucket, $dest->key);
	}
	return Qiniu_RS_Batch($self, $params);
}


//fop.php


class Qiniu_ImageView {
	public $Mode;
    public $Width;
    public $Height;
    public $Quality;
    public $Format;

    public function MakeRequest($url)
    {
    	$ops = array($this->Mode);

    	if (!empty($this->Width)) {
    		$ops[] = 'w/' . $this->Width;
    	}
    	if (!empty($this->Height)) {
    		$ops[] = 'h/' . $this->Height;
    	}
    	if (!empty($this->Quality)) {
    		$ops[] = 'q/' . $this->Quality;
    	}
    	if (!empty($this->Format)) {
    		$ops[] = 'format/' . $this->Format;
    	}

    	return $url . "?imageView/" . implode('/', $ops);
    }
}

// --------------------------------------------------------------------------------
// class Qiniu_Exif

class Qiniu_Exif {

	public function MakeRequest($url)
	{
		return $url . "?exif";
	}

}

// --------------------------------------------------------------------------------
// class Qiniu_ImageInfo

class Qiniu_ImageInfo {

	public function MakeRequest($url)
	{
		return $url . "?imageInfo";
	}

}


//rsf.php
define('Qiniu_RSF_EOF', 'EOF');

/**
 * 1. 首次请求 marker = ""
 * 2. 无论 err 值如何，均应该先看 items 是否有内容
 * 3. 如果后续没有更多数据，err 返回 EOF，markerOut 返回 ""（但不通过该特征来判断是否结束）
 */
function Qiniu_RSF_ListPrefix(
	$self, $bucket, $prefix = '', $marker = '', $limit = 0) // => ($items, $markerOut, $err)
{
	global $QINIU_RSF_HOST;

	$query = array('bucket' => $bucket);
	if (!empty($prefix)) {
		$query['prefix'] = $prefix;
	}
	if (!empty($marker)) {
		$query['marker'] = $marker;
	}
	if (!empty($limit)) {
		$query['limit'] = $limit;
	}

	$url =  $QINIU_RSF_HOST . '/list?' . http_build_query($query);
	list($ret, $err) = Qiniu_Client_Call($self, $url);
	if ($err !== null) {
		return array(null, '', $err);
	}

	$items = $ret['items'];
	if (empty($ret['marker'])) {
		$markerOut = '';
		$err = Qiniu_RSF_EOF;
	} else {
		$markerOut = $ret['marker'];
	}
	return array($items, $markerOut, $err);
}

//resumable_io.php

class Qiniu_Rio_PutExtra
{
	public $Bucket = null;		// 必选（未来会没有这个字段）。
	public $Params = null;
	public $MimeType = null;
	public $ChunkSize = 0;		// 可选。每次上传的Chunk大小
	public $TryTimes = 3;		// 可选。尝试次数
	public $Progresses = null;	// 可选。上传进度：[]BlkputRet
	public $Notify = null;		// 进度通知：func(blkIdx int, blkSize int, ret *BlkputRet)
	public $NotifyErr = null;	// 错误通知：func(blkIdx int, blkSize int, err error)

	public function __construct($bucket = null) {
		$this->Bucket = $bucket;
	}
}

// ----------------------------------------------------------
// func Qiniu_Rio_BlockCount

define('QINIU_RIO_BLOCK_BITS', 22);
define('QINIU_RIO_BLOCK_SIZE', 1 << QINIU_RIO_BLOCK_BITS); // 4M

function Qiniu_Rio_BlockCount($fsize) // => $blockCnt
{
	return ($fsize + (QINIU_RIO_BLOCK_SIZE - 1)) >> QINIU_RIO_BLOCK_BITS;
}

// ----------------------------------------------------------
// internal func Qiniu_Rio_Mkblock/Mkfile

function Qiniu_Rio_Mkblock($self, $host, $reader, $size) // => ($blkputRet, $err)
{
	if (is_resource($reader)) {
		$body = fread($reader, $size);
		if ($body === false) {
			$err = new Qiniu_Error(0, 'fread failed');
			return array(null, $err);
		}
	} else {
		list($body, $err) = $reader->Read($size);
		if ($err !== null) {
			return array(null, $err);
		}
	}
	if (strlen($body) != $size) {
		$err = new Qiniu_Error(0, 'fread failed: unexpected eof');
		return array(null, $err);
	}

	$url = $host . '/mkblk/' . $size;
	return Qiniu_Client_CallWithForm($self, $url, $body, 'application/octet-stream');
}


function Qiniu_Rio_Mkfile($self, $host, $key, $fsize, $extra) // => ($putRet, $err)
{
	$url = $host . '/mkfile/' . $fsize;
	if ($key !== null) {
		$url .= '/key/' . Qiniu_Encode($key);
	}
	if (!empty($extra->MimeType)) {
		$url .= '/mimeType/' . Qiniu_Encode($extra->MimeType);
	}

	if (!empty($extra->Params)) {
		foreach ($extra->Params as $k=>$v) {
			$url .= "/" . $k . "/" . Qiniu_Encode($v);
		}
	}

	$ctxs = array();
	foreach ($extra->Progresses as $prog) {
		$ctxs []= $prog['ctx'];
	}
	$body = implode(',', $ctxs);

	return Qiniu_Client_CallWithForm($self, $url, $body, 'application/octet-stream');
}

// ----------------------------------------------------------
// class Qiniu_Rio_UploadClient

class Qiniu_Rio_UploadClient
{
	public $uptoken;

	public function __construct($uptoken)
	{
		$this->uptoken = $uptoken;
	}

	public function RoundTrip($req) // => ($resp, $error)
	{
		$token = $this->uptoken;
		$req->Header['Authorization'] = "UpToken $token";
		return Qiniu_Client_do($req);
	}
}

// ----------------------------------------------------------
// class Qiniu_Rio_Put/PutFile

function Qiniu_Rio_Put($upToken, $key, $body, $fsize, $putExtra) // => ($putRet, $err)
{
	global $QINIU_UP_HOST;

	$self = new Qiniu_Rio_UploadClient($upToken);

	$progresses = array();
	$uploaded = 0;
	while ($uploaded < $fsize) {
		$tried = 0;
		$tryTimes = ($putExtra->TryTimes > 0) ? $putExtra->TryTimes : 1;
		$blkputRet = null;
		$err = null;
		if ($fsize < $uploaded + QINIU_RIO_BLOCK_SIZE) {
			$bsize = $fsize - $uploaded;
		} else {
			$bsize = QINIU_RIO_BLOCK_SIZE;
		}
		while ($tried < $tryTimes) {
			list($blkputRet, $err) = Qiniu_Rio_Mkblock($self, $QINIU_UP_HOST, $body, $bsize);
			if ($err === null) {
				break;
			}
			$tried += 1;
			continue;
		}
		if ($err !== null) {
			return array(null, $err);
		}
		if ($blkputRet === null ) {
			$err = new Qiniu_Error(0, "rio: uploaded without ret");
			return array(null, $err);
		}
		$uploaded += $bsize;
		$progresses []= $blkputRet;
	}

	$putExtra->Progresses = $progresses;
	return Qiniu_Rio_Mkfile($self, $QINIU_UP_HOST, $key, $fsize, $putExtra);
}

function Qiniu_Rio_PutFile($upToken, $key, $localFile, $putExtra) // => ($putRet, $err)
{
	$fp = fopen($localFile, 'rb');
	if ($fp === false) {
		$err = new Qiniu_Error(0, 'fopen failed');
		return array(null, $err);
	}

	$fi = fstat($fp);
	$result = Qiniu_Rio_Put($upToken, $key, $fp, $fi['size'], $putExtra);
	fclose($fp);
	return $result;
}

