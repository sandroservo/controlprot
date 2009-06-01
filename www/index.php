<?php session_start();?>
<html>
  <head>
    <title>Login - Controlprot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel=stylesheet href=default.css type=text/css>
  </head>
  <body>
<?php
require('conectar.php');
function anti_injection($sql){
  $sql = preg_replace(sql_regcase("/(from|select|insert|name|like|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
  $sql = trim($sql);
  $sql = strip_tags($sql);
  $sql = addslashes($sql);
return $sql;
}

function formulario(){
echo "<div class=\"fundoLogin\"><center><div class=index>";
echo "<form method=\"POST\" action=index.php>

<table border=\"0\">
<thead>
<tr>
<td class=\"descCampo\">Usuario:</td>
<td> <input name=login size=20></td>
</tr>
</thead>
<tbody>
<tr>
<td class=\"descCampo\">Senha:</td>
<td><input name=senha type=\"password\" size=20></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>

<input type=submit name=enviado value=Login>
</form></div></center></div>";
}

function novaSenha(){
echo "<div class=\"fundoTransparente\"><center><div class=trocaSenha>";
echo "<h3>Nova Senha</h3><form method=\"POST\" action=index.php>

<table border=\"0\">
<thead>
<tr>
<td class=\"descCampo\"></td>
<td> <input name=login size=20></td>
</tr>
</thead>
<tbody>
<tr>
<td class=\"descCampo\">Senha:</td>
<td><input name=senha type=\"password\" size=20></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</tbody>
</table>

<input type=submit name=enviado value=Login>
</form></div></center></div>";

}


function verifica(){
$login = anti_injection($_POST["login"]);
$senha = md5(anti_injection($_POST["senha"]).dificilsenha2009);
if ((!$login) || (!$senha)){
echo "<center><div class=\"msgR\">Senha ou Login em branco<br>";
echo "<div class=\"linkLogin\"><a href=\"index.php\" >Tentar novamente</a></div></div></center>";
}else{
$sql = "select dataUltimoLogin,nivel,codEmpresa,status,login,senha from usuarios where login='$login' and senha='$senha'";
$resultado = mysql_query($sql);
$linha = mysql_fetch_array($resultado);
$total = @mysql_num_rows($resultado);
if (!$total){
  echo "<script language=\"JavaScript\">
    alert(\"Usuário ou senha inválida.\");
    document.location=\"index.php\";
</script>";
    }else{

        $_SESSION['nivelIndex'] = $linha['nivel'];
        $_SESSION['statusIndex'] = $linha['status'];
        $_SESSION['codEmpresaIndex'] = $linha['codEmpresa'];
        $_SESSION['loginIndex'] = $linha['login'];
        if ($_SESSION['statusIndex']=='A'){
            if ($linha['dataUltimoLogin']==""){
                formulario();
                novaSenha();

            }else{
                novaSenha();
                //echo "<script language=\"JavaScript\">
                    //document.location=\"index2.php\";
                    //</script>";
                 }
            }else{
                echo "<script language=\"JavaScript\">
                alert(\"Este usuário está desativado, contate o administrador.\");
                document.location=\"index.php\";
                </script>";
                }
        }
}
}

if (!array_key_exists("enviado",$_POST))
{
formulario();
}
else {
verifica();
}

?>
  </body>
</html>

