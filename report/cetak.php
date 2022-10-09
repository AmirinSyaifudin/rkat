<?php
include "../_koneksi.php";
include "../controllers/Main.php";
$main = new Main($connection);

$content =
'<style type="text/css">
table.page_header {width:100%; background-color:#DDDDFF; border-bottom:solid 2px #AAAADD; padding:2mm}
table.page_footer {width:100%; background-color:#DDDDFF; border-top:solid 2px #AAAADD; padding:2mm}
.tabel th {padding:8px 5px}
.tabel td {padding:3px}
</style>';
if(@$_GET['page'] == 'rka') {
	$position = 'L';
	$content .= '
	<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="1mm">
		<page_header>
			<table class="page_header">
				<tr>
					<td style="width:100%;">
						Rencana Kerja Anggaran Tahunan
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
			<span style="font-size:25px;">RKAT Fakultas Teknik</span><br>
		</div>';
		$no = 1;
		if(@$_GET['per'] == "unit") {
		    $query1 = $main->show_rka_join("WHERE tb_rencanakerja.unit_kerja = '$_POST[id_uk]'");
		    $row = $query1->fetch_object();
		    $content .= '<div style="padding:20px 0 10px 0; font-size:15px">Laporan Rencana dengan Unit Kerja : '.$row->jenis_uk.' ('.ucwords($row->nama_uk).')</div>';
		    $query2 = $main->show_rka_join("WHERE tb_rencanakerja.unit_kerja = '$_POST[id_uk]'");
		    $content .= '
			<table class="tabel" border="1px" style="border-collapse:collapse;">
				<tr style="background-color:#ddd;">
					<th>No.</th>
					<th>Kode RKA</th>
					<th>Nama Bidang</th>
					<th>Periode</th>
					<th>Judul Kegiatan</th>
				</tr>';
				while($data =  $query2->fetch_array()) {
					$content .= '
					<tr>
		                <td align="center">'.$no++.'</td>
		                <td>'.$data['kode_rka'].'</td>
		                <td>'.$data['nama_bidang'].'</td>
		                <td>'.ucfirst($data['periode']).'</td>
						<td>'.substr($data['judul_kegiatan'], 0, 127).' ..</td>
					</tr>';
				}
			$content .= '
			</table>';
		} else if(@$_GET['per'] == "periode") {
		    $content .= '<div style="padding:20px 0 10px 0; font-size:15px">Laporan Rencana dengan Periode : '.ucfirst(@$_POST['periode']).'</div>';
		    $query2 = $main->show_rka_join("WHERE tb_rencanakerja.periode = '$_POST[periode]'");
		    $content .= '
			<table class="tabel" border="1px" style="border-collapse:collapse;">
				<tr style="background-color:#ddd;">
					<th>No.</th>
					<th>Kode RKA</th>
					<th>Tanggal</th>
					<th>Periode</th>
					<th>Bidang</th>
					<th>Judul Kegiatan</th>
				</tr>';
				while($data =  $query2->fetch_array()) {
					$content .= '
					<tr>
		                <td align="center">'.$no++.'</td>
		                <td>'.$data['kode_rka'].'</td>
		                <td>'.tgl_indo($data['tgl_awal']).' - '.tgl_indo($data['tgl_akhir']).'</td>
		                <td>'.ucfirst($data['periode']).'</td>
						<td>'.ucfirst($data['nama_bidang']).'</td>
						<td>'.substr($data['judul_kegiatan'], 0, 115).' ..</td>
					</tr>';
				}
			$content .= '
			</table>';
		} else if(@$_GET['per'] == "status") {
		    $content .= '<div style="padding:20px 0 10px 0; font-size:15px">Laporan Rencana dengan Status Approval : '.ucfirst(@$_POST['status']).'</div>';
		    $query2 = $main->show_rka_join("WHERE tb_rencanakerja.status_approval = '$_POST[status]'");
		    $content .= '
			<table class="tabel" border="1px" style="border-collapse:collapse;">
				<tr style="background-color:#ddd;">
					<th>No.</th>
					<th>Kode RKA</th>
					<th>Nama Bidang</th>
					<th>Periode</th>
					<th>Judul Kegiatan</th>
					<th>Status Approval</th>
				</tr>';
				while($data =  $query2->fetch_array()) {
					$content .= '
					<tr>
		                <td align="center">'.$no++.'</td>
		                <td>'.$data['kode_rka'].'</td>
		                <td>'.$data['nama_bidang'].'</td>
		                <td>'.ucfirst($data['periode']).'</td>
						<td>'.substr($data['judul_kegiatan'], 0, 115).' ..</td>
						<td>'.ucfirst($data['status_approval']).'</td>
					</tr>';
				}
			$content .= '
			</table>';
		} else if(@$_GET['per'] == "id") {
			$query1 = $main->show_rka_join("WHERE tb_rencanakerja.id_rka = '$_GET[id]'");
		    $row = $query1->fetch_object();
		    $content .= '<div style="padding:20px 0 10px 0; font-size:15px">Laporan Rencana dengan Kode RKA : '.$row->kode_rka.'</div>';
		    $query2 = $main->show_rka_join("WHERE tb_rencanakerja.id_rka = '$_GET[id]'");
		    $content .= '
			<table class="tabel" border="1px" style="border-collapse:collapse;">
				<tr style="background-color:#ddd;">
					<th>No.</th>
					<th>Nama Bidang</th>
					<th>Periode</th>
					<th>Judul Kegiatan</th>
					<th>Status Approval</th>
				</tr>';
				while($data =  $query2->fetch_array()) {
					$content .= '
					<tr>
		                <td align="center">'.$no++.'</td>
		                <td>'.$data['nama_bidang'].'</td>
		                <td>'.ucfirst($data['periode']).'</td>
						<td>'.substr($data['judul_kegiatan'], 0, 143).' ..</td>
						<td>'.ucfirst($data['status_approval']).'</td>
					</tr>';
				}
			$content .= '
			</table>';
		}
	$content .= '
	</page>';
} else if(@$_GET['page'] == 'realisasi') {
	$position = 'L';
	$content .= '
	<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="1mm">
		<page_header>
			<table class="page_header">
				<tr>
					<td style="width:100%;">
						Rencana Kerja Anggaran Tahunan
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
			<span style="font-size:25px;">RKAT Fakultas Teknik</span><br>
		</div>';
	    $content .= '<div style="padding:20px 0 10px 0; font-size:15px">Laporan Anggaran Rencana VS Realisasi</div>';
		$no = 1;
		if(@$_GET['id'] == "") {
	    $query2 = $main->mysqli->fetch_join("SELECT * FROM tb_realisasi INNER JOIN tb_rencanakerja ON tb_realisasi.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_approval ON tb_approval.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka WHERE tb_realisasi.status_anggaran = '$_POST[status]'");
		} else if(@$_GET['id'] != "") {
		    $query2 = $main->mysqli->fetch_join("SELECT * FROM tb_realisasi INNER JOIN tb_rencanakerja ON tb_realisasi.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_approval ON tb_approval.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka WHERE tb_realisasi.id_realisasi = '$_GET[id]'");
		}
	    $content .= '
		<table class="tabel" border="1px" style="border-collapse:collapse;">
			<tr style="background-color:#ddd;">
				<th>No.</th>
				<th>Status</th>
				<th>Kode RKA</th>
				<th>Bidang</th>
				<th>Kegiatan</th>
				<th>Anggaran Disetujui</th>
				<th>Anggaran Realisasi</th>
				<th>Selisih</th>
			</tr>';
			while($data =  $query2->fetch_array()) {
				$content .= '
				<tr>
	                <td align="center">'.$no++.'</td>
	                <td>'.ucwords($data['status_anggaran']).'</td>
	                <td>'.$data['kode_rka'].'</td>
	                <td>'.$data['nama_bidang'].'</td>
					<td>'.substr($data['judul_kegiatan'], 0, 56).' ..</td>
					<td>Rp. '.number_format($data['anggaran_approval'], 2, ",", ".").'</td>
	                <td>Rp. '.number_format($data['anggaran_realisasi'], 2, ",", ".").'</td>
	                <td>Rp. '.number_format(($data['anggaran_approval'] - $data['anggaran_realisasi']), 2, ",", ".").'</td>
				</tr>';
			}
		$content .= '
		</table>
	</page>';
} else if(@$_GET['page'] == 'proposal') {
	$position = 'P';
	 $sql = $main->mysqli->fetch_join("SELECT * FROM tb_rencanakerja INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka WHERE tb_rencanakerja.id_rka = '$_GET[id]'");
	$data = $sql->fetch_array();
	$content .= '
	<page backtop="14mm" backbottom="14mm" backleft="1mm" backright="1mm">
		<page_header>
			<table class="page_header">
				<tr>
					<td style="width:100%;">
						Rencana Kerja Anggaran Tahunan
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
		</page_footer>';
	    $content .= '<div style="padding:0 0 10px 0; font-size:15px; text-decoration:underline">Proposal Kegiatan dengan KODE RKA : '.$data['kode_rka'].'</div>';
		$content .= '
		<div>
			<table>
				<tr>
					<td colspan="2">I. PENDAHULUAN</td>
				</tr>
				<tr>
					<td style="padding-left:20px">'.$data['latar_belakang'].'</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">II. MAKSUD DAN TUJUAN</td>
				</tr>
				<tr>
					<td style="padding-left:20px">'.$data['maksud'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">'.$data['tujuan'].'</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">III. RENCANA KEGIATAN</td>
				</tr>
				<tr>
					<td colspan="2">A. Nama Kegiatan</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Judul</td>
					<td>'.$data['judul_kegiatan'].'</td>
				</tr>
				<tr>
					<td colspan="2">B. Pelaksanaan</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:10px">Kegiatan ini akan dilaksanakan pada :</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Tanggal</td>
					<td>'.$data['tgl_awal'].' s/d '.$data['tgl_akhir'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Tempat</td>
					<td>'.$data['tempat'].'</td>
				</tr>
				<tr>
					<td colspan="2">C. Peserta</td>
				</tr>
				<tr>
					<td style="padding-left:20px">'.$data['peserta'].'</td>
				</tr>
				<tr>
					<td colspan="2">D. Jadwal Kegiatan</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Hari</td>
					<td>'.$data['jumlah_hari'].' Hari kerja</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">IV. KEPANITIAAN</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:10px">Susunan kepanitiaan kegiatan ini adalah sebagai berikut :</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Penanggung Jawab</td>
					<td>'.$data['p_penanggungjawab'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Ketua</td>
					<td>'.$data['p_ketua'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Sekretaris/Koordinator</td>
					<td>'.$data['p_sekretaris'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Bendahara</td>
					<td>'.$data['p_bendahara'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Instruktur</td>
					<td>'.$data['p_instruktur'].'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Asisten</td>
					<td>'.$data['p_asisten'].'</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">V. ANGGARAN BIAYA</td>
				</tr>
				<tr>
					<td style="padding-left:20px">A. Kesekretariatan</td>
					<td>Rp. '.number_format($data['b_kesekretariatan'], 2, ",", ".").'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">B. Konsumsi</td>
					<td>Rp. '.number_format($data['b_konsumsi'], 2, ",", ".").'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">C. Honorarium</td>
					<td>Rp. '.number_format($data['b_honorarium'], 2, ",", ".").'</td>
				</tr>
				<tr>
					<td style="padding-left:20px">Total</td>
					<td>Rp. '.number_format($data['b_total'], 2, ",", ".").'</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">VI. PENUTUP</td>
				</tr>
			</table>
				<div style="padding-left:10px; text-align:justify">
					&nbsp; &nbsp; &nbsp; Dengan demikian proposal ini dibuat dengan acuan atas pelaksanaan kegiatan yang dimaksud di atas. Hal-hal yang belum tersebut dalam proposal ini dapat ditambahkan kemudian. Atas perhatian dan kerjasama semua pihak yang turut membantu suksesnya acara ini kami ucapkan terimakasih.
				</div>
			<br><br>
			<div style="padding-left:600px">
				Jakarta, '.date('d/m/Y').'<br>
				Panitia Pelaksana<br><br><br><br><br><br>
				( ........................... )
			</div>
		</div>
	</page>';
}


require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF($position,'A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('laporan_rka.pdf');
?>