<?php

session_start();
?>

<body onload="document.cadastro.empresa.focus()">

<link href="adm.css" rel="stylesheet" type="text/css" />

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

<?
require "conectar.php";

//formulario ao qual exibe labels e campos para digitar informaï¿½ï¿½es
function formulario(){



echo "<form method=\"POST\" name=\"cadastro\" onSubmit=\"return verificar()\" action=\"cadastroEmpresa.php\">
<table border=\"0\" align=center>
<tr>
  <td class=\"descCampo\" ><label for=\"empresa\">Empresa:</label></td>
  <td><input type=\"text\" maxlength=\"45\" size=\"50\" name=\"empresa\" id=\"cadastroEmpresa\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cnpj\">CNPJ:</label></td>
  <td><input type=\"text\" maxlength=\"14\" size=\"50\" name=\"cnpj\" id=\"cnpj\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cnpj\">DDD/Telefone:</label></td>
  <td><input type=\"text\" maxlength=\"3\" size=\"3\" name=\"dddtelefone\" id=\"dddtelefone\">
      <input type=\"text\" maxlength=\"8\" size=\"42\" name=\"telefone\" id=\"telefone\">
    </td>
</tr>
<tr>
  <td class=\"descCampo\" > <label for=\"status\">Status: </label></td>
  <td><select name=\"status\" id=\"status\" style=\"width: 326px;\">
<option>Ativado</option>
<option>Desativado</option>
</select></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cep\">CEP: </label></td>
  <td><input type=\"text\" maxlength=\"8\" name=\"cep\" size=\"50\" id=\"cep\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"logradouro\">Logradouro: </label></td>
  <td><input type=\"text\" maxlength=\"8\" name=\"logradouro\" size=\"50\" id=\"logradouro\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"bairro\">Bairro: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"bairro\" size=\"50\" id=\"bairro\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"n\">Nº: </label></td>
  <td><input type=\"text\" maxlength=\"8\" name=\"n\" size=\"12\" id=\"n\">
  <label for=\"complemento\">Complemento: </label>
  <input type=\"text\" maxlength=\"8\" name=\"complemento\" size=\"18\" id=\"complemento\">
    </td>
</tr>
<tr>
<tr>
  <td class=\"descCampo\" ><label for=\"cidade\">Cidade: </label></td>
  <td><input type=\"text\" maxlength=\"45\" name=\"cidade\" size=\"50\" id=\"cidade\"></td>
</tr>
<tr>
  <td class=\"descCampo\" ><label for=\"estado\">Estado:</label></td>
  <td>
      <select size=\"1\" name=\"estado\" id=\"estado\" style=\"width: 327px;\"  >
      <option>Selecione</option>
      <option>Acre</option>
      <option>Alagoas</option>
      <option>Amapá¡</option>
      <option>Amazonas</option>
      <option>Bahia</option>
      <option>Ceará¡</option>
      <option>Distrito Federal</option>
      <option>Goiás</option>
      <option>Espírito Santo</option>
      <option>Maranhãoo</option>
      <option>Mato Grosso</option>
      <option>Mato Grosso do Sul</option>
      <option>Minas Gerais</option>
      <option>Pará¡</option>
      <option>Paraiba</option>
      <option>Paraná¡</option>
      <option>Pernambuco</option>
      <option>Piaui­</option>
      <option>Rio de Janeiro</option>
      <option>Rio Grande do Norte</option>
      <option>Rio Grande do Sul</option>
      <option>RondÃ´nia</option>
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
$empresa = ucwords($_POST['empresa']);
$cidade = ucwords($_POST['cidade']);
$status = $_POST['status'];
$estado = $_POST['estado'];


$sql = "INSERT INTO empresa (codEmpresa,nome,cidade,estado,status) VALUES (' ','$empresa','$cidade','$estado','$status')";
$resultadosql = mysql_query($sql) or die ("erro sql".mysql_error());
echo "<div class=msgG>Registro gravado com sucesso</div>";

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

