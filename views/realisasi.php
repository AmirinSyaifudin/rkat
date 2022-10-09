<div class="row">
	<div class="col-lg-12">
	    <h2>Realisasi <small>Data Realisasi</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Realisasi</li>
	      <?php echo @$_GET['act'] == '' ? '<li>Lihat Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'add' ? '<li>Tambah Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'edit' ? '<li>Edit Data</li>' : ''; ?>
	    </ol>
	    <div style="margin-bottom: 10px">
	    	<?php echo @$_GET['act'] == '' ? '<a href="?page=realisasi&act=add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon glyphicon-plus-sign"></i> Tambah</a>' : '<a href="?page=realisasi" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon glyphicon glyphicon-arrow-left"></i> Kembali</a>'; ?>
	    </div>
	</div>
</div>

<div class="row">
	<?php
	if(@$_GET['act'] == '') { ?>
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-realisasi">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode RKA</th>
							<th>Bidang</th>
							<th>Kegiatan</th>
							<th>Periode Realisasi</th>
							<th>Anggaran Realisasi</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $main->show_realisasi("WHERE tb_rencanakerja.unit_kerja = '$_SESSION[id_user]'");
			            while($data =  $query->fetch_array()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data['kode_rka']; ?></td>
				                <td><?php echo $data['nama_bidang']; ?></td>
				                <td><?php echo $data['judul_kegiatan']; ?></td>
				                <td><?php echo ucfirst($data['periode_realisasi']); ?></td>
				                <td><?php echo "Rp. ".number_format($data['anggaran_realisasi'], 2, ",", "."); ?></td>
								<td align="center" id="opsi">
									<a data-toggle="modal" data-target="#view_realisasi" class="btn btn-warning btn-xs" id="view" data-idrka="<?php echo $data['id_rka']; ?>" data-status="<?php echo ucfirst($data['status_approval']); ?>" data-periodekeg="<?php echo ucfirst($data['periode']); ?>" data-tglkeg="<?php echo tgl_indo($data['tgl_awal'])." s/d ".tgl_indo($data['tgl_akhir']); ?>" data-tglrealisasi="<?php echo tgl_indo($data['tgl_awal_r'])." s/d ".tgl_indo($data['tgl_akhir_r']); ?>" data-anggarankeg="<?php echo "Rp. ".number_format($data['b_total'], 2, ",", "."); ?>" data-statusanggaran="<?php echo ucwords($data['status_anggaran']); ?>"><i class="glyphicon glyphicon-eye-open"></i> View Details</a>
									<a href="?page=realisasi&act=del&id=<?php echo $data['id_realisasi']; ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>

			<!-- Modal View Detail Realisasi -->
			<div class="modal fade" id="view_realisasi" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Detail Realisasi</h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover table-striped" style="margin-bottom: 0">
								<thead>
									<tr>
										<th>Status Approval</th>
										<th>Periode pd Kegiatan</th>
										<th>Tgl Awal & Akhir pd Kegiatan</th>
										<th>Tgl Awal & Akhir Realisasi</th>
										<th>Anggaran pd Kegiatan</th>
										<th>Anggaran pd Approval</th>
										<th>Status Anggaran Realisasi vs Approval</th>
									</tr>
								</thead>
								<tbody>
							    	<tr>
							    		<td><span id="status"></span></td>
							    		<td><span id="periode_keg"></span></td>
							    		<td><span id="tgl_keg"></span></td>
							    		<td><span id="tgl_realisasi"></span></td>
							    		<td><span id="anggaran_keg"></span></td>
							    		<td><span id="anggaran_app"></span></td>
							    		<td><span id="status_anggaran"></span></td>
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
			$(document).on("click", "#view", function() {
				var status = $(this).data('status');
				var periode_keg = $(this).data('periodekeg');
				var tgl_keg = $(this).data('tglkeg');
				var tgl_realisasi = $(this).data('tglrealisasi');
				var anggaran_keg = $(this).data('anggarankeg');
				var status_anggaran = $(this).data('statusanggaran');
				$("#view_realisasi #status").text(status);
				$("#view_realisasi #periode_keg").text(periode_keg);
				$("#view_realisasi #tgl_keg").text(tgl_keg);
				$("#view_realisasi #tgl_realisasi").text(tgl_realisasi);
				$("#view_realisasi #anggaran_keg").text(anggaran_keg);
				$("#view_realisasi #status_anggaran").text(status_anggaran);
			});

			$("#view").click(function() {
				var id_rka = $(this).data('idrka');
				$.ajax({
				    type: 'POST',
				    url: '/rkat/views/ajax_data.php?page=rka',
				    data: 'id_rka='+id_rka,
				    success: function(data) {
				    	var isi = JSON.parse(data);
						$("#view_realisasi #anggaran_app").text(isi.anggaran_app);
				    }
				});
				});
			</script>

		</div>
	<?php
	} else if(@$_GET['act'] == 'add') { ?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">			
				<div class="form-group">
					<label for="id_rka">Kode RKA</label> <small>(Hanya RKA yang sudah di-approve yang muncul)</small>
					<select class="form-control" name="id_rka" id="id_rka" required>
					    <option value="">- Pilih Kode RKA -</option>
						<?php
						$query_rka = $main->show_rka_join("WHERE tb_rencanakerja.unit_kerja = '$_SESSION[id_user]' AND tb_rencanakerja.status_approval = 'disetujui'");
						while($data_rka = $query_rka->fetch_object()) {
						    echo '<option value="'.$data_rka->id_rka.'">'.$data_rka->kode_rka.'</option>';
						} ?>
					</select>
				</div>
				<script type="text/javascript">
				$("#id_rka").change(function() {
					var id_rka = $(this).val();
					$.ajax({
					    type: 'POST',
					    url: '/rkat/views/ajax_data.php?page=rka',
					    data: 'id_rka='+id_rka,
					    success: function(data) {
					    	var isi = JSON.parse(data);
					        $("#bidang").val(isi.nama_bidang);
					        $("#kegiatan").val(isi.nama_kegiatan);
					        $("#anggaran_kegiatan").val(isi.anggaran_kegiatan);
					        if(isi.anggaran_approval == null) {
					        	var anggaran_approval = '0 (Belum diapprove)';
					        } else {
					        	var anggaran_approval = isi.anggaran_approval;
					        }
					        $("#anggaran_approval").val(anggaran_approval);
					    }
					});
				});
				</script>
				<div class="form-group">
					<label for="bidang">Bidang Garapan</label>
					<input type="text" id="bidang" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="kegiatan">Kegiatan</label>
					<textarea id="kegiatan" class="form-control" readonly></textarea>
				</div>
				<div class="form-group">
	  				<label for="anggaran_kegiatan">Anggaran Awal Kegiatan</label>
	 				<input type="number" class="form-control" id="anggaran_kegiatan" readonly>
				</div>
				<div class="form-group">
	  				<label for="anggaran_approval">Anggaran yang Disetujui</label>
	 				<input type="text" class="form-control" name="anggaran_approval" id="anggaran_approval" readonly>
				</div>
				<div class="form-group">
					<label>Periode</label>
					<div class="radio" style="margin-top: 0px">
						<label class="radio-inline"><input type="radio" value="awal" name="periode" required>Awal</label>
						<label class="radio-inline"><input type="radio" value="akhir" name="periode">Akhir</label>
					</div>
				</div>
				<div class="form-group">
	  				<label for="tgl_awal">Tanggal Mulai</label>
	 				<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" required>
				</div>
				<div class="form-group">
	  				<label for="tgl_akhir">Tanggal Akhir</label>
	 				<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" required>
				</div>
				<div class="form-group">
	  				<label for="anggaran">Nominal Anggaran Realisasi</label>
	 				<input type="number" class="form-control" name="anggaran" id="anggaran" required>
				</div>
				<div class="form-group">
					<button class="btn btn-primary">Tambah</button> 
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
		
		<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$main->add_realisasi();
	    }
	} else if(@$_GET['act'] == 'del') {
		$main->del_realisasi($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-realisasi').DataTable();
} );
</script>