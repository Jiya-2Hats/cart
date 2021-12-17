<div class="container">
    <div class="row">
        <div class="col-sm-12 pt-5">
            <div class=" p-2 row">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="<?= BASE_URL ?>/admin/saveMailList" method="POST">
                            <div class="col-sm-12 mt-2">
                                <label for="emailList">Email List</label>
                                <div class="col-sm-12 my-2 ">
                                    <textarea type="text" name="emailList" id="emailList" rows="1" class="col-sm-12 inputfield"><?= $data['emailList'] ?></textarea>
                                </div>
                            </div>
                            <input type="submit" name="submitList" id="submitList" value="Submit">
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form action="<?= BASE_URL ?>/admin/savekey" class="col-sm-12" method="POST">
                            <div class="col-sm-12 mt-2">
                                <label for="key"> Key</label>
                                <div class="col-sm-12 my-2">

                                    <input type="text" name="key" id="key" placeholder="Google API Key" class="col-sm-12 inputfield px-2 py-2" value="<?= $data['apiKey']->apiKey ?>" required>
                                </div>
                            </div>
                            <input type="submit" name="submitKey" id="submitKey" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>