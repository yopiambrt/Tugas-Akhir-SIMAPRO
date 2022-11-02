<nav>
    <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">
            <ul class="nav-menu custom-scrollbar">
                <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                </li>aa
                <li class="sidebar-main-title">
                    <div>
                        <h6>General</h6>
                    </div>
                </li>
                @if (Auth::user()->is_admin == '1')
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>

                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>User</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('admin.user.index') }}" class="active">All</a></li>
                            <li><a href="{{ route('admin.mhs.index') }}" class="active">Mahasiswa</a></li>
                            <li><a href="{{ route('admin.verifikasi_alumni.index') }}" class="active">Verifikasi Alumni</a></li>

                        </ul>

                        <li class="dropdown">
                                <a class="nav-link menu-title " href="javascript:void(0)"><i
                                        data-feather="database"></i><span>Master</span></a>
                                <ul class="nav-submenu menu-content">
                                        <li><a href="{{ route('admin.master.jenis_usaha.index') }}" class="active">Jenis Usaha</a></li>
                                        <li><a href="{{ route('admin.master.level_usaha.index') }}" class="active">Level Usaha</a></li>
                                        <li><a href="{{ route('admin.master.kriteria_usaha.index') }}" class="active">Kriteria Usaha</a></li>
                                        <li><a href="{{ route('admin.master.kriteria_pekerja_lepas.index') }}" class="active">Kriteria Pekerja Lepas</a></li>
                                        <li><a href="{{ route('admin.master.status_pekerjaan.index') }}" class="active">Status Pekerjaan</a></li>
                                        <li><a href="{{ route('admin.master.kategori_pekerjaan.index') }}" class="active">Kategori Pekerjaan</a></li>
                                        <li><a href="{{ route('admin.master.level_instansi.index') }}" class="active">Level Instansi</a></li>
                                        <li><a href="{{ route('admin.master.jenis_perusahaan.index') }}" class="active">Jenis Perusahaan</a></li>
                                        <li><a href="{{ route('admin.master.universitas_jenjang.index') }}" class="active">Universitas Jenjang</a></li>
                                        <li><a href="{{ route('admin.master.universitas_kategori.index') }}" class="active">Universitas Kategori</a></li>
                                        <li><a href="{{ route('admin.master.universitas_level.index') }}" class="active">Universitas Level</a></li>
                                        <li><a href="{{ route('admin.master.pendidikan.index') }}" class="active">Pendidikan</a></li>
                                </ul>
                        </li>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Akademi</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        {{-- <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a> --}}
                       
                       
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>Kompetisi</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('admin.KompetisiMahasiswa.index') }}" class="active">
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiDaftarLabel.index') }}" class="active">Daftar Label
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiDaftarKategori.index') }}" class="active">Daftar
                                    Kategori Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KegiatanSkala.index') }}" class="active">Skala
                                    Kegiatan</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiKategori.index') }}" class="active">Kategori
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiLabel.index') }}" class="active">Label
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiPanduan.index') }}" class="active">Panduan
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiPoster.index') }}" class="active">Poster
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiPenyelenggara.index') }}" class="active">Kompetisi
                                    Penyelenggara</a>
                            </li>
                            <li><a href="{{ route('admin.KompetisiPenyelenggaraJenis.index') }}"
                                    class="active">Kompetisi
                                    Penyelenggara
                                    Jenis</a></li>

                        </ul>
                        <a class="nav-link menu-title " href="{{ route('admin.prestasi.index') }}"><i
                                data-feather="database"></i><span>Prestasi</span></a>
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>Alumni</span></a>
                        <ul class="nav-submenu menu-content">
                            </li>
                            <li><a href="{{ route('admin.alumni.index') }}" class="active">
                                    Daftar Alumni</a>
                            </li>
                            <li><a href="{{ route('admin.biodata.index') }}" class="active">Biodata</a>
                            </li>
                            <li><a href="{{ route('admin.alumni.bekerja.index') }}" class="active">Bekerja</a>
                            </li>
                            <li><a href="{{ route('admin.alumni.wirausaha.index') }}" class="active">Usaha</a>
                            </li>
                            <li><a href="{{ route('admin.alumni.studi_lanjut.index') }}" class="active">Studi Lanjut</a>
                            </li>
                        </ul>

                    </li>
                @endif

                @if (Auth::user()->is_admin == '2')
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>

                        {{-- <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>User</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('admin.user.index') }}" class="active">All</a></li>
                            <li><a href="{{ route('admin.mhs.index') }}" class="active">Mahasiswa</a></li>

                        </ul> --}}
                    </li>

                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Akademi</h6>
                        </div>
                    </li>
                    <li class="dropdown">

                    </li> --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Alumni</h6>
                        </div>
                    </li>
                    {{-- <li>
                        <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li> --}}
                    <li>
                        <a class="nav-link menu-title " href="{{ route('mawa.biodata') }}"><i
                                data-feather="database"></i><span>Biodata</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title " href="{{ route('mawa.prestasi.index') }}"><i
                                data-feather="database"></i><span>Prestasi</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title " href="{{ route('mawa.index') }}"><i
                                data-feather="database"></i><span>Alumni</span></a>
                    </li>
                @endif
                @if (Auth::user()->is_admin == '3')
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>

                        {{-- <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>User</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('pegawai.user.index') }}" class="active">All</a></li>
                            <li><a href="{{ route('pegawai.mhs.index') }}" class="active">Mahasiswa</a></li>

                        </ul> --}}
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Akademi</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        {{-- <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a> --}}
                        
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>Kompetisi</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('pegawai.KompetisiMahasiswa.index') }}" class="active">
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiDaftarLabel.index') }}" class="active">Daftar
                                    Label
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiDaftarKategori.index') }}"
                                    class="active">Daftar
                                    Kategori Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KegiatanSkala.index') }}" class="active">Skala
                                    Kegiatan</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiKategori.index') }}" class="active">Kategori
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiLabel.index') }}" class="active">Label
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiPanduan.index') }}" class="active">Panduan
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiPoster.index') }}" class="active">Poster
                                    Kompetisi</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiPenyelenggara.index') }}"
                                    class="active">Kompetisi
                                    Penyelenggara</a>
                            </li>
                            <li><a href="{{ route('pegawai.KompetisiPenyelenggaraJenis.index') }}"
                                    class="active">Kompetisi
                                    Penyelenggara
                                    Jenis</a></li>

                        </ul>
                        <a class="nav-link menu-title " href="{{ route('pegawai.prestasi.index') }}"><i
                                data-feather="database"></i><span>Prestasi</span></a>
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="database"></i><span>Alumni</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('pegawai.alumni.index') }}" class="active">Daftar Alumni</a></li>
                            <li><a href="{{ route('pegawai.biodata.index') }}" class="active">Biodata</a>
                            </li>
                            <li><a href="{{ route('pegawai.alumni.bekerja.index') }}" class="active">Bekerja</a>
                            </li>
                            <li><a href="{{ route('pegawai.alumni.wirausaha.index') }}" class="active">Usaha</a>
                            </li>
                            <li><a href="{{ route('pegawai.alumni.studi_lanjut.index') }}" class="active">Studi Lanjut</a>
                            </li>
                        </ul>

                    </li>
                @endif

                @if (Auth::user()->is_admin == '4')
                    <li>
                        <a class="nav-link menu-title " href="{{ route('dashboard') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title " href="{{ route('mhs.biodata') }}"><i
                                data-feather="database"></i><span>Biodata</span></a>
                    </li>
                    <li>
                        <a class="nav-link menu-title " href="{{ route('mhs.prestasi.index') }}"><i
                                data-feather="database"></i><span>Prestasi</span></a>
                    </li>
                @endif

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
</nav>
