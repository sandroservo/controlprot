
//########## MASCARA PARA DATAS ###########
function DigitaData(campo) {


var data = new String( campo.value );
var wData = '';
var cont = 0;

for (i=0; i<data.length ; i++) {
        if (i <= 1) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                wData += data.charAt(i);
                }else{
                    cont++;
                    }
        }

        if (i == 2) {
            if ( data.charAt(i) == '/' ) {
                wData += data.charAt(i);
                }else {
                    if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                        wData += '/';
                        wData += data.charAt(i);
                        cont ++;
                        }else {
                            wData += '/';
                            cont ++;
                            } 
                }
         }

        if (i > 2 && i <= 4) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                wData += data.charAt(i);
                }else{
                    cont++;
                    }
        }

        if (i == 5) {
            if ( data.charAt(i) == '/' ) {
                wData += data.charAt(i);
                }else {
                     if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
                     wData += '/';
                     wData += data.charAt(i);
                     cont++;
                     }else {
                        wData += '/';
                        cont++;
                        }
                }
         }

        if (i > 5 && i <= 9) {
            if ( data.charAt(i) >= '0' && data.charAt(i) <= '9' ) {
            wData += data.charAt(i);
            }else{
                cont++;
                }
        }

        if (i > 9 ){
            cont++;
            }
}//fim do for

if ( cont > 0 ){
    // Atualiza o campo
    campo.value = wData;
    }
}

//__________________________________________________________



//*********FUNCÇÃO PARA APARECER E DESAPARECER DIV ADM************
function trocar(tipo){
		var Layer = document.getElementById("central");

        if (tipo == 1){
			Layer.style.visibility = 'visible';
		} else {
			Layer.style.visibility = 'hidden';
		}
}
//_____________________________________________________________



// Código Original/ Original Code by Woodys
// Converte formato do DATETIME do MySQL para um compreensível para os homens
// 2003-12-30 23:30:59 -> 30/12/2003 23:30:59
function mysql_datetime_para_humano($dt) {
        $yr=strval(substr($dt,0,4));
        $mo=strval(substr($dt,5,2));
        $da=strval(substr($dt,8,2));
        $hr=strval(substr($dt,11,2));
        $mi=strval(substr($dt,14,2));
        return date("d/m/Y H:i:s", mktime ($hr,$mi,0,$mo,$da,$yr));
}
// Converte formato DATE do MySQL para o humano
// 2003-12-30 -> 30/12/2003
function mysql_date_para_humano($dt) {
        if ($dt=="0000-00-00") return '';
        $yr=strval(substr($dt,0,4));
        $mo=strval(substr($dt,5,2));
        $da=strval(substr($dt,8,2));
        return date("d/m/Y", mktime (0,0,0,$mo,$da,$yr));
}
