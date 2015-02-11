<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Class: AulasAmigas.php
 * Api de control de usuarios con AulasAmigas
 *
 * Author: 
 * 
 * Locacion: libreries/aulasamigas.php
 */
class AulasAmigas
{
	 /* Function: urlGoogle
     * Obtiene la URL de login de Google para poder realizar el inicio de session con este. Una vez genere el retorno de Google el token se debe volver a enviar a esta función 
     *
     * Parameters:
     *      $sDomain - String dominio de retorno una vez se realiza las peticiones a Google
     *      $sSessionToken - string Session token.
     * 		$sIp - String Ip del usuario que realiza la petición
     *		$sToken - String Token que devuelve google una vez habilitado los permisos.
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function urlGoogle($sDomain	=	"", $sSessionToken	=	FALSE, $sIp 	=	"", $sToken 	=	FALSE)
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'ip_user='.urlencode($sIp).'&token='.urlencode($sToken).'&domain='.urlencode($sDomain).'&scopes=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile http://gdata.youtube.com&case=66&sessionToken='.urlencode($sSessionToken);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
     
    /* Function: user_fb
     * Función para registrar un usuario con facebook, en su defecto retorna los datos de usuario ya guardados para mostrar
     *
     * Parameters:
     *      
     *     $data_user_fb - string contenedor de tos datos de usuario de facebook 
     * 		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function user_fb($id_fb, $email, $first_name, $last_name, $gender, $ip, $code)
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=109&id_fb='. $id_fb . '&email='. $email . '&first_name='. $first_name . '&last_name='. $last_name . '&gender='. $gender . '&ip=' . $ip . '&code='.$code;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	
     /* Function: getUserByEmail
     * Obtener información sobre un usuario mediante el Email para saber si esta registrado o no en AulasAmigas
     *
     * Parameters:
     *      
     *     $sEmail - Email tipo string 
     * 		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function getUserByEmail($sEmail = "")
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=68&txtEmail='.urlencode($sEmail);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	 /* Function: getUsersInfo
     * Obtener información sobre varios usuarios al al mismo tiempo solo enviando un array con los IDS en MD5 de los usuarios
     *
     * Parameters:
     *      
     *     $aData - Un array formado $aData[] = 'Valor' donde valor serian los IDS en MD5 de los usuarios que se desean consultar
     * 		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function getUsersInfo($aData = array())
	{
		if(!empty($aData))
		{
			$sCadena	=	"";
			for($i = 0; $i<count($aData); $i++)
			{
				$sCadena.=	$aData[$i].',';	
			}
			//Parametros post que se le enviaran a la funcion
			$sParametrosPost = 'case=69&txtIdUsers='.$sCadena;
			$sesion = curl_init(URL_API_AMIGAS);
			//Definir tipo de petición post a realizar
			curl_setopt ($sesion, CURLOPT_POST, true); 
			// Le pasamos los datos definidos anteriormente en $sParametrosPost
			curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
			// Como queremos que nos devuelva la respuesta
			curl_setopt($sesion, CURLOPT_HEADER, false); 
			curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
			// Ejecutamos la petición
			$jRespuesta = curl_exec($sesion); 
			// Cerramos Conexión
			curl_close($sesion); 
			return $jRespuesta;
		}
		return FALSE;
	}
	 /* Function: addUser
     * Agregar un nuevo usuario al sistema de AulasAmigas
     *
     * Parameters:
     *      
     *     	$Nomb - Nombre del usuario
     * 	 	$Apell - Apellido del usuario
     *		$Email - Email del usuario
     *		$Ip - Ip del usuario que se registra
     *		$Pass - Contraseña del usuario
     *		$Gen - Genero del usuario
     *		$Doce - Si es docente u otro rol de usuario
     *		$Country - Pais del usuario
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function addUser($Nomb = "", $Apell = "", $Email = "", $IP = "", $Pass = "", $Gen = "", $Doce = 0, $Country = 0, $id_content)
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=4&txtNomb='.urlencode($Nomb).'&txtApell='.urlencode($Apell).'&txtEmail='.urlencode($Email).'&txtIp='.urlencode($IP).'&txtPass='.urlencode($Pass).'&txtGen='.urlencode($Gen).'&txtDoce='.urlencode($Doce).'&txtCountry'.urlencode($Country).'&id_content='.$id_content;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	/* Function: loginUser
     * Funcion para iniciar session de un usuario por medio de Aulas Amigas
     *
     * Parameters:
     *		$Email - Email del usuario
     *		$Pass - Contraseña del usuario
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function loginUser($Email = "", $Pass = "")
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=17&txtEmail='.urlencode($Email).'&txtPass='.urlencode($Pass);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	////////////////////////////////////////////////////
	//
	//	FUNCIONES REALIZADAS POR ESNEYDER
	//	_____________________________________________
	//
	//
	/////////////////////////////////////////////////////
	/* Function: AQOL
	 * Amigas Query Object Language (AQOL): Función Para guardar o consultar información almacenada usando el formato de AQOL.
	 * 
	 * Parameter:
	 *      $query - String consulta o asignación de un valor en formato AQOL que se realizará.
	 *      $contentID - Id del contenido al cual se le asignará la información almacenada en formato AQOL.	 *       
	 *      $userID - String Id del Usuario.
	 *  
	 * Return:
	 *      JSON - string(JSON) con la información de la consulta realizada al AQOL.
	 *      "ok" - String éste valor es retornado en caso de que la asignación de un valor (key-value), haya sido realizada correctamente.
	 */
	public function AQOL($query	=	"", $userID	=	"", $contentID 	=	"")
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'txtId='.urlencode($userID).'&txtIdContent='.urlencode($contentID).'&query='.urlencode($query).'&case=33';
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: whoAmI
	 * Obtiene la información básica del usuario.
	 * 
	 * Parameter:
	 *      $userId - String Id del Usuario.
	 *  
	 * Return:
	 *		$jRespuesta - Array con información del usuario
	 *
	 */
	public function whoAmI($userId)
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=8&txtId='.$userId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: getContents
	 * Función Para obtener la lista de contenidos asociados al usuario.
	 * 
	 * Parameter:
	 * 		$userID - String Id del Usuario.
	 * Return:
	 *      $jRespuesta - Array con la lista de los contenidos asociados al usuario.
	 *		0 - Integer No se encontraron datos de Contenidos.
	 */
	function getContents($userID)
	{
	  	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=9&txtId='.$userID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: getContentInstalledInfo
	 * Función Para obtener la información de un contenido específico asociado al usuario.
	 * 
	 * Parameter:
	 *		$userID - String Id del Usuario.
	 *      $contentID - Id del contenido del que se desea obtener la información.
	 *  
	 * Return:
	 *      $jRespuesta - Array con la información del contenido especificado por su id, asociado al usuario.
	 *		0 - Integer No se encontro el Contenido.
	 */
	function getContentInstalledInfo($userID, $contentID)
	{
	   	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=19&txtId='.$userID.'&txtIdContent='.$contentID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return (array)json_decode($jRespuesta);
	}

	/* Function: getContentSourceInfo
	 * Función Para obtener la información de un contenido específico del centro de recursos.
	 * 
	 * Parameter:
	 *		$userID - String Id del Usuario.
	 *      $contentID - Id del contenido del que se desea obtener la información.
	 *  
	 * Return:
	 *      $jRespuesta - Array con la información del contenido especificado por su id, encontrado en el centro de recursos.
	 *      0 - Integer No se encontro el Contenido.
	 */
	function getContentSourceInfo($userID, $contentID)
	{
	   	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=21&txtId='.$userID.'&txtIdContent='.$contentID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: getRanking
	 * Función para obtener el Ranking de los usuarios con mas puntajes en el Curso.
	 * 
	 * Parameter:
	 *      $userID - String Id del Usuario.
	 *  
	 * Return:
	 *      $jRespuesta - Array con la información del Ranking de los usuarios con puntajes mas altos del curso.
	 */
	function getRanking($userID, $id_content)
	{ 
	  	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=46&id_content=' . $id_content . '&IdUser='.$userID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: listUserSessions
	 * Listar sesiones del usuario.
	 * 
	 * Parameter:
	 *		$userID - String Id del Usuario.
	 *      $idLive - Integer Id de la sesion en vivo.
	 *      $idPath - Integer Id de la ruta.
	 *  
	 * Return:
	 *      $jRespuesta - Array con la información obtenida.
	 */
	function listUserSessions($idLive, $idPath)
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=37&IdUser='.$userID.'&IdLive=' . $idLive . '&IdPath='. $idPath;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: subscribeSession
	 * Suscribirse a una sesion en vivo.
	 * 
	 * Parameter:
	 *		$userID - String Id del Usuario.
	 *
	 * Return:
	 *      JSON - Array con la información obtenida.
	 */
	function subscribeSession($userID)
	{
	  	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=38&IdUser='.$userID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: getUrlSession
	 * Consultar Url de la sesion en vivo, o el video de youtube.
	 * 
	 * Parameter:
	 *      $IdSession - Integer id de la sesion.
	 *  
	 * Return:
	 *      $jRespuesta - Array con la información obtenida.
	 */
	function getUrlSession($IdSession)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=43&IdSession='.$IdSession;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: contentExist
	 * Función para verificar  si un contenido específico, identificado por su ID, está asociado al usuario.
	 * 
	 * Parameter:
	 *		$userID - String Id del Usuario.
	 *      $contentID - Id del contenido que se desea verificar.
	 *  
	 * Return:
	 *      Bool - True En caso de que el contenido identificado por su id, esté asociado al usuario.
	 *      Bool - False En caso de que el contenido identificado por su id, NO esté asociado al usuario.
	 */
	function contentExist($userID, $contentID)
	{
		$aMyContents    =   array();
		$exist 			= FALSE;
	  	//Obtengo lista de contenidos asociados a la cuenta de usuario.
	    $aMyContents = $this->getContents($userID);
	    foreach ($aMyContents as $data)
	    {	    	
	    	//Si el contenido está asociado al usuario.
			if($contentID == $data['ContentID'])
			{
				$exist = TRUE;
			}
	    }
	      //retorno resultado de la operación.
	      return $exist;	  
	}

	/* Function: openApp
	 * Función para obtener la ruta con la que se abrirá un contenido, validando si será la página de diagnostico.html ó content.html
	 * 
	 * Parameter:		
	 *		$userID - String Id del Usuario.
	 *      $contentID - Id del contenido que se abrirá.
	 *  
	 * Return:
	 *      String - Envía la url de la página html del contenido que se abrirá.
	 *      Bool - False ocurrió un error.
	 */
	function openApp($userID, $contentID)
	{
		$aContentInfo    =   array();
		$RootUrl		 =	 "";

		//Obtego la información del contenido que se abrirá.
		$aContentInfo = $this->getContentInstalledInfo($userID, $contentID);

		//Obtengo la ruta raíz de contenido.	
		$RootUrl = $aContentInfo['RootUrl'];
		if($RootUrl!="")
		{
			//Verifico si ya se realizó la prueba diagnóstica.
			$resultDiagnosis = json_decode($this->AQOL("resultDiagnosis", $userID, $contentID) , true);
		    if(isset($resultDiagnosis['errorCode']))
		      $RootUrl .= "diagnostico.php";
		    else
		      $RootUrl .= "content.php";

		    return $RootUrl;
			
		}else
		{
			return FALSE;
		}
	}

	/* function: getNewUsers
     * Esta función retorna la cantidad de usuarios nuevos de una plataforma de AMIGAS determinada por su ID, en un rango de tiempo determinado.
     *
     *  parameters:
     *     $dateFrom - String Fecha inicial de búsqueda
     *     $dateTo - String Fecha límite de búsqueda
     *     $plataformID - Int Id de la plataforma de la que sesea obtener el dato.
     * 
     *  return:
     *
     *     $newUsers - Json con la información de los usuarios nuevos en la plataforma
     */
	function getNewUsers($dateFrom, $dateTo, $plataformID)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=73&dateFrom='.$dateFrom.'&dateTo='.$dateTo.'&plataformID='.$plataformID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* function: getActiveUsers
     * Esta función retorna el número de usuarios activos de una plataforma de AMIGAS determinada por su ID, en un rango de tiempo determinado.
     *
     *  parameters:
     *     $monthsAgo - Int rango de meses en los que se evaluará la actividad, descontando desde el mes actual.
     *     $plataformID - Int Id de la plataforma de la que sesea obtener el dato.
     * 
     *  return:
     *
     *     $newUsers - JSON con la el número de usuarios activos en la plataforma
     */
    function getActiveUsers($monthsAgo, $plataformID)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=74&monthsAgo='.$monthsAgo.'&plataformID='.$plataformID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}


	/* Function: cHistoryByPlataform
     * Funcion para actualizar el historial de conexion, identificándose por plataforma a la que ingresa.
     * 
     * Parameter:
     *      $ip - String ip del usuario.
     *      $txtId - String Id del usuario
     *      $plataformID - Int Id de la plataforma de la que sesea obtener el dato.
     * 
     * Return:
     *      $str_Datos - Array JSON.
     */
	function cHistoryByPlataform($txtId, $ip, $plataformID)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=75&txtId='.$txtId.'&plataformID='.$plataformID.'&ip='.$ip;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: lastUserAction
     * Registra la última acción de un usuario
     * 
     * Parameter:
     *      $contentId - String Id del contenido.
     *      $IdUser - String Id del usuario
     * 
     * Return:
     *      $str_Datos - Int 1.
     */
	function lastUserAction($IdUser, $contentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=76&IdUser='.$IdUser.'&contentId='.$contentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: lastUserAction
     * Obtiene el tiempo en el que se debe registrar la última acción del usuario
	 * 
	 * Parameter:
	 * 
	 * Return:
	 *      $str_Datos - Array JSON.
	 */
	function timeToInsert()
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=77';
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getAmigasUserCode
     * Funcion para obtener el código Aulas AMIGAS del usuario.
     * 
     * Parameter:
     *      $txtId - String Id del usuario
     * 
     * Return:
     *      $str_Datos - Array JSON.
     */
	function getAmigasUserCode($txtId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=78&txtId='.$txtId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: updateTermsAgreements
     * Actualizar Terminos y Condiciones
     * 
     * Parameters:
     *      $IdAgree - Integer id de condiciones.
     *      $IdTerms - Integer id de terminos.
     *      $IdUser - Id del usuario
     * 
     * Return:
     *      1 - Integer actualizacion exitosa.
     * 
     * Para mayor informacion ver: <sp_UpdateAgreementsTerms>.
     */
	function updateTermsAgreements($IdAgree, $IdTerms, $IdUser)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=16&IdUser='.$IdUser.'&IdAgree='.$IdAgree.'&IdTerms='.$IdTerms;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: checkTermsAgreements
     * verificar estado de Terminos y Condiciones del usurio
     * 
     * Parameters:
     *      $IdCond - Integer id de la última versión de condiciones.
     *      $IdTerms - Integer id de la última versión de terminos.
     *      $IdUser - Id del usuario
     * 
     * Return:
     *      1 - Integer actualizacion exitosa.
     * 
     * 
     */
	function checkTermsAgreements($IdCond, $IdTerms, $IdUser)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=81&IdUser='.$IdUser.'&IdCond='.$IdCond.'&IdTerms='.$IdTerms;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: checkEmail
     * Funcion para verificar si el Email existe.
     * 
     * Parameter:
     *      $email - String email del usuario
     * 
     * Return:
     *      $str_Datos - Array JSON.
     */
	function checkEmail($email)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=45&Email='.$email;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* function: sendEmail
	 * Enviar email para restablecer contraseña.
	 * 
	 * Parameter:
	 *      $Email - String email del usuario a reestablecer contraseña.
	 * 
	 * Return:
	 *      1 - JSON Array enviado correctamente.
	 */
	function sendEmail($email, $id_content)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=44&Email='.$email.'&id_content='.$id_content;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

/* Function: infoUserProfile
     * Obtener informacion del Usuario mediante el token y la direccion URL oauth2 de Google.
     * 
     * Parameters:
     *
     *      $sessionToken - String token de acceso obtenido de google.
     *
     * Returns:
     *      $response - JSON Informacion del Usuario.
     *      0 - Boolean La Informacion no ha encontrado.
     */
	function infoUserProfile($sessionToken)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=65&sessionToken='.$sessionToken;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: SearchIdGoogle
     * Buscar Id del Usuario apartir del Usuario Google.
     * 
     * Parameters:
     *      $IdGoogle - Integer Id de Google.
     * 
     * Return:
     *      Por favor verificar el SP o FUNCION MySQL.
     */
	function SearchIdGoogle($IdGoogle)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=6&txtIdGoogle='.$IdGoogle;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: asocGoogleAccount
     * Asociar una cuenta de Google a una cuenta de AM3.
     * 
     * Parameters:
     *      $txtId - String Id de Usuario.
     *      $token - String token sin autenticar de google
     * 
     * Return:
     *      $jRespuesta - Json con información de la operación.
     */
	function asocGoogleAccount($txtId, $token)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=84&txtId='.$txtId.'&token='.$token;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true);
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: checkAsociateUserGoogle
     * Verifica si una cuenta AM3 tiene una cuenta de google asociada
     * 
     * Parameter:
     *      $txtId - String Id del usuario AM3
     * 
     * Return:
     *      $jRespuesta - Json con información de la operación.
     */
	function checkAsociateUserGoogle($txtId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=85&txtId='.$txtId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true);
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: asociatePin
     * Valida y asocia un PIN ingresado por el usuario, para acceder a contenido exclusivo de la plataforma.
     * 
     * Parameter:
     *      $txtId - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     *      $pin - String pin que se validará.
     * 
     * Return:
     *      TRUE - Si el pin se asoció correctamente.
     *      FALSE - Si el pin es inválido o ya está usado.
     */
    function asociatePin($txtId, $ContentId, $pin)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=86&txtId='.$txtId.'&ContentId='.$ContentId.'&pin='.$pin;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: checkPin
    * Valida si el usuario tiene el PIN activo que le permitirá acceder a contenido exclusivo de la plataforma.
    * 
    * Parameter:
    *      $txtId - String Id del usuario AM3
    *      $ContentId - Int Id de la plataforma o contenido que se invoca.
    * 
    * Return:
    *      TRUE - Si el usuario tiene el PIN activo.
    *      FALSE - Si el pin ya no es válido.
    */
    function checkPin($txtId, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=87&txtId='.$txtId.'&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getCitiesByCountry
    * Obtiene una lista de ciudades de acuerdo al código del país.
	* 
	* Parameter:
	*      $Code - String Código del país.
	* 
	* Return:
	*      $str_Datos - Json.
	*/
    function getCitiesByCountry($Code)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=83&Code='.$Code;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: sendRequestEmail
     * Enviar email solicitud de Blocs en Calificala.
     * 
     * Parameter:
     *      $name - String Nombre del usuario.
     *      $familyName - String Apellido del usuario.
     *      $city - Int Id de la ciudad del usuario
     *      $country - String nombre e id del país en el siguiente formato: id_pais ej: 2_Afghanistan
     *      $phone - String teléfono fijo del usuario
     *      $Email - String email del usuario
     *		$issue - String asunto del mensaje
     *		$message - String cuerpo del mensaje
     * 
     * Return:
     *      1 - JSON Array enviado correctamente.
     */
    function sendRequestEmail($Email, $name, $familyName, $city, $country, $phone, $issue, $message)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=89&Email='.$Email.'&name='.$name.'&familyName='.$familyName.'&city='.$city.'&country='.$country.'&phone='.$phone.'&issue='.$issue.'&message='.$message;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: updateContactUserInfo
     * Actualiza la información de contacto del usuario.
     *		
     *		Los campos disponibles para actualización son los siguientes:
     *		Email - String email del usuario, es un dato OBLIGATORIO, para realizar la actualización.
     *      FirstName - String Nombre del usuario.
     *      FamilyName - String Apellido del usuario.
     *      City - String nombre e Id de la ciudad del usuario en el siguiente formato: id_Ciudad ej: 2259_Medellín
     *      Country - String nombre e id del país en el siguiente formato: id_pais ej: 2_Afghanistan
     *      Phone - String teléfono fijo del usuario     
     *		Address - String Dirección del usuario
	 *		DocType - Int Tipo del documento de identidad.
	 *													1 Cédula de ciudadanía
	 *													2 Cédula de extranjería
	 *													3 Pasaporte
	 *													4 Tarjeta de identidad
	 *													5 Registro civil
	 *													6 Carné diplomático
	 *													<Llamar función getDocumentTypes()>
	 *		DocNumber - String número del documento de identidad.
	 *		
     * 
     * Parameters:
     *		$data - Array asociativo con los nombres de los campos que se actualizarán y sus respectivos valores.
     * Return:
     *      Json Array información del resultado: [{"mySQL":"1"}]: los campos se insertaron correctamente;
     *										 	  [{"mySQL":"0"}]: Ocurrió un error durante la inserción de datos.
     */
    function updateContactUserInfo($data)
	{  
	 	//Parametros post que se le enviaran a la funcion
		//$sParametrosPost = 'case=90&data='. json_encode($data, JSON_UNESCAPED_UNICODE);
		$sParametrosPost = 'case=90&data='. json_encode($data);
		/*$unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
		    return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
		}, $sParametrosPost);*/
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

   /* Function: getCountriesInfo
    * Retorna una lista de países, con sus respectivos códigos.
	* 
	* Parameter:
	* 
	* Return:
	*      String - Json con la información de los países.
	*/
    function getCountriesInfo()
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=88';
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_decode($jRespuesta, true);
	}

	/* Function: searchUsersByKeyWord
     * Búsqueda por usuario a partir de coincidencia con su nombre y apellidos.
     * 
     * Parameters:
     *      $txtKeyWord - String Palabra clave para la búsqueda.
     * 
     * Return:
     *      Json - String con la información básica de los usuarios que coincidan con la búsqueda:(id, nombre y apellidos).
     *      0 - Integer No se encontraron ausuarios.
     *      5 - Integer Cuando la información de los parámetros no es válida.
     */
    function searchUsersByKeyWord($txtKeyWord)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=91&txtKeyWord='.$txtKeyWord;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getContentVersion
	 * Obtiene la versión de un contenido de Amigas, establecido por su id.
	 *
	 * Parameters:
	 *       ContentId - Int Id del contenido del cual se quiere obtener la versión.
	 * 
	 * Returns:
	 *       Json con información de la versión del contenido.
	 *		 0 - Int No hay versión disponible.
	 *       6 - Int En caso de que no se haya especificado el id del contenido.
	 */
	function getContentVersion($ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=92&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: isConfirmed
    * Valida si el email del usuario ha sido confirmado.
    * 
    * Parameter:
    *      $txtId - String Id del usuario AM3
    * 
    * Return:
    *      1 - Si el correo del usuario ha sido confirmado.
    *      0 - Si el correo no se ha confirmado aún.
    *	   6 - Parámetro no válido
    */
    function isConfirmed($txtId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=94&txtId='.$txtId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* function: sendConfirmEmail
     * Envío email para comprobación de cuenta de correo electrónico.
     * 
     * Parameter:
     *      $txtId - String Id del usuario del que se comprobará su email.
     * 
     * Return:
     *      JSON Array enviado correctamente.
     */
	function sendConfirmEmail($txtId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=93&txtId='.$txtId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getTotalUsers
    * Obtiene el número total de usuarios registrados en una plataforma especificada por su id
    * 
    * Parameter:
    *      $plataformID - Int Id de la plataforma de la que sesea obtener el dato.
    * 
    * Return:
    *      $datos - Int Número de usuarios registrados.
    */
    function getTotalUsers($plataformID)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=95&plataformID='.$plataformID;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: sendByMandrill
     * Enviar email solicitud de Blocs en Calificala.
     * 
     * Parameter:
     *      $name - String Nombre del usuario.
     *      $email - String email del usuario
     *		$view - String Vista que se enviará.
     *		$asset - String Asunto del mensaje
     * 
     * Return:
     *      1 - JSON Array enviado correctamente.
     */
    function sendByMandrill($email, $name, $view, $asset)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=96&email='.$email.'&name='.$name.'&view='.$view.'&asset='.$asset;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: sendEmailByMandrillTemplate
     * Envía los correos por medio de Mandrill, utilizando plantillas (templates) almacenadas en éste.
     * 
     * Parameter:
     *      $parameters - String Json con los parámetros que se enviarán al servicio Mandrill.
     * 
     * Return:
     *      1 - JSON Array enviado correctamente.
     */
    function sendEmailByMandrillTemplate($parameters)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=99&parameters='.$parameters;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: blockUser
     * Función para bloquear un usuario en una plataforma o contenido identificado por su id.
     * 
     * Parameter:
     *      $IdUser - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     *      $locking_reason - String Razón escrita del por qué se ha bloqueado el usuario.
     * 
     * Return:
     *      Json - Código y descripción de ejecución.
     */
    function blockUser($IdUser, $ContentId, $locking_reason)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=100&IdUser='.$IdUser.'&ContentId='.$ContentId.'&locking_reason='.$locking_reason;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: unlockUser
     * Función para desbloquear un usuario previamente bloqueado en una plataforma o contenido identificado por su id.
     * 
     * Parameter:
     *      $IdUser - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     * 
     * Return:
     *      Json - Código y descripción de ejecución.
     */
    function unlockUser($IdUser, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=101&IdUser='.$IdUser.'&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: isUserLocked
     * Función para verificar si un usuario está bloqueado en una plataforma o contenido especificado por su id.
     * 
     * Parameter:
     *      $IdUser - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     * 
     * Return:
     *      Json - Código y descripción de ejecución.
     */
    function isUserLocked($IdUser, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=102&IdUser='.$IdUser.'&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getUsersInfoById
     * Obtiene información de varios usuarios enviando un array con los IDS en MD5 de éstos. 
     * Si un id de usuario no existe, se retornará éste con el parámetro: 'userExists' = 0
     *
     * Parameters:
     *      
     *     $aData - Array con los id de usuarios que se desean consultar.		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información de los usuarios.
     */
	public function getUsersInfoById($aData = array())
	{
		if(!empty($aData))
		{
			$sCadena	=	"";
			for($i = 0; $i<count($aData); $i++)
			{
				$sCadena.=	$aData[$i].',';	
			}
			//Parametros post que se le enviaran a la funcion
			$sParametrosPost = 'case=104&txtIdUsers='.$sCadena;
			$sesion = curl_init(URL_API_AMIGAS);
			//Definir tipo de petición post a realizar
			curl_setopt ($sesion, CURLOPT_POST, true); 
			// Le pasamos los datos definidos anteriormente en $sParametrosPost
			curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
			// Como queremos que nos devuelva la respuesta
			curl_setopt($sesion, CURLOPT_HEADER, false); 
			curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
			// Ejecutamos la petición
			$jRespuesta = curl_exec($sesion); 
			// Cerramos Conexión
			curl_close($sesion); 
			return $jRespuesta;
		}
		return FALSE;
	}

	/* Function: changeEmail
     * Función para realizar el cambio de email.
     * 
     * Parameter:
     *      $IdUser - String Id del usuario AM3 en md5
     *      $newEmail - String Nuevo email que se intenta registrar
     * 
     * Return:
     *      JSON Array email actualizado correctamente.
     *      0 - El Email ya existe.
     *      5 - Ocurrió un error al intentar actualizar el email.
     *      6 - Int falta datos
     */
    function changeEmail($IdUser, $newEmail)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=103&txtId='.$IdUser.'&newEmail='.$newEmail;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return json_encode($jRespuesta);
	}

	/* Function: updateUserEmail
     * Funcion para actualizar el email del usuario. Adicionalmente envía correo de comprobación de Email.
     * 
     * Parameter:
     *      $txtId - String Id del usuario en md5
     *      $newEmail - String Nuevo email que se asociará al usuario
     * 
     * Return:
     *      JSON Array email actualizado correctamente.
     *      5 - Ocurrió un error al intentar actualizar el email.
     *      6 - Int falta datos
     */
    function updateUserEmail($txtId, $newEmail)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=103&txtId='.$txtId.'&newEmail='.$newEmail;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	
	/* Function: save_file_local
     * Funcion para guardar en el local el progreso del usuario.
     * 
     * Parameter:
     *     $IdUser - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     * 
     * Return:
     *		JSON Array con los mismos parametros que estan en la usb
     */
    function save_file_local($IdUser, $ContentId)	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=105&txtIdUser='.$IdUser.'&txtIdContent='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	
	/* Function: save_file_local
     * Funcion para guardar en el local el progreso del usuario.
     * 
     * Parameter:
     *     $IdUser - String Id del usuario AM3
     *      $ContentId - Int Id de la plataforma o contenido que se invoca.
     * 
     * Return:
     *		JSON Array con los mismos parametros que estan en la usb
     */
	function sendMyProgress($IdUser, $ContentId, $parameters){
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=106&txtIdUser='.$IdUser.'&txtIdContent='.$ContentId.'&parameters='.$parameters;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
	
		 /* Function: get_miles_tomi
     * CANTIDAD DE MILLAS ACUMULADAS EN TOMI (EL TOTAL ESTÁ DADO EN MINUTOS)  Y SE ENCUENTRA AGRUPADO POR INSTITUCIÓN 
     *
     * Parameters:
     *      
     *     $sEmail - Email tipo string 
     * 		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del usuario.
     */
	public function get_miles_tomi($sEmail = "")
	{
		//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=107&uEmail='.urlencode($sEmail);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getUsersInfoByEmail
     * Obtiene información de varios usuarios enviando un array con los emails de éstos. 
     * Si un email de usuario no existe, se retornará éste con el parámetro: 'userExists' = 0
     *
     * Parameters:
     *      
     *     $aData - Array con los emails de usuarios que se desean consultar.		
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información de los usuarios.
     */
	public function getUsersInfoByEmail($aData = array())
	{
		if(!empty($aData))
		{
			$sCadena	=	"";
			for($i = 0; $i<count($aData); $i++)
			{
				$sCadena.=	$aData[$i].',';	
			}
			//Parametros post que se le enviaran a la funcion
			$sParametrosPost = 'case=108&emails='.$sCadena;
			$sesion = curl_init(URL_API_AMIGAS);
			//Definir tipo de petición post a realizar
			curl_setopt ($sesion, CURLOPT_POST, true); 
			// Le pasamos los datos definidos anteriormente en $sParametrosPost
			curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
			// Como queremos que nos devuelva la respuesta
			curl_setopt($sesion, CURLOPT_HEADER, false); 
			curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
			// Ejecutamos la petición
			$jRespuesta = curl_exec($sesion); 
			// Cerramos Conexión
			curl_close($sesion); 
			return $jRespuesta;
		}
		return FALSE;
	}


	/* Function: amigasFeedbackIn
     * Envía un feedback editado por el usuario mientras este tiene una sesión activa dentro de la plataforma.
     *
     * Parameters:
     *      
     *     $aData - String con los parámetros enviados desde el formulario de feedback.	
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del envío.
     */
	public function amigasFeedbackIn($aData)
	{
		if(!empty($aData))
		{
			//Parametros post que se le enviaran a la funcion
			$sParametrosPost = 'case=50&'.$aData;
			$sesion = curl_init(URL_API_AMIGAS);
			//Definir tipo de petición post a realizar
			curl_setopt ($sesion, CURLOPT_POST, true); 
			// Le pasamos los datos definidos anteriormente en $sParametrosPost
			curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
			// Como queremos que nos devuelva la respuesta
			curl_setopt($sesion, CURLOPT_HEADER, false); 
			curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
			// Ejecutamos la petición
			$jRespuesta = curl_exec($sesion); 
			// Cerramos Conexión
			curl_close($sesion); 
			return $jRespuesta;
		}
		return FALSE;
	}

	/* Function: amigasFeedbackOut
     * Envía un feedback editado por un usuario que no ha iniciado sesión dentro de la plataforma.
     *
     * Parameters:
     *      
     *     $aData - String con los parámetros enviados desde el formulario de feedback.	
     *		
     *
     * Return:
     *      $jRespuesta - JSON Información del envío.
     */
	public function amigasFeedbackOut($aData)
	{
		if(!empty($aData))
		{
			//Parametros post que se le enviaran a la funcion
			$sParametrosPost = 'case=51&'.$aData;
			$sesion = curl_init(URL_API_AMIGAS);
			//Definir tipo de petición post a realizar
			curl_setopt ($sesion, CURLOPT_POST, true); 
			// Le pasamos los datos definidos anteriormente en $sParametrosPost
			curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
			// Como queremos que nos devuelva la respuesta
			curl_setopt($sesion, CURLOPT_HEADER, false); 
			curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
			// Ejecutamos la petición
			$jRespuesta = curl_exec($sesion); 
			// Cerramos Conexión
			curl_close($sesion); 
			return $jRespuesta;
		}
		return FALSE;
	}

	/* Function: insertAreasAndTopics
     * Guarda la información de las nuevas áreas  y temas creados.
     * 
     * Paremeter:
     *      $data - Array con la información de areas y temas que se guardarán. Debe tener a siguiente estructura:
     *		EJ:
     *			$data = array(
	 *	 		array( 
	 *	 				'area'   => 'Musica',
	 *	 			    'topics' => array(
	 *	 			    					'Notas musicales',
	 *	 			    					'Partituras',
	 *	 			    					'Ritmo'
	 *	 			    				 )
	 *	 			  ),
	 *			array( 
	 *					'area'   => 'Programación',
	 *				    'topics' => array(
	 *				    					'Variables',
	 *				    					'Lógica',
	 *				    					'Clases'
	 *				    				 )
	 *				  ),
	 *		  );
     *      $ContentId - Int Id del contenido al que se asociarán las áreas
     * Return:
     *      $id_area - Int id de la nueva área que se guardó.
     *		FALSE - Bool El área no pudo guardarse. 
     * 
     */
	public function insertAreasAndTopics($data, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=110&$ContentId='.$ContentId.'&data='. json_encode($data);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: saveTopicsOnly
     * Funcion para guardar nuevos temas asociados a un área.
     * 
     * Parameter:
     *		$IdArea - Int Id del área que se deshabilitará.
     *      $topics - Array con el nombre de los temas que se guardarán.
     * 
     * Return:
     *      true - Bool las materias se guardaron correctamente.
     *		FALSE - Bool El área no pudo guardarse.
     */
	public function saveTopicsOnly($IdArea, $topics)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=111&IdArea=' . $IdArea . '&topics='. json_encode($topics);
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: saveAreaOnly
     * Funcion para guardar una nueva área.
     * 
     * Parameter:
     *      $nameArea - String nombre de la nueva área que se guardará.
     * 
     * Return:
     *      $Id_area - Int id de la nueva área que se guardó.
     *		FALSE - Bool El área no pudo guardarse.
     */
	public function saveAreaOnly($nameArea)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=117&nameArea='.$nameArea;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: disableAreaToContent
     * Funcion para deshabilitar un área especifica, en un contenido.
     * 
     * Parameter:
     *      $IdArea - Int Id del área que se deshabilitará.
     *		$ContentId - Int Id del contenido al que se le deshabilitará el área.
     * 
     * Return:
     *      TRUE - Bool El área se deshabilitó correctamente
     *		FALSE - Bool El área no pudo deshabilitarse.
     */
	public function disableAreaToContent($IdArea, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=112&IdArea='.$IdArea.'&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: enableAreaToContent
     * Funcion para habilitar un área especifica, en un contenido.
     * 
     * Parameter:
     *      $IdArea - Int Id del área que se habilitará.
     *		$ContentId - Int Id del contenido al que se le habilitará el área.
     * 
     * Return:
     *      TRUE - Bool El área se habilitó correctamente
     *		FALSE - Bool El área no pudo habilitarse.
     */
	public function enableAreaToContent($IdArea, $ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=113&IdArea='.$IdArea.'&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getTopicsByArea
     * Funcion para obtener los temas asociados a un área específica.
     * 
     * Parameter:
     *      $IdArea - Int Id del área que solicita los temas asociados a ésta.
     * 
     * Return:
     *      Json Array información de los temas disponibles.
     *		8 - No se especificó el id del área
     */
	public function getTopicsByArea($IdArea)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=114&IdArea='.$IdArea;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getAreasByContent
     * Funcion para obtener las áreas asociadas a un contenido y su estado: 1 - habilitada, 0 - Deshabilitada.
     * 
     * Parameter:
     *      $ContentId - Int Id del contenido que solicita las áreas asociadas a éste.
     * 
     * Return:
     *      Json Array información de areas disponibles.
     *		8 - No se especificó el id del contenido
     */
	public function getAreasByContent($ContentId)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=115&ContentId='.$ContentId;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: getDocumentTypes
     * Funcion para obtener los tipos de documentos de identidad.
     * 
     * Parameter:
     * 
     * Return:
     *      Array información de los tipos de documentos disponibles.
     */
	public function getDocumentTypes()
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=116';
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: searchTeachers
     * Funcion para obtener información de los profesores, a través de la información solicitada en los parámetros de búsqueda.
     * 
     * Parameter:
     *      $IdArea - Int Id del área asociada al profesor que se buscará.
     *		$IdTopic - Int Id de el tema asociado al profesor que se buscará.
     *		$IdCity - Int Id de la ciudad asociada al profesor que se buscará.
     * 
     * Return:
     *      Json Array información de los profesores que corresponden con los parámetros de búsqueda.
     *		8 - Falta algún parámetro.
     */
	public function searchTeachers($IdArea, $IdTopic, $IdCity)
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=118&IdArea='.$IdArea . '&IdTopic=' . $IdTopic . '&IdCity=' . $IdCity;
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}

	/* Function: get_terms_and_agreements
	 * Listar los terminos y condiciones actuales.
     * 
     * parameters:
     *      void.
     * 
     * return:
     *      $array_terms_and_condictions - Json Array terms - Terminos y Condiciones.
     *      FALSE - Boolean No hay información.
     */
	public function get_terms_and_agreements()
	{  
	 	//Parametros post que se le enviaran a la funcion
		$sParametrosPost = 'case=120';
		$sesion = curl_init(URL_API_AMIGAS);
		//Definir tipo de petición post a realizar
		curl_setopt ($sesion, CURLOPT_POST, true); 
		// Le pasamos los datos definidos anteriormente en $sParametrosPost
		curl_setopt ($sesion, CURLOPT_POSTFIELDS, $sParametrosPost); 
		// Como queremos que nos devuelva la respuesta
		curl_setopt($sesion, CURLOPT_HEADER, false); 
		curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
		// Ejecutamos la petición
		$jRespuesta = curl_exec($sesion); 
		// Cerramos Conexión
		curl_close($sesion); 
		return $jRespuesta;
	}
}