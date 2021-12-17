<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-5">
            <div class="card p-2">
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Attack Score</th>
                            <!-- <th>Score Details</th> -->
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
                                <td><?= $orderItem->score ?></td>
                                <!-- <td><a href="<?= BASE_URL ?>/admin/viewScore">View </a></td> -->
                            </tr>
                        <?php
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>