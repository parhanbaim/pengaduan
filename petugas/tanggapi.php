<?php
include '../koneksi.php';
$query = mysqli_query($koneksi, "SELECT p.*, m.nama FROM pengaduan p LEFT JOIN masyarakat m ON m.nik = p.nik WHERE p.status = 'proses' ORDER BY p.id_pengaduan DESC");
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Tanggapi Laporan</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Pelapor</th>
            <th>Isi Laporan</th>
            <th>Foto</th>
            <th>Tanggapan</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
              <td><?= htmlspecialchars($data['id_pengaduan']) ?></td>
              <td><?= htmlspecialchars($data['nama'] ?: $data['nik']) ?></td>
              <td><?= htmlspecialchars($data['isi_laporan']) ?></td>
              <td><img src="../foto/<?= htmlspecialchars($data['foto']) ?>" width="100" alt="Bukti laporan"></td>
              <td>
                <form method="post" action="proses-tanggapan.php">
                  <input type="hidden" name="id_pengaduan" value="<?= htmlspecialchars($data['id_pengaduan']) ?>">
                  <textarea name="tanggapan" class="form-control mb-2" required></textarea>
                  <button type="submit" class="btn btn-success btn-sm">Kirim Tanggapan</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
