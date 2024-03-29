<div class="alert alert-info" role="alert">
    <p class="text-center">You have 10 minutes to complete your purchase!</p>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="text-center">
            <span class="fa fa-cc-mastercard" style="font-size: 42px;"></span>
            <span class="fa fa-cc-visa" style="font-size: 42px;"></span>
        </div>
    </div>
</div>

<div class="col-md-4 col-md-offset-4">
    <form action="https://www.fbwebpos.com/fim/est3Dgate" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="clientid" value="{{ $payment['clientid'] }}">
        <input type="hidden" name="amount" value="{{ $payment['amount'] }}">

        <input type="hidden" name="oid" value="{{ $payment['oid'] }}">
        <input type="hidden" name="okUrl" value="{{ $payment['okUrl'] }}" >
        <input type="hidden" name="failUrl" value="{{ $payment['failUrl'] }}" >
        <input type="hidden" name="islemtipi" value="{{ $payment['islemtipi'] }}" >
        <input type="hidden" name="taksit" value="{{ $payment['taksit'] }}">
        <input type="hidden" name="rnd" value="{{ $payment['rnd'] }}" >
        <input type="hidden" name="hash" value="{{ $payment['hash'] }}" >
        <input type="hidden" name="currency" value="978">

        <input type="hidden" name="storetype" value="3d_pay_hosting" >
        <input type="hidden" name="refreshtime" value="10" >
        <input type="hidden" name="lang" value="tr">

        <input type="submit" class="btn btn-success btn-block" value="PAY NOW">
    </form>
</div>