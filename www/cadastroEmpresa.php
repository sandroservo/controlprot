<?php

session_start();
?>

<script type="text/javascript">

function verificar(){

if (document.cadastro.empresa.value==""){
document.cadastro.empresa.focus()
alert("Digite um Nome")
return false
}
if (document.cadastro.cidade.value==""){
document.cadastro.cidade.focus()
alert("Digite uma Cidade")
return false
}
if (document.cadastro.estado.value==Selecione)
{
document.cadastro.estado.focus()
alert('Selecione Estado')
return false
}
}


</script>

<style>


input{
border-style:solid;
border-color:black;
border-width:1px;
font-family:verdana;
font-size:12px;
}
label, select{
font-family:verdana;
font-size:12px;
}

 .descCampo{
    background-color:silver;
    font-weight:bold;

}
.msg{
    position:relative;
    width:500px;
    text-align:center;
    border-width:1;
    border-style:solid;
    border-color:black;
    background-color:silver;
    font-family:verdana;
    font-size:12;
    font-weight:bold;
}
</style>


<?
require "conectar.php";

//formulario ao qual exibe labels e campos para digitar informa��es
function formulario(){



echo "<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroEmpresa.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"empresa\">Empresa:</label></td>
  <td><input type=\"text\" maxlength=\"45\" size=\"50\" name=\"empresa\" id=\"cadastroEmpresa\"></td>
</tr>
<tr>
  <td class=\"descCampo\" > <label for=\"status\">Status: </label></td>
  <td><select name=\"status\" id=\"status\" style=\"width: 320px;\">
<option>Ativado</option>
<option>Desativado</option>
</select></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cidade\">Cidade: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"cidade\" size=\"50\" id=\"cidade\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"estado\">Estado:</label></td>
  <td>
      <select size=\"1\" name=\"estado\" id=\"estado\" style=\"width: 320px;\"  >
      <option>Selecione</option>
      <option>Acre</option>
      <option>Alagoas</option>
      <option>Amapá</option>
      <option>Amazonas</option>
      <option>Bahia</option>
      <option>Ceará</option>
      <option>Distrito Federal</option>
      <option>Goiós</option>
      <option>Espírito Santo</option>
      <option>Maranhão</option>
      <option>Mato Grosso</option>
      <option>Mato Grosso do Sul</option>
      <option>Minas Gerais</option>
      <option>Pará</option>
      <option>Paraiba</option>
      <option>Paraná</option>
      <option>Pernambuco</option>
      <option>Piauí</option>
      <option>Rio de Janeiro</option>
      <option>Rio Grande do Norte</option>
      <option>Rio Grande do Sul</option>
      <option>Rondônia</option>
      <option>Roraima</option>
      <option>São Paulo</option>
      <option>Santa Catarina</option>
      <option>Sergipe</option>
      <option>Tocantins</option>
      </select>
  </td>
</tr>
<tr>
    <td colspan=2 align=\"center\"><input type=\"submit\" value=\"salvar\" name=\"salvar\" >
</tr>
</table>
</form>";}
//fim formulario

//insere campos por sql no banco de dados
function gravar(){
$empresa = $_POST['empresa'];
$cidade = $_POST['cidade'];
$status = $_POST['status'];
$estado = $_POST['estado'];
/*if ($empresa=='' && $empresa=='' && $estado=='' && $_POST['empresa'] ){
   echo "<div class=msg>falta tudo</div>";
   }else {
         echo "Registro gravado com sucesso";
         }*/
$sql = "INSERT INTO empresa (codEmpresa,nome,cidade,estado,status) VALUES (' ','$empresa','$cidade','$estado','$status')";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());
echo "<div class=msg>Registro gravado com sucesso</div>";

};
//fim gravar

if (!array_key_exists("salvar",$_POST)){
formulario();
   }
   else{
   gravar();
   formulario();
     
     }



?>

