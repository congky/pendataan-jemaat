<section class="sidebar" style="font-size: 15px">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ URL::asset('admin-lte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ \Session::get("HAS_SESSION")["nama_lengkap"] }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li><a href="/home"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>

        @if(authorized("JEMAAT"))
        <li><a href="/lihat-data-diri"><i class="fa fa-circle-o text-red"></i> <span>Lihat Data Diri</span></a></li>
        @endif

        @if(authorized("JEMAAT"))
        <li><a href="/usul-baptis/{{ Session::get("HAS_SESSION")["no_anggota"] }}"><i class="fa fa-circle-o text-red"></i> <span>Usulan Baptisan</span></a></li>
        @endif

        @if(authorized("ADMIN,PENDETA"))
        <li><a href="/data-jemaat"><i class="fa fa-circle-o text-red"></i> <span>Data Jemaat</span></a></li>
        @endif

        @if(authorized("ADMIN"))
        <li><a href="/data-baptisan"><i class="fa fa-circle-o text-yellow"></i> <span>Data Baptisan</span></a></li>
        @endif

        @if(authorized("ADMIN,PENDETA"))
        <li><a href="/data-usulan-baptisan"><i class="fa fa-circle-o text-red"></i> <span>Data Usulan Baptisan</span></a></li>
        @endif

        @if(authorized("ADMIN"))
            <li><a href="/lihat-data-pernikahan"><i class="fa fa-circle-o text-aqua"></i> <span>Data Pernikahan</span></a></li>
        @endif

        @if(authorized("JEMAAT"))
            <li><a href="/usul-menikah-jemaat/{{ \Session::get("HAS_SESSION")["no_anggota"] }}"><i class="fa fa-circle-o text-red"></i> Usul Menikah</a></li>
        @endif

        @if(authorized("ADMIN,PENDETA"))
        <li><a href="/lihat-data-usulan-pernikahan"><i class="fa fa-circle-o text-yellow"></i> <span>Data Usulan Pernikahan</span></a></li>
        @endif

        {{--@if(authorized("JEMAAT"))--}}
        {{--<li><a href="/cari-pasangan"><i class="fa fa-circle-o text-yellow"></i> <span>Cari Pasangan</span></a></li>--}}
        {{--@endif--}}

        @if(authorized("ADMIN"))
        <li><a href="/data-kematian"><i class="fa fa-circle-o text-aqua"></i> <span>Data Kematian</span></a></li>
        @endif

    </ul>
</section>
