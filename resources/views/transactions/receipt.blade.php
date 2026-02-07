<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman #{{ $transaction->id }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #000;
            line-height: 1.4;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        /* HEADER */
        .header {
            display: flex;
            /* Header biasanya aman flex, tapi kalau gagal bisa jadi table juga */
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }

        .header-left h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .header-left p {
            margin: 2px 0 0;
            font-size: 11px;
        }

        .header-right {
            text-align: right;
        }

        .receipt-title {
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #000;
            padding: 5px 15px;
            display: inline-block;
            margin-bottom: 5px;
        }

        /* INFO UTAMA */
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border: none;
        }

        .info-table td {
            padding: 4px 0;
            vertical-align: top;
            border: none;
        }

        .label {
            font-weight: bold;
            width: 130px;
        }

        /* TABEL DATA BUKU */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            /* Garis TEGAS */
            padding: 10px;
            text-align: left;
        }

        .data-table th {
            background-color: #f0f0f0;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
        }

        /* STATUS */
        .status-text {
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #000;
            padding: 2px 6px;
            font-size: 10px;
        }

        /* TANDA TANGAN (FIXED: MENGGUNAKAN TABLE) */
        .signature-table {
            width: 100%;
            margin-top: 50px;
            border: none;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            border: none !important;
            /* Pastikan tidak ada border kotak */
        }

        .sig-line {
            width: 60%;
            border-bottom: 1px solid #000;
            margin: 60px auto 5px auto;
            /* Margin atas 60px untuk ruang tanda tangan */
        }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            border-top: 1px dotted #000;
            padding-top: 10px;
            font-style: italic;
        }

        .text-center {
            text-align: center !important;
        }

        .font-mono {
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">

        <table style="width: 100%; border-bottom: 2px solid #000; margin-bottom: 20px; padding-bottom: 20px;">
            <tr>
                <td style="vertical-align: top; border: none;">
                    <h1 style="margin: 0; font-size: 24px; font-weight: 800;">E-LIBRARY PERPUS</h1>
                    <p style="margin: 5px 0 0; font-size: 11px;">Jalan Pendidikan No. 123, Kota Pelajar</p>
                    <p style="margin: 2px 0 0; font-size: 11px;">Telp: (021) 123-4567</p>
                </td>
                <td style="text-align: right; vertical-align: top; border: none;">
                    <div class="receipt-title">BUKTI PEMINJAMAN</div>
                    <div class="font-mono" style="margin-top: 5px;">
                        #TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</div>
                    <div style="margin-top: 5px; font-size: 11px;">{{ now()->format('d/m/Y H:i') }}</div>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td width="55%" style="padding-right: 20px;">
                    <div style="border: 1px solid #000; padding: 15px;">
                        <div
                            style="font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
                            DATA PEMINJAM</div>
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td class="label">Nama</td>
                                <td>: {{ $transaction->user->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="label">ID Member</td>
                                <td>: {{ $transaction->user->username }}</td>
                            </tr>
                            <tr>
                                <td class="label">Email</td>
                                <td>: {{ $transaction->user->email }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td width="45%">
                    <div style="border: 1px solid #000; padding: 15px;">
                        <div
                            style="font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
                            DETAIL WAKTU</div>
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td class="label">Tgl Pinjam</td>
                                <td>:
                                    {{ \Carbon\Carbon::parse($transaction->tanggal_peminjaman)->translatedFormat('d M Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Tgl Kembali</td>
                                <td>:
                                    <strong>{{ \Carbon\Carbon::parse($transaction->tanggal_pengembalian)->translatedFormat('d M Y') }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Status</td>
                                <td>: <span class="status-text">{{ $transaction->status }}</span></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 10px; font-weight: bold; text-transform: uppercase; margin-top: 20px;">ITEM YANG
            DIPINJAM</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="45%">Judul Buku</th>
                    <th width="25%">Penulis</th>
                    <th width="15%" class="text-center">Tahun</th>
                    <th width="10%" class="text-center">Qty</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <strong>{{ $transaction->book->judul }}</strong>
                        <br><small style="color: #444;">Penerbit: {{ $transaction->book->penerbit }}</small>
                    </td>
                    <td>{{ $transaction->book->penulis }}</td>
                    <td class="text-center">{{ $transaction->book->tahun_terbit }}</td>
                    <td class="text-center">1</td>
                </tr>
            </tbody>
        </table>

        <div style="border: 1px solid #000; padding: 10px; font-size: 11px; margin-top: 20px; background: #fafafa;">
            <strong>CATATAN PENTING:</strong>
            <ul style="margin: 5px 0 0 20px; padding: 0;">
                <li>Batas pengembalian buku adalah tanggal
                    <strong>{{ \Carbon\Carbon::parse($transaction->tanggal_pengembalian)->translatedFormat('d F Y') }}</strong>.
                </li>
                <li>Keterlambatan akan dikenakan denda sesuai peraturan perpustakaan yang berlaku.</li>
            </ul>
        </div>

        <table class="signature-table">
            <tr>
                <td>
                    <div style="margin-bottom: 10px;">Mengetahui,</div>
                    <div class="sig-line"><strong>{{ $transaction->user->nama_lengkap }}</strong></div>
                    <div style="font-size: 11px;">Peminjam</div>
                </td>
                <td>
                    <div style="margin-bottom: 10px;">Disetujui Oleh,</div>
                    <div class="sig-line"><strong>Administrator / Petugas</strong></div>
                    <div style="font-size: 11px;">Stempel Perpustakaan</div>
                </td>
            </tr>
        </table>

        <div class="footer">
            Dicetak otomatis oleh Sistem Informasi E-Library pada {{ $tanggal_dicetak }}
        </div>

    </div>
</body>

</html>