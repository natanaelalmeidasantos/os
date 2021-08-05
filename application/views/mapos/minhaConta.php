<div class="span6" style="margin-left: 0">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-th-list"></i>
		</span>
                <h5>Minha Conta</h5>
            </div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12" style="min-height: 260px">
                        <ul class="site-stats">
                            <li class="bg_ls span12"><strong>Nome: <?php echo $usuario->nome?></strong></li>
                            <li class="bg_lb span12" style="margin-left: 0"><strong>Telefone: <?php echo $usuario->telefone?></strong></li>
                            <li class="bg_lg span12" style="margin-left: 0"><strong>Email: <?php echo $usuario->email?></strong></li>
                            <li class="bg_lo span12" style="margin-left: 0"><strong>Nível: <?php echo $usuario->permissao; ?></strong></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>




<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
