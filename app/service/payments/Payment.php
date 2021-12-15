<?php
interface Payment
{
    public function createIntent();
    public function statusUpdate();
}
