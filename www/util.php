
<?

/*######### FUNCÕES DE DATAS ####################################
Função que converte Y-m-d para d/m/Y
Utilizado para manipular datas no formato Date do MySQL
exibindo no formato convencional.
############################################################## */
function dtPadrao($data) {
$data = trim($data);
if (strlen($data) < 10)
{
$rs = "";
}
else
{
$arr_data = explode(" ",$data);
$data_db = $arr_data[0];
$arr_data = explode("-",$data_db);
$data_form = $arr_data[2]."/".$arr_data[1]."/".$arr_data[0];
$rs = $data_form;
}
return $rs;
}

/*
Função que converte d/m/Y para Y-m-d
Utilizado para inserir datas do tipo converncional em
campos tipo Date do MySQL
*/
function dtBanco($data) {
$data = trim($data);
if (strlen($data) != 10)
{
$rs = "";
}
else
{
$arr_data = explode("/",$data);
$data_banco = $arr_data[2]."-".$arr_data[1]."-".$arr_data[0];
$rs = $data_banco;
}
return $rs;
}
//_________________________________________________
