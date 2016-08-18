/**
 * Filtra caracteres especiales que llegan desde PHP y se quieren ver mediante javascript
 * @param msg
 * @returns {String}
 */
function filtroCaracteresJavascript(msg) {
	var output = '';
	for(var i in msg) {
		switch (msg.charAt(i)) {
			case 'á':
				output += '\xe1';
				break;
			case 'é':
				output += '\xe9';
				break;
			case 'í':
				output += '\xed';
				break;
			case 'ó':
				output += '\xf3';
				break;
			case 'ú':
				output += '\xfa';
				break;
			case 'ñ':
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
			case 'á':
				output += '&aacute;';
				break;
			case 'é':
				output += '&eacute;';
				break;
			case 'í':
				output += '&iacute;';
				break;
			case 'ó':
				output += '&oacute;';
				break;
			case 'ú':
				output += '&uacute;';
				break;
			case 'ñ':
				output += '&ntilde;';
				break;
			case 'Á':
				output += '&Aacute;';
				break;
			case 'É':
				output += '&Eacute;';
				break;
			case 'Í':
				output += '&Iacute;';
				break;
			case 'Ó':
				output += '&Oacute;';
				break;
			case 'Ú':
				output += '&Uacute;';
				break;
			case 'Ñ':
				output += '&Ntilde;';
				break;
			default :
				output += msg.charAt(i);
		}
	}
	
	return output;
}