<div>
    {{--https://www.fbwebpos.com/fim/est3Dgate--}}
    {{--https://entegrasyon.asseco-see.com.tr/fim/est3Dgate--}}
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