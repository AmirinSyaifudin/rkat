<div class="row">
	<div class="col-lg-12">
	    <h2>Kegiatan <small>Data Kegiatan</small></h2>
	    <ol class="breadcrumb" style="margin-bottom: 10px">
	      <li>Kegiatan</li>
	      <?php echo @$_GET['act'] == '' ? '<li>Lihat Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'add' ? '<li>Tambah Data</li>' : ''; ?>
	      <?php echo @$_GET['act'] == 'edit' ? '<li>Edit Data</li>' : ''; ?>
	    </ol>
	    <div style="margin-bottom: 10px">
	    	<?php echo @$_GET['act'] == '' ? '<a href="?page=kegiatan&act=add" class="btn btn-success btn-sm"><i class="glyphicon glyphicon glyphicon-plus-sign"></i> Tambah</a>' : '<a href="?page=kegiatan" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon glyphicon glyphicon-arrow-left"></i> Kembali</a>'; ?>
	    </div>
	</div>
</div>

<div class="row">
	<?php
	if(@$_GET['act'] == '') { ?>
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="dataTables-kegiatan">
					<thead>
						<tr>
							<th>#</th>
							<th>Bidang Garapan</th>
							<th>Nama Kegiatan</th>
							<th>Target</th>
							<th>Tanggal Awal</th>
							<th>Tanggal Akhir</th>
							<th>Tempat</th>
							<th>Penanggung Jawab</th>
							<th>Anggaran</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
			            $no = 1;
			            $query = $adm->show_kegiatan_join();
			            while($data =  $query->fetch_object()) { ?>
				    		<tr>
				                <td><?php echo $no++."."; ?></td>
				                <td><?php echo $data->nama_bidang; ?></td>
				                <td><?php echo $data->nama_kegiatan; ?></td>
				                <td><?php echo $data->target; ?></td>
				                <td><?php echo tgl_indo($data->tgl_awal); ?></td>
				                <td><?php echo tgl_indo($data->tgl_akhir); ?></td>
				                <td><?php echo $data->tempat; ?></td>
				                <td><?php echo $data->jenis_uk." (".$data->nama_uk.")"; ?></td>
				                <td><?php echo "Rp. ".number_format($data->anggaran, 2, ",", "."); ?></td>
								<td align="center" id="opsi">
									<a href="?page=kegiatan&act=edit&id=<?php echo $data->id_kegiatan; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>
									<a href="?page=kegiatan&act=del&id=<?php echo $data->id_kegiatan; ?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	} else if(@$_GET['act'] == 'add') { ?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">
				<div class="form-group">
					<label for="id_bidang">Bidang Garapan</label>
					<select class="form-control" name="id_bidang" id="id_bidang" required>
					    <option value="">- Pilih Bidang Garapan -</option>
						<?php
						$query_bg = $adm->show_bidanggarapan();
						while($data_bg = $query_bg->fetch_object()) {
						    echo '<option value="'.$data_bg->id_bidang.'">'.$data_bg->nama_bidang.'</option>';
						} ?>
					</select>
				</div>		
				<div class="form-group">
	  				<label for="nama">Nama Kegiatan</label>
	 				<textarea class="form-control" name="nama" id="nama" required></textarea>
				</div>
				<div class="form-group">
	  				<label for="target">Target</label>
	 				<textarea class="form-control" name="target" id="target" required></textarea>
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
	  				<label for="tempat">Tempat</label>
	 				<input type="text" class="form-control" name="tempat" id="tempat" required>
				</div>
				<div class="form-group">
					<label for="id_uk">Penanggung Jawab</label>
					<select class="form-control" name="id_uk" id="id_uk" required>
					    <option value="">- Pilih Unit Kerja -</option>
						<?php
						$query_uk= $adm->show_unitkerja();
						while($data_uk= $query_uk->fetch_object()) {
						    echo '<option value="'.$data_uk->id_uk.'">'.$data_uk->jenis_uk.' - ('.$data_uk->nama_uk.')</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
	  				<label for="anggaran">Anggaran</label>
	 				<input type="number" class="form-control" name="anggaran" id="anggaran" required>
				</div>
				<button class="btn btn-primary">Tambah</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
		<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$adm->add_kegiatan();
	    }
	} else if(@$_GET['act'] == 'edit') {
		$query = $adm->show_kegiatan_join($_GET['id']);
		$data =  $query->fetch_object();
		?>
		<form action="" method="post">
			<div class="col-lg-4 col-lg-offset-4">
				<div class="form-group">
					<label for="id_bidang">Bidang Garapan</label>
					<select class="form-control" name="id_bidang" id="id_bidang" required>
						<?php
					    echo '<option value="'.$data->id_bidang.'">'.$data->nama_bidang.' *</option>';
						$query_bg = $adm->show_bidanggarapan();
						while($data_bg = $query_bg->fetch_object()) {
						    echo '<option value="'.$data_bg->id_bidang.'">'.$data_bg->nama_bidang.'</option>';
						} ?>
					</select>
				</div>		
				<div class="form-group">
	  				<label for="nama">Nama Kegiatan</label>
	  				<textarea class="form-control" name="nama" id="nama" required><?php echo $data->nama_kegiatan; ?></textarea>
				</div>
				<div class="form-group">
	  				<label for="target">Target</label>
	 				<textarea class="form-control" name="target" id="target" required><?php echo $data->target; ?></textarea>
				</div>
				<div class="form-group">
	  				<label for="tgl_awal">Tanggal Mulai</label>
	 				<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="<?php echo $data->tgl_awal; ?>" required>
				</div>
				<div class="form-group">
	  				<label for="tgl_akhir">Tanggal Akhir</label>
	 				<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?php echo $data->tgl_akhir; ?>" required>
				</div>
				<div class="form-group">
	  				<label for="tempat">Tempat</label>
	 				<input type="text" class="form-control" name="tempat" id="tempat" value="<?php echo $data->tempat; ?>" required>
				</div>
				<div class="form-group">
					<label for="id_uk">Penanggung Jawab</label>
					<select class="form-control" name="id_uk" id="id_uk" required>
					    <option value="<?php echo $data->penanggung_jawab; ?>"><?php echo $data->jenis_uk." - (".$data->nama_uk.") *"; ?></option>
						<?php
						$query_uk= $adm->show_unitkerja();
						while($data_uk= $query_uk->fetch_object()) {
						    echo '<option value="'.$data_uk->id_uk.'">'.$data_uk->jenis_uk.' - ('.$data_uk->nama_uk.')</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
	  				<label for="anggaran">Anggaran</label>
	 				<input type="number" class="form-control" name="anggaran" id="anggaran" value="<?php echo $data->anggaran; ?>" required>
				</div>
				<button class="btn btn-primary">Edit</button> 
				<button type="reset" class="btn btn-danger">Reset</button>
			</div>
		</form>
		<?php
	    if($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$adm->edit_kegiatan($_GET['id']);
	    }
	} else if(@$_GET['act'] == 'del') {
		$adm->del_kegiatan($_GET['id']);
	} ?>
</div>

<script>
$(document).ready(function() {
    var table = $('#dataTables-kegiatan').DataTable();
} );
</script>