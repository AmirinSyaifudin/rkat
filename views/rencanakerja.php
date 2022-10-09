<div class="row">
	<div class="col-lg-12">
	    <h2>Rencana Kerja <small>Data Rencana Kerja</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Rencana Kerja</li>
	      <?php echo @$_GET['act'] == '' ? '<li>Lihat Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'add' ? '<li>Tambah Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'edit' ? '<li>Edit Data</li>' : ''; ?>
	    </ol>
	    <div style="margin-bottom: 10px">
	    	<?php echo @$_GET['act'] == '' ? '<a href="?page=rka&act=add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon glyphicon-plus-sign"></i> Tambah</a>' : '<a href="?page=rka" class="btn btn-warning btn-xs">Lihat Data RKA</a> <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>'; ?>
	    </div>
	</div>
</div>

<div class="row">
	<?php
	if(@$_GET['act'] == '') { ?>
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-rka">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode RKA</th>
							<th>Bidang</th>
							<th>Periode</th>
							<th>Status</th>
							<th>Kegiatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $main->show_rka_join("WHERE tb_rencanakerja.unit_kerja = '$_SESSION[id_user]'");
			            while($data =  $query->fetch_array()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data['kode_rka']; ?></td>
				                <td><?php echo $data['nama_bidang']; ?></td>
				                <td><?php echo ucfirst($data['periode']); ?></td>
								<td><?php echo ucfirst($data['status_approval']); ?></td>
								<td align="center">
									<a data-toggle="modal" data-target="#view_keg" class="btn btn-warning btn-xs" id="view_kegiatan" data-koderka="<?php echo $data['kode_rka']; ?>" data-latar="<?php echo $data['latar_belakang']; ?>" data-maksud="<?php echo $data['maksud']; ?>" data-tujuan="<?php echo $data['tujuan']; ?>" data-judul="<?php echo $data['judul_kegiatan']; ?>" data-tglawal="<?php echo tgl_indo($data['tgl_awal']); ?>" data-tglakhir="<?php echo tgl_indo($data['tgl_akhir']); ?>" data-tempat="<?php echo $data['tempat']; ?>" data-peserta="<?php echo $data['peserta']; ?>" data-jmlhari="<?php echo $data['jumlah_hari']; ?>" data-penanggungjawab="<?php echo ucwords($data['p_penanggungjawab']); ?>" data-ketua="<?php echo $data['p_ketua']; ?>" data-sekretaris="<?php echo $data['p_sekretaris']; ?>" data-bendahara="<?php echo $data['p_bendahara']; ?>" data-instruktur="<?php echo $data['p_instruktur']; ?>" data-asisten="<?php echo $data['p_asisten']; ?>" data-kesekretariatan="<?php echo "Rp. ".number_format($data['b_kesekretariatan'], 2, ",", "."); ?>" data-konsumsi="<?php echo "Rp. ".number_format($data['b_konsumsi'], 2, ",", "."); ?>" data-honorarium="<?php echo "Rp. ".number_format($data['b_honorarium'], 2, ",", "."); ?>" data-total="<?php echo "Rp. ".number_format($data['b_total'], 2, ",", "."); ?>"><i class="glyphicon glyphicon-eye-open"></i> View Details</a>
								</td>
								<td align="center">
									<a href="?page=rka&act=del&id=<?php echo $data['kode_rka']; ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>
								</td>
							</tr>
						<?php
						} 
						?>
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
		</div>
	<?php
	} else if(@$_GET['act'] == 'add') { ?>
		<div id="add1">
			<div class="col-lg-4 col-lg-offset-4">	
				<div class="form-group">
					<?php
					$sql_koderka = $main->koderka_uk($_SESSION['level']);
					$datakode = $sql_koderka->fetch_array();
					$ex = explode('/', $datakode[0]);
					if(date('d') == '01') {
						$e = '001';
					} else {
						if($datakode[0]) {
							$kode = $ex[4]+1;
							$e = '00'.$kode;
						} else { $e = '001'; }
					}
					$a = 'RKA';
					$b = ucwords($_SESSION['level']);
					$c = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
					$d = date('Y');
					$kode_rka = $a.'/'.$b.'/'.$c[date('n')].'/'.$d.'/'.$e;
					?>
	  				<label for="kode_rka">Kode RKA</label>
	 				<input type="text" class="form-control" name="kode_rka" id="kode_rka" value="<?php echo $kode_rka; ?>">
				</div>
				<div class="form-group">
					<label for="id_bidang">Bidang Garapan</label>
					<select class="form-control" name="id_bidang" id="id_bidang">
					    <option value="">- Pilih Bidang Garapan -</option>
						<?php
						include "controllers/Admin.php";
						$adm = new Admin($connection);
						$query_bg = $adm->show_bidanggarapan();
						while($data_bg = $query_bg->fetch_object()) {
						    echo '<option value="'.$data_bg->id_bidang.'">'.$data_bg->nama_bidang.'</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
					<label>Periode</label>
					<div class="radio" style="margin-top: 0px">
						<label class="radio-inline"><input type="radio" value="awal" name="periode" id="periode">Awal</label>
						<label class="radio-inline"><input type="radio" value="akhir" name="periode" id="periode">Akhir</label>
					</div>
				</div>
				<div class="form-group pull-right">
					<button class="btn btn-default" id="next">Next <i class="glyphicon glyphicon-arrow-right"></i></button> 
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$("#next").click(function() {
			var kode_rka = $("#kode_rka").val();
			var id_bidang = $("#id_bidang").val();
			var periode = $("input[name=periode]:checked").val();
			if(kode_rka == '') {
				$("#kode_rka").focus();
			} else if(id_bidang == '') {
				$("#id_bidang").focus();
			} else if($("input[name=periode]").is(":checked") == false) {
				$("#periode").focus();
			} else {
				$("#koderka").val(kode_rka); $("#idbidang").val(id_bidang); $("#priode").val(periode);
				$("#add1").hide();
				$("#add2").fadeIn(1000);
			}
		})
		</script>
		<div id="add2" style="display: none">
			<div class="col-lg-12">
				<div class="form-group">
					<button class="btn btn-default" id="back"><i class="glyphicon glyphicon-arrow-left"></i> Back</button>
				</div>
			</div>
			<form id="form" action="" method="post">	
				<div class="col-lg-10 col-lg-offset-1">
					<input type="hidden" name="kode_rka" id="koderka">
					<input type="hidden" name="id_bidang" id="idbidang">
					<input type="hidden" name="periode" id="priode">
					<div class="form-group">
						<small>* Perhatian! Jika data memang tidak ada / kosong, silakan isi dengan tanda ( - ) pada inputan text dan isi ( 0 ) pada inputan angka.</small><br>
		  				<label>I. PENDAHULUAN</label>
		 				<textarea class="form-control" name="latar_belakang" placeholder="Latar Belakang Masalah" required></textarea>
					</div>
					<div class="form-group">
		  				<label>II. MAKSUD DAN TUJUAN</label>
		 				<textarea class="form-control" name="maksud" placeholder="Maksud dari kegiatan ini adalah" required></textarea>
					</div>
		 			<div class="form-group">
		 				<textarea class="form-control" name="tujuan" placeholder="Tujuan yang ingin dicapai" required></textarea>
					</div>
					<div class="form-group">
						<div>
							<label>III. RENCANA KEGIATAN</label>
						</div>
						<div>
							<label>A. Nama Kegiatan</label>
						</div>
						<div class="row">
			  				<span class="col-lg-1">Judul</span>
			  				<div class="col-lg-6">
				  				<input type="text" name="judul" class="form-control" placeholder="Judul kegiatan" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
	  					<div>
							<label>B. Pelaksanaan</label>
	  					</div>
	  					<div>
							<label style="font-weight: normal">Kegiatan ini akan dilaksanakan pada :</label>
	  					</div>
	  					<div class="row">
			  				<span class="col-lg-1">Tanggal</span>
			  				<div class="col-lg-3">
				  				Start : <input type="date" name="tgl_awal" class="form-control" required>
		  					</div>
		  					<div class="col-lg-3">
				  				End : <input type="date" name="tgl_akhir" class="form-control" required>
		  					</div>
	  					</div>
					</div>
					<div class="form-group">
						<div class="row">
			  				<span class="col-lg-1">Tempat</span>
			  				<div class="col-lg-6">
				  				<input type="text" name="tempat" class="form-control" placeholder="Tempat" required>
		  					</div>
	  					</div>
					</div>
					<div class="form-group">
		  				<label>C. Peserta</label>
		 				<textarea class="form-control" name="peserta" id="peserta" required></textarea>
					</div>
					<div class="form-group">
	  					<div>
							<label>D. Jadwal kegiatan</label>
	  					</div>
	  					<div class="row">
			  				<span class="col-lg-1">Hari</span>
		  					<div class="col-lg-3">
				  				<input type="number" name="jumlah_hari" class="form-control" placeholder="Hari kerja" required>
		  					</div>
	  					</div>
					</div>
					<div class="form-group">
						<div>
							<label>IV. KEPANITIAAN</label>
						</div>
						<div>
							<label style="font-weight: normal">Susunan kepanitiaan kegiatan ini adalah sebagai berikut :</label>
						</div>
						<div class="row">
			  				<span class="col-lg-2">Penanggung Jawab</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_penanggungjawab" value="<?php echo @$_SESSION['user'] ?>" class="form-control" required readonly>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Ketua</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_ketua" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Sekretaris/Koordinator</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_sekretaris" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Bendahara</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_bendahara" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Instruktur</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_instruktur" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Asisten</span>
			  				<div class="col-lg-5">
				  				<input type="text" name="p_asisten" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
					<div class="form-group">
						<div>
							<label>V. ANGGARAN BIAYA</label>
						</div>
						<div class="row">
			  				<span class="col-lg-2">A. Kesekretariatan</span>
			  				<div class="col-lg-5">
				  				<input type="number" name="b_sktriat" id="b_sktriat" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">B. Konsumsi</span>
			  				<div class="col-lg-5">
				  				<input type="number" name="b_konsumsi" id="b_konsumsi" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">C. Honorarium</span>
			  				<div class="col-lg-5">
				  				<input type="number" name="b_honorarium" id="b_honorarium" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<div class="form-group">
						<div class="row">
			  				<span class="col-lg-2">Total</span>
			  				<div class="col-lg-5">
				  				<input type="number" name="b_total" id="b_total" class="form-control" required>
		  					</div>
	  					</div>
	  				</div>
	  				<script type="text/javascript">
	  				function total() {
	  					var b_sktriat = $("#b_sktriat").val();
	  					var b_konsumsi = $("#b_konsumsi").val();
	  					var b_honorarium = $("#b_honorarium").val();
	  					if(b_sktriat != '' && b_konsumsi != '') {
		  					var total = parseInt(b_sktriat) + parseInt(b_konsumsi) + parseInt(b_honorarium);
	  					} else if(b_sktriat != '' && b_konsumsi == '') {
	  						var total = parseInt(b_sktriat) + parseInt(b_honorarium);
	  					} else if(b_sktriat == '' && b_konsumsi != '') {
	  						var total = parseInt(b_konsumsi) + parseInt(b_honorarium);
	  					} else if(b_sktriat == '' && b_konsumsi == '') {
	  						var total = parseInt(b_honorarium);
	  					}
	  					$("#b_total").val(total);
	  				}
	  				$("#b_honorarium").keyup(function() {
	  					total();
	  				});
	  				</script>
	  				<div class="form-group">
	  					<div>
							<label>VI. PENUTUP</label>
	  					</div>
	  					<div>
							<span>&nbsp; &nbsp; &nbsp; &nbsp; Dengan demikian proposal ini dibuat dengan acuan atas pelaksanaan kegiatan yang dimaksud di atas. Hal-hal yang belum tersebut dalam proposal ini dapat ditambahkan kemudian.</span> <span>Atas perhatian dan kerjasama semua pihak yang turut membantu suksesnya acara ini kami ucapkan terimakasih.</span>
	  					</div>
	  				</div>
	  				<div class="row">
						<div class="col-lg-3 col-lg-offset-9">
							<div>
								Jakarta, <?php echo date('d/m/Y'); ?>
							</div>
							<div>
								Panitia Pelaksana
							</div>
							<br>
							<br>
							<br>
							<div>
								Penanggung Jawab
							</div>
						</div>
	  				</div>
	  				<br>
	  				<br>
					<div class="form-group">
						<button class="btn btn-success btn-lg" type="submit">Save</button> 
						<button class="btn btn-danger btn-lg" type="reset">Reset</button>
					</div>
				</div>
			</form>
			<script type="text/javascript">
			$(document).ready(function(e) {
				$("#form").on("submit", (function(e) {
					e.preventDefault();
					$.ajax({
						url : 'views/proses.php?page=add_rka',
						type : 'POST',
						data : new FormData(this),
						contentType : false,
						cache : false,
						processData : false,
						success : function(msg) {
							window.location='/rkat/?page=rka';
						}
					});
				}));
			});


			$("#back").click(function() {
				$("#add2").hide();
				$("#add1").fadeIn(1000);
			})
			</script>
		</div>
	<?php
	} else if(@$_GET['act'] == 'del') {
		$main->del_rka($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-rka').DataTable();
} );
</script>