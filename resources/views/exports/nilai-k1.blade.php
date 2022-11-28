<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMAT IMPORT KKM</title>
</head>

<body>
  <table>
  <thead class="bg-primary">
                      <tr>
                        <th style="vertical-align: middle;" class="text-center">No</th>
                        <th style="vertical-align: middle;" class="text-center">Nama Siswa</th>
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <input type="hidden" name="rencana_nilai_k1_id[]" value="{{$rencana_penilaian->id}}">
                        <td class="text-center" style="width: 200px;"><b>{{$rencana_penilaian->butir_sikap->kode}}</b></td>
                        @endforeach
                      </tr>
                      <tr>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($data_anggota_kelas->sortBy('siswa.nama_lengkap') as $anggota_kelas)
                      <?php $no++; ?>
                      <tr>
                        <td class="text-center">{{$no}}</td>
                        <td>{{$anggota_kelas->siswa->nama_lengkap}}</td>
                        <input type="hidden" name="anggota_kelas_id[]" value="{{$anggota_kelas->id}}">

                        <?php $i = -1; ?>
                        @foreach($data_rencana_penilaian as $rencana_penilaian)
                        <?php $i++; ?>
                        <td>
                          <select class="form-control" name="nilai[{{$i}}][]" style="width: 100%;" required oninvalid="this.setCustomValidity('silakan pilih item dalam daftar')" oninput="setCustomValidity('')">
                            <option value="4">Sangat Baik</option>
                            <option value="3" selected>Baik</option>
                            <option value="2">Cukup</option>
                            <option value="1">Kurang</option>
                          </select>
                        </td>
                        @endforeach

                      </tr>
                      @endforeach
                    </tbody>
  </table>

</body>

</html>