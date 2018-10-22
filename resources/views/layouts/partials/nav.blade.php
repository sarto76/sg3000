<!-- Navigation -->
<nav class="navbar navbar-default ">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">{{__('navigation.title')}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">{{__('navigation.home')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#portfolio">{{__('navigation.teo')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">{{__('navigation.socc')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#team">{{__('navigation.sens')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">{{__('navigation.moto')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ url('/member') }}">{{__('navigation.all')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">{{__('navigation.stat')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">{{__('navigation.ann')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">{{__('navigation.setup')}}</a>
                </li>
                <li>
                    <a class="page-scroll" href="/contact">{{__('navigation.logout')}}</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>