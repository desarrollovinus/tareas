/**
 * Filtra caracteres especiales que llegan desde PHP y se quieren ver mediante javascript
 * @param msg
 * @returns {String}
 */
function filtroCaracteresJavascript(msg) {
	var output = '';
	for(var i in msg) {
		switch (msg.charAt(i)) {
			case '�':
				output += '\xe1';
				break;
			case '�':
				output += '\xe9';
				break;
			case '�':
				output += '\xed';
				break;
			case '�':
				output += '\xf3';
				break;
			case '�':
				output += '\xfa';
				break;
			case '�':
				output += '\xf1';
				break;
			default :
				output += msg.charAt(i);
		}
	}
	
	return output;
}

/**
 * Filtra caracteres que se van a enviar a PHP mediante jQuery
 * @param msg
 * @returns {String}
 */
function filtroCaracteresPHP(msg) {
	var output = '';
	for(var i in msg) {
		switch (msg.charAt(i)) {
			case '�':
				output += '&aacute;';
				break;
			case '�':
				output += '&eacute;';
				break;
			case '�':
				output += '&iacute;';
				break;
			case '�':
				output += '&oacute;';
				break;
			case '�':
				output += '&uacute;';
				break;
			case '�':
				output += '&ntilde;';
				break;
			case '�':
				output += '&Aacute;';
				break;
			case '�':
				output += '&Eacute;';
				break;
			case '�':
				output += '&Iacute;';
				break;
			case '�':
				output += '&Oacute;';
				break;
			case '�':
				output += '&Uacute;';
				break;
			case '�':
				output += '&Ntilde;';
				break;
			default :
				output += msg.charAt(i);
		}
	}
	
	return output;
}