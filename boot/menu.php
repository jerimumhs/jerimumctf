<div id="sidebar-menu">
     <?php if($userlogin['admin'] == 1):
      ?>
    <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-attention'></i>
                <span>Eventos e Chall</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='eventocad.php'>
                        <span>Cadastrar Eventos</span></a>
                </li>
                <li><a href='categoriacad.php'>
                        <span>Categorias</span></a>
                </li>
                <li><a href='challcad.php'>
                        <span>Chall</span></a>
                </li>
            </ul>
    </ul>
    <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-attention'></i>
                <span>Usuário e Logs</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='#'>
                        <span>Listar Usuários</span></a>
                </li>
                <li><a href='#'>
                        <span>Log de Acesso</span></a>
                </li>
            </ul>
    </ul>
    <?php
    endif;
     
    ?>
    
    <div class="clearfix"></div>
</div>