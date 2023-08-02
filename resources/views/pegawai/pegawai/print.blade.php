<title>{{ $title }}</title>

<!-- CSS -->
<style media="screen">
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
    <table align="center">
        <td width="50">
            <img src="{{ public_path('assets/admin/images/auth/auth-logo-dark.png') }}" alt="logo" title="logo" width="40px" />
        </td>
        <td align="center">
            <h3>PEMERINTAH KABUPATEN MAMASA</h3>
            <h2>Surat Keputusan Kenaikan Pangkat Pegawai Negeri Sipil</h2>
        </td>
        <td width=""></td>
    </table>
    <hr style="margin: 0;">

    <h3 class="jenis_surat_head">MEMUTUSKAN</h3>

    <p>Pegawai Negeri Sipil</p>
    <table>
        <tr>
            <td>1.</td>
            <td width="210">Nama</td>
            <td>:</td>
            <td>{{ $pegawai->toUsers->nama }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Tempat / Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $pegawai->tmp_lahir }}, {{ tgl_indo($pegawai->tgl_lahir) }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $pegawai->nip }}</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $pegawai->toPendidikan->nama }}</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Pangkat Lama / Golongan Ruang / TMT</td>
            <td>:</td>
            <td>{{ $pangkat_old->nama }} / {{ tgl_indo($pangkat_old->tmt) }}</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $pegawai->toJabatan->nama }}</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Masa Kerja Golongan</td>
            <td>:</td>
            <td>{{ $mkg_old }}</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Gaji Pokok</td>
            <td>:</td>
            <td>{{ rupiah($gapok_old->gaji ?? 0) }}</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>Kecamatan Bambang</td>
        </tr>
    </table>

    <br /><br />

    <p style="text-align: justify;">
        Terhitung mulai tanggal <b>{{ tgl_indo($pangkat_new->tmt) }}</b> diangkat dalam pangkat dan golongan <b>{{ $pangkat_new->nama }}</b> diberikan gaji pokok sebesar <b>{{ rupiah($gapok_new->gaji ?? 0) }}</b> ditambah dengan penghasilan lain berdasarkan ketentuan peraturan perundang-undagan.
        <br>
        Apabila dikemudian hari ternyata terdapat kekeliruan dalam Surat Keputusan ini, akan diadakan perbaikan sebagaimana mestinya.
    </p>

    <br /><br />

    <table>
        <tr>
            <td></td>
            <td width="120"></td>
            <td style="font-size: 10px;">
                <p>Ditetapkan di : Mamasa</p>
                <p>Pada Tanggal : {{ tgl_indo(date('Y-m-d')) }}</p>
                <hr style="margin: 0;">
                <div style="text-align: center;">
                    <p><b>BUPATI MAMASA</b></p>
                    <br /><br />
                    <p><b>H. RAMLAN BADAWI</b></p>
                </div>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 10px;">
                <p><b>Petikan</b> sesuai dengan aslinya</p>
                <p>KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
                <p>KABUPATEN MAMASA</p>
                <br /><br /><br /><br /><br /><br />
                <p><b>IRWAN, S.Sos, M.Si</b></p>
                <p>Pembina Utama Muda</p>
                <p>NIP. 19690612 199003 1 001</p>
            </td>
            <td></td>
            <td></td>
        </tr>
</body>