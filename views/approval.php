<div class="row">
	<div class="col-lg-12">
	    <h2>Approval <small>Halaman Persetujuan Rencana Kerja</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Approval</li>
	    </ol>
	</div>
</div>

<div class="row">
	<?php if(@$_GET['act'] == '') { ?>
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-rka">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode RKA</th>
							<th>Bidang</th>
							<th>Periode</th>
							<th>Unit Kerja</th>
							<th>Status</th>
							<th>Kegiatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $main->show_rka_join();
			            while($data =  $query->fetch_array()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data['kode_rka']; ?></td>
				                <td><?php echo $data['nama_bidang']; ?></td>
				                <td><?php echo ucfirst($data['periode']); ?></td>
				                <td><?php echo ucwords($data['nama_uk'])." - (".$data['jenis_uk'].")"; ?></td>
								<td><?php echo ucfirst($data['status_approval']); ?></td>
								<?php $query_approval = $main->show_approval($data['id_rka']);
								$data_approval = $query_approval->fetch_object(); ?>
								<td align="center">
									<a data-toggle="modal" data-target="#view_keg" class="btn btn-warning btn-xs" id="view_kegiatan" data-koderka="<?php echo $data['kode_rka']; ?>" data-latar="<?php echo $data['latar_belakang']; ?>" data-maksud="<?php echo $data['maksud']; ?>" data-tujuan="<?php echo $data['tujuan']; ?>" data-judul="<?php echo $data['judul_kegiatan']; ?>" data-tglawal="<?php echo tgl_indo($data['tgl_awal']); ?>" data-tglakhir="<?php echo tgl_indo($data['tgl_akhir']); ?>" data-tempat="<?php echo $data['tempat']; ?>" data-peserta="<?php echo $data['peserta']; ?>" data-jmlhari="<?php echo $data['jumlah_hari']; ?>" data-penanggungjawab="<?php echo ucwords($data['p_penanggungjawab']); ?>" data-ketua="<?php echo $data['p_ketua']; ?>" data-sekretaris="<?php echo $data['p_sekretaris']; ?>" data-bendahara="<?php echo $data['p_bendahara']; ?>" data-instruktur="<?php echo $data['p_instruktur']; ?>" data-asisten="<?php echo $data['p_asisten']; ?>" data-kesekretariatan="<?php echo "Rp. ".number_format($data['b_kesekretariatan'], 2, ",", "."); ?>" data-konsumsi="<?php echo "Rp. ".number_format($data['b_konsumsi'], 2, ",", "."); ?>" data-honorarium="<?php echo "Rp. ".number_format($data['b_honorarium'], 2, ",", "."); ?>" data-total="<?php echo "Rp. ".number_format($data['b_total'], 2, ",", "."); ?>"><i class="glyphicon glyphicon-eye-open"></i> View Details</a>
								</td>
								<td align="center" id="opsi">
									<?php if($data['status_approval'] == "disetujui") { ?>
										<a data-toggle="modal" data-target="#view_approval" class="btn btn-default btn-xs" id="doview_a" data-rka="<?php echo $data['kode_rka']; ?>" data-anggaran="<?php echo "Rp. ".number_format($data_approval->anggaran_approval, 2, ",", "."); ?>" data-oleh="<?php echo $data_approval->jenis_uk." (".$data_approval->nama_uk.")"; ?>"><i class="glyphicon glyphicon-eye-open"></i> Detail Approval</a><br>
										<a href="?page=approval&act=cancel&id=<?php echo $data['id_rka']; ?>" onclick="return confirm('Yakin akan men-cancel approval ini?')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i> Cancel Approval</a>
									<?php } else { ?>
										<a data-toggle="modal" data-target="#approve" id="doapprove" data-koderka="<?php echo $data['kode_rka']; ?>" data-idrka="<?php echo $data['id_rka']; ?>" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-ok"></i> Approve</a>
									<?php } ?>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>

			<!-- Modal View Detail Kegiatan -->
			<div class="modal fade" id="view_keg" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="kode_rka"></h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Latar Belakang</th>
										<th>Maksud</th>
										<th>Tujuan</th>
										<th>Judul</th>
									</tr>
								</thead>
								<tbody>
							    	<tr>
							    		<td><span id="latar_belakang"></span></td>
							    		<td><span id="maksud"></span></td>
							    		<td><span id="tujuan"></span></td>
							    		<td><span id="judul"></span></td>
							    	</tr>
								</tbody>
							</table>
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
				var latar_belakang = $(this).data('latar');
				var maksud = $(this).data('maksud');
				var tujuan = $(this).data('tujuan');
				var judul = $(this).data('judul');
				var tempat = $(this).data('tmp');
				var tgl_awal = $(this).data('tglawal');
				var tgl_akhir = $(this).data('tglakhir');
				var tempat = $(this).data('tempat');
				var peserta = $(this).data('peserta');
				var jumlah_hari = $(this).data('jmlhari');
				$("#view_keg #kode_rka").text(kode_rka);
				$("#view_keg #latar_belakang").text(latar_belakang);
				$("#view_keg #maksud").text(maksud);
				$("#view_keg #tujuan").text(tujuan);
				$("#view_keg #judul").text(judul);
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
							<h4 class="modal-title">Anggaran Biaya</h4>
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

			<!-- Modal Approve -->
			<div class="modal fade" id="approve" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Proses Approval</h4>
						</div>
						<form action="" method="post">
							<div class="modal-body">	
								<div class="form-group">
									<div class="form-group">
						  				<label for="kode_rka">Kode RKA</label>
						 				<input type="text" class="form-control" name="kode_rka" id="kode_rka" required readonly>
						 				<input type="hidden" name="id_rka" id="id_rka">
									</div>
								</div>
								<div class="form-group">
									<div class="form-group">
						  				<label for="anggaran_approval">Anggaran yang Disetujui</label>
						 				<input type="number" class="form-control" name="anggaran_approval" id="anggaran_approval" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Approve</button>
							</div>
						</form>
						<?php
					    if($_SERVER['REQUEST_METHOD'] == 'POST') {
					    	$main->add_approval();
					    } ?>
					</div>
				</div>
			</div>
			<script type="text/javascript">
			$(document).on("click", "#doapprove", function() {
				var kode_rka = $(this).data('koderka');
				var id_rka = $(this).data('idrka');
				$("#approve #kode_rka").val(kode_rka);
				$("#approve #id_rka").val(id_rka);
			});

			$(document).on("click", "#doview_a", function() {
				var rka = $(this).data('rka');
				var anggaran = $(this).data('anggaran');
				var oleh = $(this).data('oleh');
				$("#view_approval #koderka").text(rka);
				$("#view_approval #anggaran").text(anggaran);
				$("#view_approval #disetujui_oleh").text(oleh);
			});
			</script>

			<!-- Modal View Detail Approval -->
			<div class="modal fade" id="view_approval" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Detail Approval</h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover table-striped" style="margin-bottom: 0">
								<thead>
									<tr>
										<th>Kode RKA</th>
										<th>Anggaran Disetujui</th>
										<th>Disetujui Oleh</th>
									</tr>
								</thead>
								<tbody>
							    	<tr>
							    		<td><span id="koderka"></span></td>
							    		<td><span id="anggaran"></span></td>
							    		<td><span id="disetujui_oleh"></span></td>
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
		</div>
	<?php
	} else if(@$_GET['act'] == 'cancel') {
		$main->del_approval($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-rka').DataTable();
} );
</script>