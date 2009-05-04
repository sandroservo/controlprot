<style>


input {
background-color:#F0F0F0;
font-family:verdana;
font-size:12px;
}
label,select{
font-family:verdana;
font-size:12px;

}



</style>

<?php
require 'conectar.php';

$dado = $_POST['dado'];
$campo = $_POST['campo'];

$tipo = $_GET['tipo'];
$codEmpresa = $_GET['cod'];

function consultar($dado,$campo){

    if ($dado=='nome'){
        $sql = "SELECT * FROM empresa where nome like '%$campo%'" ;
        $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
        }
        else{
            $sql = "SELECT * FROM empresa where $dado = $campo";
            $resultado = mysql_query($sql) or die ("erro sql".mysql_error());
            }
//--SELECT * FROM empresa where codEmpresa = 2
//--SELECT * FROM empresa where nome like '%1%'
    while ($linha = mysql_fetch_array($resultado)){
        echo "<table border=\"0\" align=\"center\" >
            <thead>
            <tr >
                <td width=\"80\" align=\"left\"><label >Codigo:</label></td>
                <td width=\"400\"align=\"left\"><label> ".$linha['codEmpresa']."</label></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><label>Nome:</label></td>
                <td><label>".$linha['nome']."</label></td>
            </tr>
            <tr>
                <td><label>Cidade</label></td>
                <td><label>".$linha['cidade']."</label></td>
            </tr>
            <tr>
                <td><label>Estado:</label></td>
                <td><label>".$linha['estado']."</label></td>
            </tr>
            <tr>
                <td><label><input type=\"submit\" value=\"Alterar\" name=\"alterar\" /></label></td>
                <td><label><a href=\"consultaEmpresa.php?tipo=excluir&cod=".$linha['codEmpresa']."\">Excluir</label></td>
            </tr>
                </tbody>
            </table>
";

$total = mysql_num_rows($resultado);
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
    echo "<form name=\"consulta\" action=\"consultaEmpresa.php\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    <tr>
        <th height=\"30\"><label for=\"codigo\"><input type=\"radio\" name=\"dado\" value=\"codEmpresa\" id=\"codigo\" CHECKED/>Codigo</label></th>
        <th height=\"30\"><label for=\"nome\"><input type=\"radio\" name=\"dado\" value=\"nome\" id=\"nome\"/>Nome</nome></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td height=\"30\"><label for=\"campo\">Consulta:</label></td>
        <td><input type=\"text\" name=\"campo\" value=\"\" size=\"50\" id=\"campo\"></td>
    </tr>
    <tr>
        <td colspan=\"2\" align=\"right\" height=\"30\"><input type=\"submit\" value=\"Consultar\" name=\"consultar\" /></td>
    </tr>
    </tbody>
    </table></form>";

}

function excluir($codEmpresa){

    $sql = "DELETE FROM empresa WHERE codEmpresa=$codEmpresa";
    
    $resultado = mysql_query($sql) or die (mysql_error());
    echo "Movimentação Deletada com Sucesso";


}


        formulario();

if (array_key_exists("consultar",$_POST)){

        consultar($dado,$campo);
    }
    if ($tipo =='excluir'){
        excluir($codEmpresa);
        }

?>
