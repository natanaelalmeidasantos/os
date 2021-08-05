
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sistema de O.S</title>
<meta charset="UTF-8" />
<!-- chamando CSS e Scrpts nescessarios -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

</head>
<body>

<!--Header-->
<div id="header">
		<h1><a href="">Sistema de controle de O.S</a></h1>
</div>

<!--topo -menu-->
<div id="user-nav" class="navbar navbar-inverse">
		<ul class="nav">
				<li class=""><a title="" ></i> <span class="text">Bem vindo <!--<?php echo $usuario->nome ?>--> </span></a></li>

				<li class=""><a title="" href="<?php echo site_url();?>/mapos/minhaConta"><i class="icon icon-star"></i> <span class="text">Minha Conta</span></a></li>



				<li class=""><a title="" href="<?php echo site_url();?>/mapos/sair"><i class="icon icon-share-alt"></i> <span class="text">Sair do Sistema</span></a></li>
				
		</ul>

</div>

<!--botão para tela de pesquisa-->
<div id="search">
		<form action="<?php echo base_url()?>index.php/mapos/pesquisar">
			<button type="submit"  class="tip-bottom" title="Pesquisar"><i class="icon-search icon-white"></i>   Pesquisar cliente, produtos e serviços</button>
				
		</form>
</div>


<!--start menu lateral-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
		<ul>
			<li class=""><a href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span>Inicio</span></a></li>	
			<li class=""><a href="<?php echo base_url()?>index.php/clientes"><i class="icon icon-group"></i> <span>Clientes</span></a></li>	
			<li class=""><a href="<?php echo base_url()?>index.php/produtos"><i class="icon icon-barcode"></i> <span>Produtos</span></a></li>	
			<li class=""><a href="<?php echo base_url()?>index.php/servicos"><i class="icon icon-wrench"></i> <span>Serviços</span></a></li> 
			<li class=""><a href="<?php echo base_url()?>index.php/vendas"><i class="icon icon-shopping-cart"></i> <span>Vender</span></a></li>		
			<li class=""><a href="<?php echo base_url()?>index.php/os"><i class="icon icon-tags"></i> <span>Ordens de Serviço</span></a></li>		
			<li class="">
				<a href="<?php echo base_url()?>index.php/usuarios"><i class="icon icon-cog"></i> <span>Usuários</span> <span class="label"></span></a>
			</li>		
		</ul>
</div>

<!-- fim menu lateral -->

<!-- conteudo "meio" da pagina --> 
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url()?>" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <?php if ($this->uri->segment(1) != null) {
?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a> <?php if ($this->uri->segment(2) != null) {
?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));
} ?></a> <?php
}?></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
            <?php if ($this->session->flashdata('error') != null) {?>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $this->session->flashdata('error');?>
                           </div>
                        <?php }?>

                        <?php if ($this->session->flashdata('success') != null) {?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $this->session->flashdata('success');?>
                           </div>
                        <?php }?>
                          
                        <?php if (isset($view)) {
                            echo $this->load->view($view, null, true);
}?>


      </div>
    </div>
  </div>
</div>


<!-- rodape -->
<div class="row-fluid">
		<div id="footer" class="span12">2021 &copy; Desenvolvido por Natanael Almeida </div>
</div>


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 


</body>
</html>







