<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="./images/logo.jpg" alt="LOGO"" style="width: 210px;">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bar-chart-o"></i>
            </a>
        </li>   
                                 
        <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= isset($_SESSION['avatar']) && $_SESSION['avatar']?$_SESSION['avatar'] : './images/avatars/anonymous.png' ?>" alt="Avatar" class="avatar" title="<?= isset($_SESSION['account']) && $_SESSION['account']?$_SESSION['account'] : 'Anonymous' ?>"></a>            
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                <li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="?view=logout"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="?view=home"><i class="fa fa-fw fa-dashboard"></i> DASHBOARD</a>
            </li>
            
            <li>
                <a data-toggle="collapse" data-target="#subadmin"><i class="fa fa-fw fa-group"></i> ADMINISTRATORS <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="subadmin" class="collapse">
                    <li><a href="?view=admin"><i class="fa fa-angle-double-right"></i> Admin </a></li>
                    <li><a href="?view=admin_group"><i class="fa fa-angle-double-right"></i> Admin Group </a></li>
                    <li><a href="?view=permission"><i class="fa fa-angle-double-right"></i> Permission </a></li>                  
                </ul>
            </li>            
            <li>
                <a href="#" data-toggle="collapse" data-target="#subproduct"><i class="fa fa-television"></i> PRODUCTS <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="subproduct" class="collapse">
                    <li><a href="?view=products"><i class="fa fa-angle-double-right"></i> Product </a></li>
                    <li><a href="?view=product_add"><i class="fa fa-angle-double-right"></i> Add Product </a></li>
                    <li><a href="?view=product_catalog"><i class="fa fa-angle-double-right"></i> Catalog </a></li>
                    <li><a href="?view=product_supplier"><i class="fa fa-angle-double-right"></i> Supplier </a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#subarticle"><i class="fa fa-newspaper-o "></i>  ARTICLES <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="subarticle" class="collapse">
                    <li><a href="?view=article"><i class="fa fa-angle-double-right"></i> Article </a></li>
                    <li><a href="?view=article_group"><i class="fa fa-angle-double-right"></i> Article Group </a></li>
                </ul>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#subcart"><i class="fa fa-fw fa-cart-plus"></i> CART <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="subcart" class="collapse">
                    <li><a href="?view=orders"><i class="fa fa-angle-double-right"></i> Orders </a></li>
                    <li><a href="?view=create_order"><i class="fa fa-angle-double-right"></i> Create Order </a></li>
                </ul>
            </li>
            <li>
                <a href="?view=home"><i class="fa fa-fw fa-server"></i> MENU </a>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#subinbox"><i class="fa fa-fw fa-inbox"></i> EMAIL <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="subinbox" class="collapse">
                    <li><a href="?view=inbox"><i class="fa fa-angle-double-right"></i> Inbox </a></li>
                    <li><a href="?view=email"><i class="fa fa-angle-double-right"></i> Send Email </a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#submedia"><i class="fa fa-fw fa-youtube-play"></i> MEDIA <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="submedia" class="collapse">
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Slider </a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Banner </a></li>
                </ul> 
            </li>
            <li>
                <a href="?view=configure"><i class="fa fa-fw fa fa-cogs"></i> CONFIGURE </a>
            </li>
            <li>
                <a href="?view=home"><i class="fa fa-fw fa-history"></i> HISTORY </a>
            </li>
            
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
