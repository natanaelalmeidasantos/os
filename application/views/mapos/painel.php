<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dist/plugins/jqplot.donutRenderer.min.js"></script>

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
            <li class="bg_lb"> <a href="<?php echo base_url()?>index.php/clientes"> <i class="icon-group"></i> Clientes</a> </li>
        <?php } ?>
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) { ?>
            <li class="bg_lg"> <a href="<?php echo base_url()?>index.php/produtos"> <i class="icon-barcode"></i> Produtos</a> </li>
        <?php } ?>
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vServico')) { ?>
            <li class="bg_ly"> <a href="<?php echo base_url()?>index.php/servicos"> <i class="icon-wrench"></i> Serviços</a> </li>
        <?php } ?>
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) { ?>
            <li class="bg_lo"> <a href="<?php echo base_url()?>index.php/os"> <i class="icon-tags"></i> OS</a> </li>
        <?php } ?>
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) { ?>
            <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/vendas"><i class="icon-shopping-cart"></i> Vendas</a></li>
        <?php } ?>


      </ul>
    </div>
  </div>  
<!--End-Action boxes-->  



<div class="row-fluid" style="margin-top: 0">
    
    <div class="span12">
        


    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Ordens de Serviço Em Aberto</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Cliente</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($ordens != null) {
                            foreach ($ordens as $o) {
                                echo '<tr>';
                                echo '<td>'.$o->idOs.'</td>';
                                echo '<td>'.date('d/m/Y', strtotime($o->dataInicial)).'</td>';
                                echo '<td>'.date('d/m/Y', strtotime($o->dataFinal)).'</td>';
                                echo '<td>'.$o->nomeCliente.'</td>';
                                echo '<td>';
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                                    echo '<a href="'.base_url().'index.php/os/visualizar/'.$o->idOs.'" class="btn"> <i class="icon-eye-open" ></i> </a> ';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">Nenhuma OS em aberto.</td></tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if ($os != null) { ?>
<div class="row-fluid" style="margin-top: 0">

    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas de OS</h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                      <div id="chart-os" style=""></div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>






<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>


<?php if ($os != null) {?>
<script type="text/javascript">
    
    $(document).ready(function(){
      var data = [
        <?php foreach ($os as $o) {
            echo "['".$o->status."', ".$o->total."],";
} ?>
       
      ];
      var plot1 = jQuery.jqplot ('chart-os', [data], 
        { 
          seriesDefaults: {
            // pedaço do grafico pizza
            renderer: jQuery.jqplot.PieRenderer, 
            rendererOptions: {
            
              // 
              showDataLabels: true
            }
          }, 
          legend: { show:true, location: 'e' }
        }
      );

    });
 
</script>

<?php } ?>




 
</script>


<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas do Sistema</h5></div>
            <div class="widget-content">
                <div class="row-fluid">           
                    <div class="span12">
                        <ul class="site-stats">
                            <li class="bg_lh"><i class="icon-group"></i> <strong><?php echo $this->db->count_all('clientes');?></strong> <small>Clientes</small></li>
                            <li class="bg_lh"><i class="icon-barcode"></i> <strong><?php echo $this->db->count_all('produtos');?></strong> <small>Produtos </small></li>
                            <li class="bg_lh"><i class="icon-tags"></i> <strong><?php echo $this->db->count_all('os');?></strong> <small>Ordens de Serviço</small></li>
                            <li class="bg_lh"><i class="icon-wrench"></i> <strong><?php echo $this->db->count_all('servicos');?></strong> <small>Serviços</small></li>
                            
                        </ul>
                 
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>


</div>




