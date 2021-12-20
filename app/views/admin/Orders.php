<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-5">
            <div class="card p-2">
                <table id="example" class="table table-striped" style="">
                    <thead>
                        <tr>
                            <th class="col-sm-1">Sl.No</th>
                            <th class="col-sm-2">Name</th>
                            <th class="col-sm-2">Price</th>
                            <th class="col-sm-3">Email</th>
                            <th class="col-sm-2">Status</th>
                            <th class="col-sm-2">Attack Score</th>
                            <!-- <th class="col-sm-1">Score Details</th> -->
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
                                <td><?= $orderItem->score ?><a class="decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $i ?>" aria-expanded="false" aria-controls="collapseExample<?= $i ?>">View </a></td>
                                <!-- <td></td> -->
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="collapse col-sm-12" id="collapseExample<?= $i ?>">

                                        <div class="col-sm-12">
                                            <div class="row">
                                                <?php foreach ($orderItem->violation as $key => $violationItem) : ?>


                                                    <div class="col-sm-3 px-5" style="border: 1px solid #8080805e;">
                                                        <div class="row text-center">
                                                            <span> <?= ucwords(preg_replace('/(?<!\ )[A-Z]/', ' $0', $key)) ?> Violation</span>
                                                        </div>
                                                        <div class="row text-center pt-2">
                                                            <span><?= $violationItem ?></span>
                                                        </div>

                                                    </div>

                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>