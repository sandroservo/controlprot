<link href="adm.css" rel="stylesheet" type="text/css" />
<?php
require 'conectar.php';

$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codUsuario = $_GET['cod'];
function consultar($dado,$campo){

    if ($dado=='nome'){
        $sql = "SELECT * FROM usuarios where nome like '%$campo%'" ;
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        else{
            $sql = "SELECT * FROM usuarios where $dado = $campo";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
    $total = mysql_num_rows($resultado);
    while ($linha = mysql_fetch_array($resultado)){
        echo "<table border=\"0\" align=\"center\" >
            <thead>
            <tr >
                <td width=\"80\" align=\"left\"><label >Codigo:</label></td>
                <td width=\"400\"align=\"left\"><label> ".$linha['codUsuario']."</label></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><label>Nome:</label></td>
                <td><label>".$linha['nome']."</label></td>
            </tr>
            <tr>
                <td><label>E-mail: </label></td>
                <td><label>".$linha['email']."</label></td>
            </tr>
            <tr>
                <td><label>Produto:</label></td>
                <td><label>".$linha['produto']."</label></td>
            </tr>
            <tr>
                <td><label>Senha:</label></td>
                <td><label>Solicitar Nova Senha</label></td>
            </tr>
            <tr>
                <td><label>Data Criaçãoo:</label></td>
                <td><label>".$linha['dataCriacao']."</label></td>
            </tr>
            <tr>
                <td><label>Nivel:</label></td>
                <td><label>";
                            //verifica flag no banco e apresenta com nome completo
                            if($linha['nivel']=='A'){echo "Administrador";}
                            if($linha['nivel']=='R'){echo "Receptor";}
                            if($linha['nivel']=='U'){echo "UsuÃ¡rio";}
                echo "</label></td>
            </tr>
            <tr>
                <td><label>Empresa</label></td>
                <td><label>".$linha['empresa']."</label></td>
            </tr>
            <tr>
                <td><label><input type=\"submit\" value=\"Alterar\" name=\"alterar\" /></label></td>
                <td><label><a href=\"consultaUsuario.php?tipo=excluir&cod=".$linha['codUsuario']."\">Excluir</label></td>
            </tr>
            </tbody>
            </table>
";


echo "<br><br><table border=\"0\" align=\"center\">
        <thead>
        <tr>
        <td><label>Total de Registros:$total</label></td>
        </tr>
        </thead>
        <tbody>
        </table>";

     }
    
}


function formulario(){
    echo "<form name=\"consulta\" action=\"consultaUsuario.php\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr>
        <th height=\"30\"><label for=\"codigo\"><input type=\"radio\" name=\"dado\" value=\"codUsuario\" id=\"codigo\" CHECKED/>Codigo</label></th>
        <th height=\"30\"><label for=\"nome\"><input type=\"radio\" name=\"dado\" value=\"nome\" id=\"nome\"/>Nome</label</th>
        <th height=\"30\"><label for=\"codEmpresa\"><input type=\"radio\" name=\"dado\" value=\"codEmpresa\" id=\"codEmpresa\"/>Empresa</label></th>
</tr>
    </thead>
    <tbody>
    <tr>
        <td height=\"30\"><label for=\"campo\">Consulta:</label></td>
        <td colspan=\"4\"><input type=\"text\" name=\"campo\" value=\"\" size=\"50\" id=\"campo\"></td>
    </tr>
    <tr>
        <td colspan=\"5\" align=\"right\" height=\"30\"><input type=\"submit\" value=\"Consultar\" name=\"consultar\" /></td>

    </tr>
    </tbody>
    </table></form>";

}

function excluir($codUsuario){

    $sql = "DELETE FROM usuarios WHERE codUsuario=$codUsuario";
    $resultado = mysql_query($sql) or die ("sql com erro");

    echo "MovimentaÃ§Ã£o Deletada com Sucesso";


}


        formulario();

if (array_key_exists("consultar",$_POST)){

        consultar($dado,$campo);
    }
    if ($tipo =='excluir'){
        excluir($codUsuario);
        }

?>
