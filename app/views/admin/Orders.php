<link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/bootstrap/twitter/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/app/assets/css/bootstrap/datatables/dataTables.bootstrap5.min.css">

<script src="<?= BASE_URL ?>/app/assets/css/bootstrap/datatables/jquery-3.5.1.js"></script>
<script src="<?= BASE_URL ?>/app/assets/css/bootstrap/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>/app/assets/css/bootstrap/datatables/dataTables.bootstrap5.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-5">
            <div class="card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Email</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody> <?php
                            $orderList = $data['orderList'];
                            $i = 1;
                            foreach ($orderList as $orderItem) { ?>
                            <tr>

                                <td><?= $i++ ?></td>
                                <td><?= $orderItem->name ?></td>
                                <td><?= $orderItem->amount ?></td>
                                <td><?= $orderItem->email ?></td>
                                <td><?= $orderItem->orderStatus ?></td>



                            </tr>
                        <?php
                            } ?>




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>