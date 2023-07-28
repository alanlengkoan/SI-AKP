<title>{{ $title }}</title>

<!-- CSS -->
<style media="screen">
    body {
        background-image: url("{{ public_path('assets/admin/images/bg_surat.png') }}");
        background-repeat: no-repeat;
        background-size: 300px;
        background-position: center;
    }

    .kop_surat {
        padding-top: 4mm;
        padding-right: 4mm;
        padding-left: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    .jenis_surat_head {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .jenis_surat {
        text-decoration: underline;
        text-transform: uppercase;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }

    .page_break {
        page-break-before: always;
    }

    #tabel-pengembalian td {
        vertical-align: top;
    }

    .tabel-anak tr td {
        border: none;
    }
</style>
<!-- CSS -->

<body>
    @for ($i = 1; $i <= 5; $i++) <div class="kop_surat">
        <table align="center">
            <td width="50">
                <img src="{{ public_path('assets/admin/images/auth/auth-logo-dark.png') }}" alt="logo" title="logo" width="40px" />
            </td>
            <td align="center">
                <h3>PEMERINTAH KABUPATEN MAMASA</h3>
                <h2>Surat Keterangan Penghentian Pembayaran (S.K.P.P)</h2>
            </td>
            <td width="">
            </td>
        </table>
        <hr style="margin: 0;">
        </div>
        <p style="text-align: center;">Nomor : {{ $pegawai->no_surat }}</p>

        <div class="jenis_surat_head">
            <h3>Lembar : {{ huruf($i) }}</h3>
        </div>

        <ol type="A">
            <li>
                Bupati Mamasa (Badan Pengelolaan Keuangan Daerah) menerangkan dengan ini bahwa, kepada : <b>{{ $pegawai->toPegawai->nama }} NIP. {{ $pegawai->toPegawai->nip }}</b>
            </li>
            <br />
            <ol type="a">
                <li>
                    Dengan Surat Keputusan {{ $pegawai->toPegawai->toAsalSuratKeputusan->nama }}, Nomor : {{ $pegawai->toPegawai->no_asal_surat_keputusan }} tanggal {{ tgl_indo($pegawai->toPegawai->tgl_asal_surat_keputusan) }}, terhitung mulai tanggal <b>{{ tgl_indo($pegawai->toPegawai->tgl_pensiun) }}</b>
                    @if($pegawai->toPegawai->toJenisSkpp->kode === 'spp')
                    dipindahkan jenis Kepegawaiannya menjadi Pegawai Negeri Sipil Daerah pada <i><b>{{ $pegawai->toPegawai->mutasi }}</b></i>
                    @elseif($pegawai->toPegawai->toJenisSkpp->kode === 'spm')
                    diberikan Pensiun {{ ($pegawai->toPegawai->kelamin === 'l' ? 'Duda' : 'Janda') }} dengan Pensiun Pokok sebesar <i><b>Rp. {{ create_separator($pegawai->toPegawai->gaji) }},-</b> ({{ terbilang($pegawai->toPegawai->gaji) }})</i>
                    @else
                    dinyatakan telah mencapai batas usia Pensiun dan diberikan Pensiun Pokok sebesar <i><b>Rp. {{ create_separator($pegawai->toPegawai->gaji) }},-</b> ({{ terbilang($pegawai->toPegawai->gaji) }})</i>
                    @endif
                </li>
                <br />
                <li>
                    Terakhir memangku jabatan/pangkat : {{ $pegawai->toPegawai->toJabatan->nama }} pada {{ $pegawai->toPegawai->tmp_tugas }} {{ $pegawai->toPegawai->toPangkat->nama }}
                </li>
                <br />
                <li>
                    Terakhir diberikan :
                </li>
                <br />
                <table>
                    @php
                    $tunjangan = 0;
                    $potongan = 0;
                    $no_t = 1;
                    $no_p = 1;
                    @endphp
                    @foreach ($ampra_gaji_tunjangan as $row)
                    @php
                    $tunjangan += $row->nilai;
                    @endphp
                    <tr>
                        <td>{{ $no_t++ }}.</td>
                        <td width="210">{{ $row->toTunjangan->nama }}</td>
                        <td width="10" align="center">:</td>
                        <td width="110" align="right">Rp. {{ create_separator($row->nilai) }},-</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <hr>
                            <div class="jenis_surat_head">
                                <h3>Jumlah Penghasilan Kotor : Rp. {{ create_separator($tunjangan) }},-</h3>
                            </div>
                        </td>
                    </tr>
                </table>
            </ol>
            <p>
                Penghasilan mana kepadanya telah dibayarkan sampai dengan Bulan <b>{{ get_bulan(date('m', strtotime($pegawai->toPegawai->tgl_pelapor))) }} {{ date('Y', strtotime($pegawai->toPegawai->tgl_pelapor)) }}</b>
                <br>
                Dengan potongan sebagai berikut :
            </p>
            <table>
                <tr>
                    <td>
                        <table>
                            @foreach ($ampra_gaji_potongan as $row)
                            @php
                            $potongan += $row->nilai;
                            @endphp
                            <tr>
                                <td>Ke {{ $no_p++ }} Rp.</td>
                                <td width="90" align="right">{{ create_separator($row->nilai) }},-</td>
                                <td width="10">:</td>
                                <td>sebulan untuk {{ $row->toPotongan->nama }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                    <td width="50"></td>
                    <td align="center">
                        <img src="{{ upload_path('picture/'.$pegawai->toPegawai->foto) }}" alt="profil" title="profil" width="120px" />
                    </td>
                </tr>
            </table>
            <br />
            <li>
                <p>
                    bahwa pegawai tersebut tidak beristri, bersuami
                </p>
            </li>
            <br />
            <li>
                <p>
                    @php
                    $total_bersih = ($tunjangan - $potongan);
                    @endphp
                    bahwa untuk pegawai tersebut telah dibayarkan dengan SP2D kami tanggal: {{ tgl_indo($pegawai->toPegawai->tgl_sp2d) }}, Nomor: {{ $pegawai->toPegawai->no_sp2d }} sejumlah <i><b>Rp. {{ create_separator($total_bersih) }},-</b></i> Bulan persekot pindah.
                </p>
            </li>
            <div class="page_break"></div>
            <li>
                <p>
                    Bahwa dari gajinya / pensiunnya harus dipotong lagi karena
                </p>
            </li>
            <div class="jenis_surat_head">
                <h3>HUTANG KEPADA NEGARA / PEMERINTAH KABUPATEN MAMASA</h3>
            </div>
            <table id="tabel-pengembalian" border="1" cellspacing="0" cellpadding="0" style="font-size: 12px; width: 100%;">
                <tr>
                    <th align="center" height="20">Jumlah dan Jenis Hutang</th>
                    <th align="center" height="20">Jumlah Potongan</th>
                    <th align="center" height="20">Catatan</th>
                </tr>
                <tr style="font-size: 12px;">
                    @php
                    $kt_tunjangan = 0;
                    $kt_potongan = 0;
                    $kt_pengembalian = 0;
                    @endphp

                    <!-- begin:: tunjangan -->
                    @if (count($kartu_gaji_tunjangan) > 0 || count($pengembalian) > 0)
                    <td width="170">
                        <!-- begin:: gaji pokok -->
                        @if (count($kartu_gaji_tunjangan) > 0)
                        <p style="margin: 5px; text-align: justify;">
                            Rp, {{ create_separator($total_tunjangan) }} <i>({{ terbilang($total_tunjangan) }})</i> yaitu Gaji Induk ub {{ $pengembalian_kartu_gaji }}, {{ implode(', ', $jenis_gaji) }} yang terlanjut dibayarkan kepadanya dengan rincian jumlah sebagai berikut :
                        </p>
                        <table class="tabel-anak">
                            @foreach ($kartu_gaji_tunjangan as $row)
                            @php
                            $kt_tunjangan += $row->nilai;
                            @endphp
                            <tr>
                                <td>-</td>
                                <td>{{ $row->tunjangan }}</td>
                                <td align="center">Rp.</td>
                                <td align="right">{{ create_separator($row->nilai) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Gaji Kotor</b></td>
                                <td align="center">Rp.</td>
                                <td align="right"><b>{{ create_separator($kt_tunjangan) }}</b></td>
                            </tr>
                        </table>
                        @endif
                        <!-- end:: gaji pokok -->

                        <!-- begin:: pengembalian -->
                        @if (count($pengembalian) > 0)
                        @foreach ($pengembalian as $val)
                        @php
                        $kt_pengembalian += $val->total;
                        @endphp
                        <table class="tabel-anak">
                            <tr>
                                <td>-</td>
                                <td>
                                    {{ $val->nama}} {!! implode(' dan ', $pengembalian_anggota) !!} yang terlanjur diterima Ub. {{ get_bulan($val->bulan_min) }} {{ $val->tahun_min }} s.d. {{ get_bulan($val->bulan_max) }} {{ $val->tahun_max }} sejumlah Rp. {{ create_separator($val->total) }},- <i>{{ terbilang($val->total) }}</i>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                        @endif
                        <!-- end:: pengembalian -->
                    </td>
                    @else
                    <td width="170">
                        <p style="margin: 5px; text-align: center;">
                            -
                        </p>
                    </td>
                    @endif
                    <!-- end:: tunjangan -->

                    <!-- begin:: potongan -->
                    @if (count($kartu_gaji_potongan) > 0)
                    <td width="170">
                        <p style="margin: 5px; text-align: justify;">
                            Potongan :
                        </p>
                        <table class="tabel-anak">
                            @foreach ($kartu_gaji_potongan as $row)
                            @php
                            $kt_potongan += $row->nilai;
                            @endphp
                            <tr>
                                <td>-</td>
                                <td>{{ $row->potongan }}</td>
                                <td align="center">Rp.</td>
                                <td align="right">{{ create_separator($row->nilai) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Jumlah Pot.</b></td>
                                <td align="center">Rp.</td>
                                <td align="right"><b>{{ create_separator($kt_potongan) }}</b></td>
                            </tr>
                        </table>
                    </td>
                    @else
                    <td width="170">
                        <p style="margin: 5px; text-align: center;">
                            -
                        </p>
                    </td>
                    @endif
                    <!-- end:: potongan -->

                    <!-- begin:: catatan -->
                    @php
                    $total_sps = ($kt_tunjangan - $kt_potongan) + $kt_pengembalian;
                    $total_spm = (count_mounth($pegawai->toPegawai->tgl_pensiun, $pegawai->toPegawai->tgl_pelapor) * $total_bersih);
                    @endphp

                    @if (count($kartu_gaji_tunjangan) > 0 || count($pengembalian) > 0)

                    <td width="170">
                        <!-- begin:: mutasi pindah -->
                        @if($pegawai->toPegawai->toJenisSkpp->kode === 'spp')
                        @if (count($pengembalian) > 0)
                        <p style="margin: 5px; text-align: justify;">
                            @if (count($kartu_gaji_tunjangan) > 0)
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar Gaji Bersih ub {{ $pengembalian_kartu_gaji }} {{ implode(', ', $jenis_gaji) }}
                            @else
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar
                            @endif
                            {!! implode(' dan ', $pengembalian_tunjangan) !!} an. {!! implode(' dan ', $pengembalian_anggota) !!} yang terlanjur diterima Ub.
                            {{ get_bulan($val->bulan_min) }} {{ $val->tahun_min }} s.d. {{ get_bulan($val->bulan_max) }} {{ $val->tahun_max }}
                            sejumlah Rp, {{ create_separator($total_sps) }} <i>({{ terbilang($total_sps) }})</i> tersebut disetor ke Rek. KAS DAERAH Kab. MAMASA pada Bank Sulselbar Cab. Mamasa <i>Nomor Rek. 074-001-000000001-0</i>
                        </p>
                        @else
                        -
                        @endif
                        @endif
                        <!-- end:: mutasi pindah -->

                        <!-- begin:: pensiun sendiri -->
                        @if($pegawai->toPegawai->toJenisSkpp->kode === 'sps')
                        @if (count($pengembalian) > 0)
                        <p style="margin: 5px; text-align: justify;">
                            @if (count($kartu_gaji_tunjangan) > 0)
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar Gaji Bersih ub {{ $pengembalian_kartu_gaji }} {{ implode(', ', $jenis_gaji) }}
                            @else
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar
                            @endif
                            {!! implode(' dan ', $pengembalian_tunjangan) !!} an. {!! implode(' dan ', $pengembalian_anggota) !!} yang terlanjur diterima Ub.
                            {{ get_bulan($val->bulan_min) }} {{ $val->tahun_min }} s.d. {{ get_bulan($val->bulan_max) }} {{ $val->tahun_max }}
                            sejumlah Rp, {{ create_separator($total_sps) }} <i>({{ terbilang($total_sps) }})</i> tersebut disetor ke Rek. KAS DAERAH Kab. MAMASA pada Bank Sulselbar Cab. Mamasa <i>Nomor Rek. 074-001-000000001-0</i>
                        </p>
                        @else
                        <p style="margin: 5px; text-align: justify;">
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar Gaji Bersih ub {{ $pengembalian_kartu_gaji }} {{ implode(', ', $jenis_gaji) }}, sejumlah Rp, {{ create_separator($total_sps) }} <i>({{ terbilang($total_sps) }})</i> tersebut disetor ke Rek. KAS DAERAH Kab. MAMASA pada Bank Sulselbar Cab. Mamasa <i>Nomor Rek. 074-001-000000001-0</i>
                        </p>
                        @endif
                        @endif
                        <!-- end:: pensiun sendiri -->

                        <!-- begin:: pensiun ditinggal -->
                        @if($pegawai->toPegawai->toJenisSkpp->kode === 'spm')
                        <p style="margin: 5px; text-align: justify;">
                            @if (count($kartu_gaji_tunjangan) > 0)
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar Gaji Bersih ub {{ $pengembalian_kartu_gaji }} {{ implode(', ', $jenis_gaji) }}, sejumlah Rp, {{ create_separator($total_sps) }} <i>({{ terbilang($total_sps) }})</i> tersebut disetor ke Rek. KAS DAERAH Kab. MAMASA pada Bank Sulselbar Cab. Mamasa <i>Nomor Rek. 074-001-000000001-0</i>
                            @else
                            @if (count($pengembalian) > 0)
                            - Dimohon kepada PT. Taspen (Persero) Cab. Mamuju, agar {!! implode(' dan ', $pengembalian_tunjangan) !!} an. {!! implode(' dan ', $pengembalian_anggota) !!} yang terlanjur diterima Ub.
                            {{ get_bulan($val->bulan_min) }} {{ $val->tahun_min }} s.d. {{ get_bulan($val->bulan_max) }} {{ $val->tahun_max }}
                            sejumlah Rp, {{ create_separator($total_sps) }} <i>({{ terbilang($total_sps) }})</i> tersebut disetor ke Rek. KAS DAERAH Kab. MAMASA pada Bank Sulselbar Cab. Mamasa <i>Nomor Rek. 074-001-000000001-0</i>
                            @endif
                            @endif
                        </p>

                        <p style="margin: 5px; text-align: justify;">
                            - Gaji terusan telah diterima ub {{ $pengembalian_kartu_gaji }} sejumlah Rp. {{ create_separator($total_spm) }},- <i>({{ terbilang($total_spm) }})</i>
                        </p>
                        @endif
                        <!-- end:: pensiun ditinggal -->
                    </td>

                    @else

                    @if($pegawai->toPegawai->toJenisSkpp->kode === 'spm')
                    <p style="margin: 5px; text-align: justify;">
                        - Gaji terusan telah diterima ub {{ get_bulan(date('m', strtotime($pegawai->toPegawai->tgl_pensiun))) }} {{ date('Y', strtotime($pegawai->toPegawai->tgl_pensiun)) }} s.d {{ get_bulan(date('m', strtotime($pegawai->toPegawai->tgl_pelapor))) }} {{ date('Y', strtotime($pegawai->toPegawai->tgl_pelapor)) }} sejumlah Rp. {{ create_separator($total_spm) }},- <i>({{ terbilang($total_spm) }})</i>
                    </p>
                    @else
                    <td width="170">
                        <p style="margin: 5px; text-align: center;">
                            -
                        </p>
                    </td>
                    @endif

                    @endif
                    <!-- end:: catatan -->
                </tr>
            </table>
            <br />
            <li>
                <p>
                    ANGGOTA-ANGGOTA KELUARGA TIDAK MEMPUNYAI PENGHASILAN SENDIRI DAN MENJADI TANGGUNGAN PEGAWAI TERSEBUT DI SEBELAH INI
                </p>
            </li>
            <table id="tabel-pengembalian" border="1" cellspacing="0" cellpadding="0" style="font-size: 12px; width: 100%;">
                <tr>
                    <th align="center" height="20">No.</th>
                    <th align="center" height="20">Nama</th>
                    <th align="center" height="20">Tanggal Lahir / Umur</th>
                    <th align="center" height="20">Hubungan Keluarga</th>
                    <th align="center" height="20">Catatan</th>
                </tr>
                @php
                $no = 1;
                @endphp
                @foreach ($pegawai_anggota as $row)
                <tr align="center">
                    <td>{{ $no++ }}.</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ tgl_indo($row->tgl_lahir) }} / {{ count_age($row->tgl_lahir) }}</td>
                    <td>{{ $row->toJenisAnggota->nama }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
                @endforeach
            </table>
            <br />
            <li>
                <p>
                    CATATAN LAIN-LAIN
                </p>
            </li>
        </ol>
        <table id="tabel-pengembalian" style="width: 100%;">
            <tr>
                <td width="340">LAMPIRAN :</td>
                <td>
                    Mamasa, {{ tgl_indo($pegawai->tgl_surat) }}
                    <br /><br />
                    <b>
                        An. Bupati Mamasa
                        @if ($ttd->status == 'opsional')
                        <br />
                        Kepala BPKD,
                        @endif
                        <br />
                        {{ $ttd->toJabatan->nama }}
                    </b>
                    <br /><br /><br /><br />
                    <b style="text-decoration: underline; font-size: 14px;">{{ $ttd->nama }}</b>
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="40">Pangkat</td>
                            <td width="5">:</td>
                            <td>{{ $ttd->toPangkat->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $ttd->nip }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="100">Lembar Satu</td>
                <td>:</td>
                <td>Satu dan Kedua dilampirkan pada</td>
            </tr>
            <tr>
                <td>Lembar Kedua</td>
                <td>:</td>
                <td>Permintaan pembayaran gaji pertama</td>
            </tr>
            <tr>
                <td>Lembar Ketiga</td>
                <td>:</td>
                <td>Yang bersangkutan</td>
            </tr>
            <tr>
                <td>Lembar Keempat</td>
                <td>:</td>
                <td>Bendahara Gaji</td>
            </tr>
            <tr>
                <td>Lembar Kelima</td>
                <td>:</td>
                <td>Pertinggal</td>
            </tr>
        </table>
        @if($i !== 5)
        <div class="page_break"></div>
        @endif
        @endfor
</body>