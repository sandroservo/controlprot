
<?
function converteData($data){
$data_nova = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
return $data_nova;
}

echo "<script>
function janela (){
window.open(\"admin.php\",\"\",\"toolbar=no,scrollbars=no,location=no,directories=no,menubar=no,resizable=no,width=721,height=542,\");
}

</script>";
?>

