
<?php
require 'conectar.php';


function formulario(){
    echo "<form name=\"consulta\" action=\"index.php?pagina=Relatorio\" method=\"POST\">
    <table border=\"0\" align=\"center\">
    <thead>
    </thead>
    <tbody>
    <tr>
        <td class=\"descCampo\">Data Inicial: </td>
        <td><input type=\"text\" name=\"dtInicial\" value=\"\" size=\"20\" ></td>
        <td class=\"descCampo\"d>Data Final</td>
        <td><input type=\"text\" name=\"dtFinal\" value=\"\" size=\"20\"></td>
    </tr>
    <tr>
        <td colspan=\"4\" align=\"right\"><input type=\"submit\" value=\"Imprimir\" name=\"imprimir\" /></td>
    </tr>
    </tbody>
    </table></form>";

}

formulario();


if (array_key_exists("imprimir",$_POST)){
$_SESSION['dtInicial'] = dtBanco($_POST['dtInicial']);
$_SESSION['dtFinal'] = dtBanco($_POST['dtFinal']);
echo "<script>window.open('relatorioProtocoloImprimir.php','_blank');</script>";

    }

?>
