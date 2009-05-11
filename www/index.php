<? session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Popular
Version    : 1.0
Released   : 20080519
Description: A two-column, fixed-width and lightweight template ideal for 1024x768 resolutions. Suitable for blogs and small websites.

    _____________________________________________________________
    |        SISTEMA PROTOCOLOS PARA DOCUMENTOS FIS�COS         |
    |�����������������������������������������������������������|
    | Elaborado por: Charles Reitz                                 |
    | E-mail/MSN: charles.reitz@gmail.com                       |
    | -> Disciplina de Analise e Desenvolvimento de Sistemas    |
    | -> Prof. MEng. Sigmundo Preissler Jr.                     |
    | -> UNERJ - Jaragu� do Sul - SC - www.unerj.br             |
    |___________________________________________________________|
    |                       Etapas                              |
    |�����������������������������������������������������������|
    |1 - Documento                                      [75%]   |
    |2 - Modelo Banco Dados                             [100%]  |
    |3 - Desenvolvimento                                [45% ]  |
    |4 - Testes/Implementa��o/Documenta��o              [0%  ]  |
    |5 - Banca                                          [0%  ]  |
    |___________________________________________________________|

-->



<html>
<head>
<title>Popular by Free Css Templates</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- inicio menu -->
<div id="logo">

</div>

<div id="header">
	<div id="menu">
		<ul>
            <li><a href="index.php">Home</a></li>
			<li><a href="index.php?pagina=Novo">Novo Protocolo</a></li>
			<li><a href="index.php?pagina=Consulta">Consultar Protocolo</a></li>
			<li><a href="index.php?pagina=Relatorio">Relatório de Protocolos</a></li>
          	<li><a href="index.php?pagina=Administrador">Administrador</a></li>
            <li class="last"><a href="#">Sair</a></li>
		</ul>
	</div>
</div>
<!-- fim menu -->

<!-- inicio pagina -->
<div id="page">
  <p>
    <?php

    
    
    $pagina=$_GET['pagina'];
    
    if ($pagina=="Novo"){
        require ("cadastroProtocolo.php");
        }
        if($pagina=="Consulta"){
            require("consultaProtocolo.php");
            }
            if($pagina=="Relatorio"){
                require("relatorioProtocolo.php");
                }
                if($pagina=="Administrador"){
                    require("indexAdministrador.php");
                    }
                    else{
                    require ("home.php");
                    }




?>
</p>
</div>
<!-- fim pagina -->

<!--inicio rodape-->
<div id="footer">
	<p id="legal">Desenvolvido por Charles Reitz - 2009</p>
<!-- fim rodape -->
</body>
</html>
