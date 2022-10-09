<?php if(@$_GET['act'] == 'budgetvs') { ?>
	<div class="row">
		<div class="col-lg-12">
		    <h2>Laporan</h2>
		    <ol class="breadcrumb" style="margin-bottom: 10px">
		      <li>Laporan Rencana Kerja</li>
		    </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<form action="" method="post">		
				<div class="form-group">
					<label>Anggaran</label>
					<div class="radio" style="margin-top: 0px">
						<label class="radio-inline"><input type="radio" value="sesuai" name="status_anggaran" required>Sesuai</label>
						<label class="radio-inline"><input type="radio" value="tidak sesuai" name="status_anggaran">Tidak Sesuai</label>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success btn-sm" name="cari" value="Cari"> 
				</div>
			</form>
		</div>
	</div>

	<?php
	if(@$_POST['cari']) { ?>
		<div class="row">
			<div class="col-lg-12">
				<?php
				$cek = $main->mysqli->fetch_join("SELECT * FROM tb_realisasi INNER JOIN tb_rencanakerja ON tb_realisasi.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka WHERE tb_realisasi.status_anggaran = '$_POST[status_anggaran]'");
				if($cek->num_rows > 0) { ?>
					<div class="row">
						<div class="col-lg-2 col-lg-offset-10">
							<form action="./report/cetak.php?page=realisasi" target="blank" method="post">
								<input type="hidden" name="status" value="<?php echo $_POST['status_anggaran']; ?>">	
								<div class="form-group">
									<button class="btn btn-primary btn-sm form-control" type="submit"><i class="glyphicon glyphicon-print"></i> Print All</button> 
								</div>
							</form>
					</div>
				</div>
				<?php
				} ?>
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped" id="dataTables-rka">
						<thead>
							<tr>
								<th>No.</th>
								<th>Status</th>
								<th>Kode RKA</th>
								<th>Bidang</th>
								<th>Kegiatan</th>
								<th>Anggaran Disetujui</th>
								<th>Anggaran Realisasi</th>
								<th>Selisih</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
				            $no = 1;
				            $query = $main->mysqli->fetch_join("SELECT * FROM tb_realisasi INNER JOIN tb_rencanakerja ON tb_realisasi.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_approval ON tb_approval.id_rka = tb_rencanakerja.id_rka INNER JOIN tb_bidanggarapan ON tb_rencanakerja.id_bidang = tb_bidanggarapan.id_bidang INNER JOIN tb_unitkerja ON tb_rencanakerja.unit_kerja = tb_unitkerja.id_uk INNER JOIN tb_kegiatan ON tb_rencanakerja.kode_rka = tb_kegiatan.kode_rka WHERE tb_realisasi.status_anggaran = '$_POST[status_anggaran]'");
				            while($data =  $query->fetch_array()) { ?>
					    		<tr>
					                <td><?php echo $no++."."; ?></td>
					                <td><?php echo ucwords($data['status_anggaran']); ?></td>
					                <td><?php echo $data['kode_rka']; ?></td>
					                <td><?php echo $data['nama_bidang']; ?></td>
					                <td align="center">
										<a data-toggle="modal" data-target="#view_keg" class="btn btn-warning btn-xs" id="view_kegiatan" data-koderka="<?php echo $data['kode_rka']; ?>" data-latar="<?php echo $data['latar_belakang']; ?>" data-maksud="<?php echo $data['maksud']; ?>" data-tujuan="<?php echo $data['tujuan']; ?>" data-judul="<?php echo $data['judul_kegiatan']; ?>" data-tglawal="<?php echo tgl_indo($data['tgl_awal']); ?>" data-tglakhir="<?php echo tgl_indo($data['tgl_akhir']); ?>" data-tempat="<?php echo $data['tempat']; ?>" data-peserta="<?php echo $data['peserta']; ?>" data-jmlhari="<?php echo $data['jumlah_hari']; ?>" data-penanggungjawab="<?php echo ucwords($data['p_penanggungjawab']); ?>" data-ketua="<?php echo $data['p_ketua']; ?>" data-sekretaris="<?php echo $data['p_sekretaris']; ?>" data-bendahara="<?php echo $data['p_bendahara']; ?>" data-instruktur="<?php echo $data['p_instruktur']; ?>" data-asisten="<?php echo $data['p_asisten']; ?>" data-kesekretariatan="<?php echo "Rp. ".number_format($data['b_kesekretariatan'], 2, ",", "."); ?>" data-konsumsi="<?php echo "Rp. ".number_format($data['b_konsumsi'], 2, ",", "."); ?>" data-honorarium="<?php echo "Rp. ".number_format($data['b_honorarium'], 2, ",", "."); ?>" data-total="<?php echo "Rp. ".number_format($data['b_total'], 2, ",", "."); ?>"><i class="glyphicon glyphicon-eye-open"></i> View Details</a>
									</td>
					                <td><?php echo "Rp. ".number_format($data['anggaran_approval'], 2, ",", "."); ?></td>
					                <td><?php echo "Rp. ".number_format($data['anggaran_realisasi'], 2, ",", "."); ?></td>
					                <td><?php echo "Rp. ".number_format(($data['anggaran_approval'] - $data['anggaran_realisasi']), 2, ",", "."); ?></td>
									<td align="center">
										<a href="./report/cetak.php?page=realisasi&id=<?php echo $data['id_realisasi']; ?>" target="blank" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> Print</a>
									</td>
								</tr>
							<?php
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php
	}
} else if(@$_GET['act'] == 'proposal') { ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-rka">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode RKA</th>
							<th>Bidang</th>
							<th>Judul Kegiatan</th>
							<th>Latar Belakang</th>
							<th>Maksud</th>
							<th>Tujuan</th>
							<th>Kegiatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            if(@$_SESSION['level'] == 'Wadek' || @$_SESSION['level'] == 'Kaprodi' || @$_SESSION['level'] == 'Dekan') {
			            	$query = $main->show_rka_join();
			            } else {
							$query = $main->show_rka_join("WHERE tb_rencanakerja.unit_kerja = '$_SESSION[id_user]'");
			            }
			            while($data =  $query->fetch_array()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data['kode_rka']; ?></td>
				                <td><?php echo $data['nama_bidang']; ?></td>
								<td><?php echo $data['judul_kegiatan']; ?></td>
				                <td><?php echo $data['latar_belakang']; ?></td>
				                <td><?php echo $data['maksud']; ?></td>
				                <td><?php echo $data['tujuan']; ?></td>
				                <td align="center">
									<a data-toggle="modal" data-target="#view_keg" class="btn btn-warning btn-xs" id="view_kegiatan" data-koderka="<?php echo $data['kode_rka']; ?>" data-latar="<?php echo $data['latar_belakang']; ?>" data-maksud="<?php echo $data['maksud']; ?>" data-tujuan="<?php echo $data['tujuan']; ?>" data-judul="<?php echo $data['judul_kegiatan']; ?>" data-tglawal="<?php echo tgl_indo($data['tgl_awal']); ?>" data-tglakhir="<?php echo tgl_indo($data['tgl_akhir']); ?>" data-tempat="<?php echo $data['tempat']; ?>" data-peserta="<?php echo $data['peserta']; ?>" data-jmlhari="<?php echo $data['jumlah_hari']; ?>" data-penanggungjawab="<?php echo ucwords($data['p_penanggungjawab']); ?>" data-ketua="<?php echo $data['p_ketua']; ?>" data-sekretaris="<?php echo $data['p_sekretaris']; ?>" data-bendahara="<?php echo $data['p_bendahara']; ?>" data-instruktur="<?php echo $data['p_instruktur']; ?>" data-asisten="<?php echo $data['p_asisten']; ?>" data-kesekretariatan="<?php echo "Rp. ".number_format($data['b_kesekretariatan'], 2, ",", "."); ?>" data-konsumsi="<?php echo "Rp. ".number_format($data['b_konsumsi'], 2, ",", "."); ?>" data-honorarium="<?php echo "Rp. ".number_format($data['b_honorarium'], 2, ",", "."); ?>" data-total="<?php echo "Rp. ".number_format($data['b_total'], 2, ",", "."); ?>"><i class="glyphicon glyphicon-eye-open"></i> View Details</a>
								</td>
								<td align="center">
									<a href="./report/cetak.php?page=proposal&id=<?php echo $data['id_rka']; ?>" target="blank" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak Proposal</a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php
} ?>

<!-- Modal View Detail Kegiatan -->
<div class="modal fade" id="view_keg" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="kode_rka"></h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover table-striped" style="margin-bottom: 0">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Tempat</th>
							<th>Peserta</th>
							<th>Jumlah Hari</th>
							<th>Kepanitiaan</th>
							<th>Biaya</th>
						</tr>
					</thead>
					<tbody>
				    	<tr>
				    		<td><span id="tgl_awal"></span><br><span id="tgl_akhir"></span></td>
				    		<td><span id="tempat"></span></td>
				    		<td><span id="peserta"></span></td>
				    		<td><span id="jumlah_hari"></span></td>
				    		<td align="center"><button class="btn btn-default btn-xs" id="kepanitiaan" data-toggle="modal" data-target="#view_panitia">Details</button></td>
				    		<td align="center"><button class="btn btn-default btn-xs" id="biaya" data-toggle="modal" data-target="#view_biaya">Details</button></td>
				    	</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).on("click", "#view_kegiatan", function() {
	var kode_rka = $(this).data('koderka');
	// var latar_belakang = $(this).data('latar');
	// var maksud = $(this).data('maksud');
	// var tujuan = $(this).data('tujuan');
	// var judul = $(this).data('judul');
	var tempat = $(this).data('tmp');
	var tgl_awal = $(this).data('tglawal');
	var tgl_akhir = $(this).data('tglakhir');
	var tempat = $(this).data('tempat');
	var peserta = $(this).data('peserta');
	var jumlah_hari = $(this).data('jmlhari');
	$("#view_keg #kode_rka").text(kode_rka);
	// $("#view_keg #latar_belakang").text(latar_belakang);
	// $("#view_keg #maksud").text(maksud);
	// $("#view_keg #tujuan").text(tujuan);
	// $("#view_keg #judul").text(judul);
	$("#view_keg #tgl_awal").text('Start : '+tgl_awal);
	$("#view_keg #tgl_akhir").text('End : '+tgl_akhir);
	$("#view_keg #tempat").text(tempat);
	$("#view_keg #peserta").text(peserta);
	$("#view_keg #jumlah_hari").text(jumlah_hari+' hari kerja');
	$("#view_keg #kepanitiaan").data({penanggungjawab: $(this).data('penanggungjawab'), ketua: $(this).data('ketua'), sekretaris: $(this).data('sekretaris'), bendahara: $(this).data('bendahara'), instruktur: $(this).data('instruktur'), asisten: $(this).data('asisten')});
	$("#view_keg #biaya").data({kesekretariatan: $(this).data('kesekretariatan'), konsumsi: $(this).data('konsumsi'), honorarium: $(this).data('honorarium'), total: $(this).data('total')});
});

$(document).on("click", "#kepanitiaan", function() {
	$("#view_panitia #p_a").text($(this).data('penanggungjawab'));
	$("#view_panitia #p_b").text($(this).data('ketua'));
	$("#view_panitia #p_c").text($(this).data('sekretaris'));
	$("#view_panitia #p_d").text($(this).data('bendahara'));
	$("#view_panitia #p_e").text($(this).data('instruktur'));
	$("#view_panitia #p_f").text($(this).data('asisten'));
});

$(document).on("click", "#biaya", function() {
	$("#view_biaya #b_a").text($(this).data('kesekretariatan'));
	$("#view_biaya #b_b").text($(this).data('konsumsi'));
	$("#view_biaya #b_c").text($(this).data('honorarium'));
	$("#view_biaya #b_d").text($(this).data('total'));
});
</script>

<!-- Modal View Detail Panitia -->
<div class="modal fade" id="view_panitia" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Kepanitiaan</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover table-striped" style="margin-bottom: 0">
					<thead>
						<tr>
							<th>Penanggung Jawab</th>
							<th>Ketua</th>
							<th>Sekretaris</th>
							<th>Bendahara</th>
							<th>Instruktur</th>
							<th>Asisten</th>
						</tr>
					</thead>
					<tbody>
				    	<tr>
				    		<td><span id="p_a"></span></td>
				    		<td><span id="p_b"></span></td>
				    		<td><span id="p_c"></span></td>
				    		<td><span id="p_d"></span></td>
				    		<td><span id="p_e"></span></td>
				    		<td><span id="p_f"></span></td>
				    	</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal View Detail Biaya -->
<div class="modal fade" id="view_biaya" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Anggaran Biaya Kegiatan</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover table-striped" style="margin-bottom: 0">
					<thead>
						<tr>
							<th>Kesekretariatan</th>
							<th>Konsumsi</th>
							<th>Honorarium</th>
							<th>Total Biaya</th>
						</tr>
					</thead>
					<tbody>
				    	<tr>
				    		<td><span id="b_a"></span></td>
				    		<td><span id="b_b"></span></td>
				    		<td><span id="b_c"></span></td>
				    		<td><span id="b_d"></span></td>
				    	</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    var table = $('#dataTables-rka').DataTable();
} );
</script>