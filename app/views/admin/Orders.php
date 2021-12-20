<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-5">
            <div class="card p-2">
                <table id="example" class="table table-striped" style="">
                    <thead>
                        <tr>
                            <th class="col-sm-1">Sl.No</th>
                            <th class="col-sm-2">Name</th>
                            <th class="col-sm-1">Price</th>
                            <th class="col-sm-2">Email</th>
                            <th class="col-sm-6">Shipping Address</th>
                            <th class="col-sm-1">Status</th>
                            <th class="col-sm-1">Violation</th>
                        </tr>
                    </thead>
                    <tbody> <?php
                            $orderList = $data['orderList'];

                            $i = 1;
                            foreach ($orderList as $key => $orderItem) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $orderItem->name ?></td>
                                <td><?= $orderItem->amount ?></td>
                                <td><?= $orderItem->email ?></td>
                                <td><?= $orderItem->shipAddress ?></td>
                                <td><?= $orderItem->orderStatus ?></td>
                                <td><?= $orderItem->score ?>%<a class="decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $i ?>" aria-expanded="false" aria-controls="collapseExample<?= $i ?>"> + </a></td>
                                <td><button type="button" id="adminEditOrder-<?= $orderItem->id ?>" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Edit
                                    </button></td>
                            </tr>
                            <tr>
                                <td colspan="7" class="px-2">
                                    <div class="collapse col-sm-12 pb-3" id="collapseExample<?= $i ?>">

                                        <div class="col-sm-12">
                                            <div class="row px-1">
                                                <div class="col-sm-3 px-5 border-grey">
                                                    <div class="row text-center">
                                                        <span> Email Structure Violation </span>
                                                    </div>
                                                    <div class="row text-center pt-2">
                                                        <span><?= $orderItem->emailStructureViolation ?>%</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 px-5 border-grey">
                                                    <div class="row text-center">
                                                        <span> Email Domain Violation </span>
                                                    </div>
                                                    <div class="row text-center pt-2">
                                                        <span><?= $orderItem->emailDomainViolation ?>%</span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3 px-5 border-grey">
                                                    <div class="row text-center">
                                                        <span> Fraud Email Violation </span>
                                                    </div>
                                                    <div class="row text-center pt-2">
                                                        <span><?= $orderItem->fraudEmailViolation ?>%</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 px-5 border-grey">
                                                    <div class="row text-center">
                                                        <span> Address Violation </span>
                                                    </div>
                                                    <div class="row text-center pt-2">
                                                        <span><?= $orderItem->addressViolation ?>%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            } ?>
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="col-sm-12 mb-2">
                                        <label for="email">Email </label>
                                        <input type="email" name="email" id="email" class="inputfield py-2 px-2 Input col-sm-12" required>
                                    </div>
                                    <div class="col-sm-12 mt-2" id="shippingAddressDiv">
                                        <label for="shippingLine1"> Address </label>
                                        <div class="col-sm-12 mb-2 ">
                                            <input type="text" name="shippingLine1" id="shippingLine1" placeholder="Address" class="inputfield py-2  px-2 Input col-sm-12" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-2 " id="shippingAddressDiv">
                                        <label for="shippingLine2"> Landmark </label>
                                        <div class="col-sm-12  ">
                                            <input type="text" name="shippingLine2" id="shippingLine2" placeholder="Landmark" class="inputfield py-2  px-2 Input col-sm-12" required>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 mb-2 ">
                                        <div class="row">
                                            <div class="col-sm-6 pr-1">
                                                <label for="shippingCity">City </label>
                                                <input type="text" name="shippingCity" id="shippingCity" placeholder="City" class="inputfield py-2 px-2 Input col-sm-12" required>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <label for="shippingPostalCode">Postal Code </label>
                                                <input type="text" name="shippingPostalCode" placeholder="Postal Code" id="shippingPostalCode" class="inputfield py-2 px-2 Input col-sm-12" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 mb-2">

                                        <label for="shippingState">State </label>
                                        <input type="text" name="shippingState" placeholder="" id="shippingState" class="inputfield py-2 px-2 Input col-sm-12" required>

                                    </div>
                                    <div class="col-sm-12 ">
                                        <label for="shippingCountry">Country </label>
                                        <input type="text" name="shippingCountry" placeholder="" id="shippingCountry" class="inputfield py-2 px-2 Input col-sm-12" required>
                                    </div>
                                    <div class="col-sm-12 py-2">
                                        <input type="submit" name="updateOrder" id="updateOrder" class="btn btn-primary" value="Update">
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>