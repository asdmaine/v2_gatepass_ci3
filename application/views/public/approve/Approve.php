<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Approve - Gatepass</title>

</head>

<body>
  <main class="content px-4 py-4">
    <div class="container-fluid">
      <div class="mb-5 text-center text-uppercase">
        <h4>Approve</h4>
      </div>
      <div>

        <!-- konversi data progress -->
        <div class="table-responsive">
          <h6 class="text-center text-uppercase mb-3"></h6>
          <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
              <tr>
                <td scope="col">#</td>
                <td scope="col">Date</td>
                <td scope="col">Requested by</td>
                <td scope="col">Recommended by</td>
                <td scope="col">Approved by</td>
                <td scope="col">Acknowledged by</td>
                <td scope="col">Action</td>
              </tr>
            </thead>
            <tbody>

              <!-- SHOW -->
              <?php $i = 1;
                foreach ($Progress as $pg) {
                  if (empty($pg->id_gatepass)) { ?>
                  <tr class="text">
                    <th class="text-center align-middle text-uppercase" colspan="7">no data to be shown</th>
                  </tr>
                  <?php } else {
                    if($pg->recommendedby_pst_pnr == $this->logindata['user']['pst_pnr']){
                      $as = 'recommended';
                    }elseif($pg->approvedby_pst_pnr == $this->logindata['user']['pst_pnr']){
                      $as = 'approved';
                    }elseif($pg->acknowledgedby_pst_pnr == $this->logindata['user']['pst_pnr']){
                      $as = 'acknowledged';
                    }
                    
                    $recommended_name = $pg->recommended_name;
                    $approved_name = $pg->approved_name;
                    $acknowledged_name = $pg->acknowledged_name;
                    
                    ?>
                    <tr class="text">
                  <th class="text-center align-middle">
                    <?= $i?>
                  </th>
                  <td class="text-center align-middle">
                    <?= $pg->tanggal_gatepass ?>
                  </td>
                  <td class="align-middle text-uppercase">
                    <?= $pg->requestedby_pst_name ?>
                  </td>
                  <!-- RECOMMENDED -->
                  <td class="text-center">
                    <?php if ($pg->status_recommended == 1) { ?>
                      <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0" data-trigger="focus"
                      data-content="<?php $content_recommended = 'Accepted by ' . $pg->recommended_name . ' at ' . $pg->verif_date_recommendedby;
                        echo $content_recommended; ?> ">
                        Accepted</div>
                    <?php } elseif ($pg->status_recommended == 0) {
                      $pg->status_approved = 0;
                      $pg->approved_name = $pg->recommended_name;
                      $pg->verif_date_approvedby = $pg->verif_date_recommendedby;
                      $pg->status_acknowledged = 0;
                      $pg->acknowledged_name = $pg->recommended_name;
                      $pg->verif_date_acknowledgedby = $pg->verif_date_recommendedby;
                      ?>
                      <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_recommended = 'Still waiting ' . $pg->recommended_name;
                        echo $content_recommended;
                        $content_approved = $content_recommended;
                        $content_acknowledged = $content_recommended; ?>">Waiting</div>
                    <?php } elseif ($pg->status_recommended == -1) {
                      $pg->status_approved = -1;
                      $pg->approved_name = $pg->recommended_name;
                      $pg->verif_date_approvedby = $pg->verif_date_recommendedby;
                      $pg->status_acknowledged = -1;
                      $pg->acknowledged_name = $pg->recommended_name;
                      $pg->verif_date_acknowledgedby = $pg->verif_date_recommendedby;
                      ?>
                      <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_recommended = 'Rejected by ' . $pg->recommended_name . ' at ' . $pg->verif_date_recommendedby;
                        echo $content_recommended;
                        $content_approved = $content_recommended;
                        $content_acknowledged = $content_recommended; ?>">
                        Rejected</div>
                    <?php } ?>
                  </td>
                  <!-- END RECOMMENDED -->

                  <!-- APROVED -->
                  <td class="text-center">
                    <?php if ($pg->status_approved == 1) { ?>
                      <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0" 
                        data-trigger="focus" data-content="<?php $content_approved = 'Accepted by ' . $pg->approved_name . ' at ' . $pg->verif_date_approvedby;
                        echo $content_approved; ?>">
                        Accepted</div>
                    <?php } elseif ($pg->status_approved == 0) {
                      $pg->status_acknowledged = 0;
                      $pg->acknowledged_name = $pg->approved_name;
                      $pg->verif_date_acknowledgedby = $pg->verif_date_approvedby;
                      ?>
                      <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_approved = 'Still waiting ' . $pg->approved_name;
                        echo $content_approved;
                        $content_acknowledged = $content_approved; ?>">
                        Waiting</div>
                    <?php } elseif ($pg->status_approved == -1) {
                      $pg->status_acknowledged = -1;
                      $pg->acknowledged_name = $pg->approved_name;
                      $pg->verif_date_acknowledgedby = $pg->verif_date_approvedby;
                      ?>
                      <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_approved = 'Rejected by ' . $pg->approved_name . ' at ' . $pg->verif_date_approvedby;
                        echo $content_approved;
                        $content_acknowledged = $content_approved; ?>">
                        Rejected</div>
                    <?php } ?>
                  </td>
                  <!-- END APPROVED -->

                  <!-- ACKNOWLEDGED -->
                  <td class="text-center">
                    <?php if ($pg->status_acknowledged == 0) { ?>
                      <div class="btn btn-secondary" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_acknowledged = 'Still waiting ' . $pg->acknowledged_name;
                        echo $content_acknowledged; ?>">
                        Waiting</div>
                    <?php } elseif ($pg->status_acknowledged == 1) { ?>
                      <div class="btn btn-success" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_acknowledged = 'Accepted by ' . $pg->acknowledged_name . ' at ' . $pg->verif_date_acknowledgedby;
                        echo $content_acknowledged; ?>">
                        Accepted</div>
                    <?php } elseif ($pg->status_acknowledged == -1) { ?>
                      <div class="btn btn-danger" data-toggle="popover" data-placement="bottom" tabindex="0"
                        data-trigger="focus" data-content="<?php $content_acknowledged = 'Rejected by ' . $pg->acknowledged_name . ' at ' . $pg->verif_date_acknowledgedby;
                        echo $content_acknowledged; ?>">
                        Rejected</div>
                    <?php } ?>
                  </td>
                  <!-- END ACKNOWLEDGED -->
                  <td class="text-center spacing-2">
                    <div class="btn btn-info m-1" data-toggle="modal" data-target=".ModalDetail<?= $i ?>"><i
                        class="fa-solid fa-circle-info"></i></div>
                        <a class="btn btn-success m-1 text-light" href="<?= base_url("approve/do_approve/1/".$pg->id_verifikasi)."/".$as ?>"><i
                        class="fa-solid fa-check fa-lg"></i></a>
                        <a class="btn btn-danger m-1 text-light" href="<?= base_url("approve/do_approve/-1/".$pg->id_verifikasi)."/".$as ?>"><i
                        class="fa-solid fa-x fa-lg"></i></a>
                        <a class="btn btn-secondary m-1 text-light" href="<?= base_url("approve/do_approve/0/".$pg->id_verifikasi)."/".$as ?>"><i
                        class="fa-regular fa-clock fa-lg"></i></a>
                  </td>
                </tr>
                  <!-- modal detail -->
                  <div class="modal fade ModalDetail<?= $i ?>" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content px-4">
                        <div class="modal-header">
                          <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Detail Gatepass</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group mb-4">
                              <label for="tanggal" class="col-form-label font-weight-bold">Tanggal</label>
                              <input type="date" class="form-control w-50" id="tanggal" value="<?= $pg->tanggal_gatepass ?>"
                                disabled>
                            </div>
                            <div class="form-group mb-4 ">
                              <label class="form-label font-weight-bold">Keperluan</label><br>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="<?= $pg->keperluan ?>"
                                  value="<?= $pg->keperluan ?>" disabled checked>
                                <label class="form-check-label" for="<?= $pg->keperluan ?>">Urusan
                                  Perusahaan&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label for="penjelasan" class="form-label font-weight-bold">Penjelasan</label>
                              <textarea class="form-control" id="penjelasan" style="height: 100px"
                                disabled><?= $pg->penjelasan_keperluan ?></textarea>
                            </div>
                            <div class="form-group mb-4">
                              <label class="form-label font-weight-bold">Perkiraan Waktu</label><br>
                              <div class="input-group mb-1">
                                <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Keluar"
                                  disabled>
                                <input class="form-control" type="time" id="est_time_out" value="<?= $pg->est_time_out ?>"
                                  disabled>
                              </div>
                              <div class="input-group mb-4">
                                <input type="text" class="form-control text-light" placeholder="Perkiraan Jam Masuk"
                                  disabled>
                                <input class="form-control" type="time" id="est_time_in" value="<?= $pg->est_time_in ?>"
                                  disabled>
                              </div>
                            </div>
                            <div class="form-group mb-4">
                              <label class="form-label font-weight-bold">Pengesahan</label><br>
                              <div class="input-group">
                                <div class="input-group mb-1">
                                  <div class="input-group overflow-scroll">
                                    <div class="input-group-prepend w-100">
                                      <input type="text" class="input-group-text w-25" value="Requested By" disabled>
                                      <input type="text" class="input-group-text w-75 text-left"
                                        value="<?= $pg->requestedby_pst_name ?>" disabled>
                                    </div>

                                  </div>
                                </div>
                                <div class="input-group mb-1">
                                  <div class="input-group overflow-scroll">
                                    <div class="input-group-prepend w-50">
                                      <input type="text" class="input-group-text w-50" value="Recommended By" disabled>
                                      <input type="text" class="input-group-text w-50 text-left"
                                        value="<?= $recommended_name ?>" disabled>
                                    </div>
                                    <input type="text" class="form-control overflow-scroll"
                                      value="<?= $content_recommended ?>" disabled>
                                  </div>
                                </div>
                                <div class="input-group mb-1">
                                  <div class="input-group overflow-scroll container-lg">
                                    <div class="input-group-prepend w-50">
                                      <input type="text" class="input-group-text w-50" value="Approved By" disabled>
                                      <input type="text" class="input-group-text w-50 text-left"
                                        value="<?= $approved_name ?>" disabled>
                                    </div>
                                    <input type="text" class="form-control overflow-scroll" value="<?= $content_approved ?>"
                                      disabled>
                                  </div>
                                  </select>

                                </div>
                                <div class="input-group mb-4">
                                  <div class="input-group overflow-scroll">
                                    <div class="input-group-prepend w-50">
                                      <input type="text" class="input-group-text w-50" value="Acknowledged By" disabled>
                                      <input type="text" class="input-group-text w-50 text-left"
                                        value="<?= $acknowledged_name ?>" disabled>
                                    </div>
                                    <input type="text" class="form-control overflow-scroll"
                                      value="<?= $content_acknowledged ?>" disabled>
                                  </div>
                                </div>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
                  $i++;
                } ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </main>





  <!-- punya header -->
  </div>
  </div>

  <script>
    // untk datatables
    new DataTable('#example');
  </script>
</body>


</html>