<div id="sidebar-menu">
    <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-flag'></i>
                <span>Contest</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='eventos.php' class='active'>
                        <span>Todos Eventos</span></a>
                </li>
            </ul>
    </ul>
    <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-user'></i>
                <span>Profile</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='#'>
                        <span>Estatísticas</span></a>
                </li>
                <li><a href='#'>
                        <span>Editar Perfil</span></a>
                </li>
            </ul>
    </ul>
      <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-address-book'></i>
                <span>Team</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='team.php'>
                        <span>Criar um Team</span></a>
                </li>
                   <li><a href='enterteam.php'>
                        <span>Ingressar em um Team</span></a>
                </li>
            </ul>
    </ul>
    <?php if($userlogin['admin'] == 1):
      ?>
    <ul>
        <li class='has_sub'><a href='javascript:void(0);'><i class='icon-attention'></i>
                <span>Eventos e Chall</span>
                <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
            <ul>
                <li><a href='boot/cadevento.php'>
                        <span>Eventos</span></a>
                </li>
                <li><a href='boot/cadcategoria.php'>
                        <span>Categorias</span></a>
                </li>
                <li><a href='boot/cadchall.php'>
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