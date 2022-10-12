<?php
error_reporting(1);
include "RPCClient.php";
?>
<!doctype html>

<head>
	<title>RPC</title>
</head>

<body>
	<a href="?page=home">Home</a> | <a href="?page=tambah">Tambah Data</a> | <a href="?page=daftar-data">Data Server</a>
	<br /><br />

	<fieldset>
		<?php if ($_GET['page'] == 'tambah') { ?>
			<legend>Tambah Data</legend>
			<form name="form" method="POST" action="proses.php">
				<input type="hidden" name="aksi" value="tambah" />
				<label>ID Barang</label>
				<input type="text" name="id" />
				<br />
				<label>Nama Barang</label>
				<input type="text" name="nama" />
				<br />
				<label>Stok Barang</label>
				<input type="text" name="stok" />
				<br />
				<label>Harga Satuan</label>
				<input type="text" name="satuan" />
				<br />
				<button type="submit" name="simpan">Simpan</button>
			</form>

		<?php } elseif ($_GET['page'] == 'ubah') {
			$r = $abc->tampil_data($_GET['id']);
		?>
			<legend>Ubah Data</legend>
			<form name="form" method="post" action="proses.php">
				<input type="hidden" name="aksi" value="ubah" />
				<input type="hidden" name="id" value="<?= $r['id'] ?>" />
				<label>ID Barang</label>
				<input type="text" value="<?= $r['id'] ?>" disabled>
				<br />
				<label>Nama Barang</label>
				<input type="text" name="nama" value="<?= $r['nama'] ?>">
				<br />
				<label>Stok Barang</label>
				<input type="text" name="stok" value="<?= $r['stok'] ?>">
				<br />
				<label>Harga Satuan</label>
				<input type="text" name="satuan" value="<?= $r['satuan'] ?>">
				<br />
				<button type="submit" name="ubah">Ubah</button>
			</form>

		<?php unset($r);
		} else if ($_GET['page'] == 'daftar-data') {
		?>
			<legend>Daftar Data Server</legend>
			<table border="1">
				<tr>
					<th width='5%'>No</th>
					<th width='10%'>ID Barang</th>
					<th width='20%'>Nama</th>
					<th width='20%'>Stok</th>
					<th width='20%'>Harga</th>
					<th width='5%' colspan="2">Aksi</th>
				</tr>
				<?php $no = 1;
				$data_array = $abc->tampil_semua_data();
				foreach ($data_array as $r) {
				?> <tr>
						<td> <?= $no ?></td>
						<td> <?= $r['id'] ?></td>
						<td> <?= $r['nama'] ?></td>
						<td> <?= $r['stok'] ?></td>
						<td> <?= $r['satuan'] ?></td>
						<td><a href="?page=ubah&id=<?= $r['id'] ?>">Ubah</a></td>
						<td><a href="proses.php?aksi=hapus&id=<?= $r['id'] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a></td>
					</tr>
				<?php $no++;
				}
				unset($data_array, $r, $no);
				?>
			</table>

		<?php } else { ?>
			<legend>Home</legend>
			Aplikasi sederhana ini menggunakan RPC (Remote Procedure Call) dengan format data XML (Extensible Markup Language).
	</fieldset>
<?php } ?>
</body>

</html>