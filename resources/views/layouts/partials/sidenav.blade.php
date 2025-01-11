<div id="layoutSidenav_nav">
   <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
         <div class="nav">
            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link {{ Route::is(['home']) ? 'active' : '' }}" href="{{ route('home') }}">
               <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
               Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Components</div>

            <!-- Master Data -->
            <a class="nav-link collapsed {{ Route::is(['category.barang*', 'lokasi*']) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterData" aria-expanded="false" aria-controls="collapseMasterData">
               <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                  Master Data
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseMasterData" aria-labelledby="headingMasterData" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link {{ Route::is(['category.barang*']) ? 'active' : '' }}" href="{{ route('category.barang') }}">Kategori Barang</a>
                  <a class="nav-link {{ Route::is(['lokasi*']) ? 'active' : '' }}" href="{{ route('lokasi') }}">Lokasi Asset</a>
               </nav>
            </div>

            <!-- Data Asset -->
            <a class="nav-link collapsed {{ Route::is(['asset.berwujud*','asset.dihapuskan*']) ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataAsset" aria-expanded="false" aria-controls="collapseDataAsset">
               <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                  Data Asset
               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseDataAsset" aria-labelledby="headingDataAsset" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link {{ Route::is(['asset.berwujud*']) ? 'active' : '' }}" href="{{ route('asset.berwujud') }}">Berwujud</a>
                  <a class="nav-link {{ Route::is(['asset.dihapuskan*']) ? 'active' : '' }}" href="{{ route('asset.dihapuskan') }}">Dihapuskan</a>
               </nav>
            </div>

            <a class="nav-link {{ Route::is(['penyusutan']) ? 'active' : '' }}" href="{{ route('penyusutan') }}">
               <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
               Penyusutan
            </a>

            <a class="nav-link {{ Route::is(['laporan*']) ? 'active' : '' }}" href="{{ route('laporan') }}">
               <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
               Laporan
            </a>
         </div>
      </div>
   </nav>
</div>
