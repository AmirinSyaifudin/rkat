<?php
include "../+koneksi.php";
ob_start();

$content = null;
$content .=
'<style type="text/css">
table.page_header {width:100%; background-color:#DDDDFF; border-bottom:solid 2px #AAAADD; padding:2mm}
table.page_footer {width:100%; background-color:#DDDDFF; border-top:solid 2px #AAAADD; padding:2mm}
.tabel th {padding:8px 5px}
.tabel td {padding:3px}
</style>
<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="1mm">
	<page_header>
		<table class="page_header">
			<tr>
				<td style="width:100%;">
					Unique Photo Studio
				</td>
			</tr>
		</table>
	</page_header>
	<page_footer>
		<table class="page_footer">
			<tr>
				<td style="width:100%; text-align:right">
					Hal. [[page_cu]]/[[page_nb]]
				</td>
			</tr>
		</table>
	</page_footer>
	<div style="padding:4mm; border:1px solid;" align="center">
		<span style="font-size:25px;">Unique Photo Studio</span><br>
		<span style="font-size:13px;">Alamat Studio : Jl. Pemuda No. 1 Samarinda</span>
	</div>';

$tgl_awal = @mysqli_real_escape_string($conn, $_POST['tgl_awal']);
$bln_awal = @mysqli_real_escape_string($conn, $_POST['bln_awal']);
$thn_awal = @mysqli_real_escape_string($conn, $_POST['thn_awal']);
$date_awal = $thn_awal."-".$bln_awal."-".$tgl_awal;
$tgl_akhir = @mysqli_real_escape_string($conn, $_POST['tgl_akhir']);
$bln_akhir = @mysqli_real_escape_string($conn, $_POST['bln_akhir']);
$thn_akhir = @mysqli_real_escape_string($conn, $_POST['thn_akhir']);
$date_akhir = $thn_akhir."-".$bln_akhir."-".$tgl_akhir;
if(@$_GET['page'] == 'pemesanan') {
	$content .= "<div style='padding:20px 0 10px 0; font-size:15px;'>Laporan Pemesanan (Booking Paket)</div>";
	$via = @mysqli_real_escape_string($conn, $_POST['via']);
	$status = @mysqli_real_escape_string($conn, $_POST['status']);
	if($via == '') {
		$via_ = '%';
	} else {
		$via_ = $via;
	}
	if($status == '') {
		$status_ = '%';
	} else {
		$status_ = $status;
	}
	// $content .= "<br>".$date_awal."+".$date_akhir."+".$via."+".$status;
	$content .=
	'<div>
		<table class="tabel" border="1px" style="border-collapse:collapse;">
			<tr style="background-color:#ddd;">
				<th>No. Pesan</th>
				<th>Pelanggan</th>
				<th>Tanggal Pesan</th>
				<th>Pesan Via</th>
				<th>Total Pembayaran</th>
				<th>Uang Muka</th>
				<th>Sisa Bayar</th>
				<th>Status</th>
			</tr>';
	$nopesan = @mysqli_real_escape_string($conn, $_POST['nopesan']);
	if(empty($nopesan)) {
		$sql_pemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_plg = tb_pelanggan.id_plg WHERE (tgl_pesan between '$date_awal' AND '$date_akhir') AND pesan_via LIKE '$via_' AND status LIKE '$status_' ORDER BY tb_pemesanan.no_pesan ASC") or die ($conn->error);
	} else {
		$sql_pemesanan = mysqli_query($conn, "SELECT * FROM tb_pemesanan JOIN tb_pelanggan ON tb_pemesanan.id_plg = tb_pelanggan.id_plg WHERE no_pesan = '$nopesan'") or die ($conn->error);
	}

	if(mysqli_num_rows($sql_pemesanan) > 0) {
		while($data_pemesanan = mysqli_fetch_array($sql_pemesanan)) {
			$content .= "
				<tr>
					<td align=center>$data_pemesanan[no_pesan]</td>
					<td>$data_pemesanan[nama_plg]</td>
					<td align=center>".tgl_indo($data_pemesanan['tgl_pesan'])."</td>
					<td>".ucfirst($data_pemesanan['pesan_via'])."</td>
					<td>Rp. ".number_format($data_pemesanan['total_pembayaran'], 2, ",", ".")."</td>
					<td>Rp. ".number_format($data_pemesanan['uang_muka'], 2, ",", ".")."</td>
					<td>Rp. ".number_format($data_pemesanan['piutang'], 2, ",", ".")."</td>
					<td align=center>".ucfirst($data_pemesanan['status'])."</td>
				</tr>";
		}
	} else {
		$content .= "
			<tr>
				<td align=center colspan=8>Tidak ada data</td>
			</tr>";
	}
	$content .= 
		'</table>
	</div>';
} else if(@$_GET['page'] == 'fotooutdoor') {
	$content .= "<div style='padding:20px 0 10px 0; font-size:15px;'>Laporan Foto Outdoor</div>";
	$content .=
	'<div>
		<table class="tabel" border="1px" style="border-collapse:collapse;">
			<tr style="background-color:#f99;">
				<th>No. Pesan</th>
				<th>Paket</th>
				<th>Pelanggan</th>
				<th>Tanggal Foto</th>
				<th>Jam Foto</th>
				<th>Catatan Pelanggan</th>
			</tr>';
	$sql_outdoor = mysqli_query($conn, "SELECT * FROM tb_pemesanan_detail JOIN tb_pemesanan ON tb_pemesanan_detail.no_pesan = tb_pemesanan.no_pesan JOIN tb_pelanggan ON tb_pemesanan.id_plg = tb_pelanggan.id_plg WHERE tb_pemesanan_detail.id_pkt LIKE 'PO%' AND (tgl_foto between '$date_awal' AND '$date_akhir') AND (tb_pemesanan.status = 'dp' OR tb_pemesanan.status = 'lunas') ORDER BY tb_pemesanan.no_pesan ASC") or die ($conn->error);
	if(mysqli_num_rows($sql_outdoor) > 0) {
		while($data_outdoor = mysqli_fetch_array($sql_outdoor)) {
			$content .= "
				<tr>
					<td align=center>$data_outdoor[no_pesan]</td>
					<td>$data_outdoor[id_pkt]</td>
					<td>$data_outdoor[nama_plg]</td>
					<td align=center>".tgl_indo($data_outdoor['tgl_foto'])."</td>
					<td align=right>$data_outdoor[jam_foto] WIB</td>
					<td>$data_outdoor[catatan_plg]</td>
				</tr>";
		}
	} else {
		$content .= "
			<tr>
				<td align=center colspan=6>Data tidak ditemukan</td>
			</tr>";
	}
	$content .= 
		'</table>
	</div>';
} else if(@$_GET['page'] == 'paket') {
	$paket = @mysqli_real_escape_string($conn, $_POST['paket']);
	$aktif = @mysqli_real_escape_string($conn, $_POST['aktif']);
	if($aktif != '') {
		$aktif_ = $aktif;
	} else {
		$aktif_ = '%';
	}
	$content .= "<div style='padding:20px 0 10px 0; font-size:15px;'>Laporan Paket ".ucfirst($paket)."</div>";
	$content .=
	'<div>
		<table class="tabel" border="1px" style="border-collapse:collapse;">
			<tr style="background-color:#ff6;">
				<th>No.</th>
				<th>Nama Paket</th>
				<th>Keterangan Paket</th>
				<th>Harga Paket</th>
				<th>Diskon</th>
				<th>Harga Akhir</th>
				<th>Status</th>
			</tr>';
	$no = 1;
	$sql_paket = mysqli_query($conn, "SELECT * FROM tb_paket WHERE lokasi_foto = '$paket' AND aktif_pkt LIKE '$aktif_'") or die ($conn->error);
	if(mysqli_num_rows($sql_paket) > 0) {
		while($data_paket = mysqli_fetch_array($sql_paket)) {
			if($data_paket['aktif_pkt'] == 'yes') { $status = 'Aktif'; } else { $status = 'Tidak Aktif'; }
			if($data_paket['catatan_pkt'] != '') { $nb = 'NB:'; } else { $nb = ''; }
			$content .= "
				<tr>
					<td align=center>".$no++."</td>
					<td align=center>$data_paket[nama_pkt]<br><img src='../img/paket/$data_paket[gbr_pkt]' style='width:150px'><br>$data_paket[id_pkt]</td>
					<td>".nl2br($data_paket['ket_pkt'])."<br><br>".$nb." ".nl2br($data_paket['catatan_pkt'])."</td>
					<td>Rp. ".number_format($data_paket['harga_pkt'], 2, ",", ".")."</td>
					<td>$data_paket[diskon_pkt]%</td>
					<td>Rp. ".number_format(($data_paket['harga_pkt'] - ($data_paket['diskon_pkt'] * $data_paket['harga_pkt'] / 100)), 2, ",", ".")."</td>
					<td>$status</td>
				</tr>";
		}
	} else {
		$content .= "
			<tr>
				<td align=center colspan=7>Data tidak ditemukan</td>
			</tr>";
	}
	$content .= 
		'</table>
	</div>';
} else if(@$_GET['page'] == '') {
	header("location:../admin/?page=laporanpemesanan");
}
// else if(@$_GET['page'] == 'pelanggan') {
// 	$plg = $conn->query("SELECT * FROM tb_pelanggan");
// 	if($plg->num_rows > 0){
// 		echo "<table border='1'>";
// 		echo "<tr>";
// 		echo "<th>NIS</th>";
// 		echo "<th>NAMA</th>";
// 		echo "</tr>";
// 		while($row = $plg->fetch_array()){
// 			extract($row);
// 			echo "<tr>";
// 			echo "<td>{$nama_plg}</td>";
// 			echo "<td>{$alamat_plg}</td>";
// 			echo "</tr>";
// 		}
// 		echo "</table>";
// 	} else {
// 		echo "Data Kosong";
// 	}
// 	$plg->free();
// 	$conn->close(); 

$content .= "</page>";

if(@$_GET['page'] == 'paket') {
	$posisi = 'L';
} else {
	$posisi = 'P';
}
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF($posisi, 'A4', 'en');
    $html2pdf->setTestTdInOnePage(false);
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_unique_photostudio.pdf');
} catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
} ?>