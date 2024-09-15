@extends('layouts.master')
@section('title', 'Kur Dönüştürücü')
@section('content')
<div class="container">
       <h1>Kur Dönüştürücü</h1>
       <div class="mb-3">
           <label for="amount" class="form-label">Miktar</label>
           <input name="amount" id="amount" class="form-control" type="number" min="0" value="1">
       </div>

       <div class="row">
           <div class="col select-box">
               <label for="base_currency">1. Para Birimi</label>
               <select class="form-control" id="base_currency">
                   <option>AUD</option>
                   <option>BGN</option>
                   <option>BRL</option>
                   <option>CAD</option>
                   <option>CHF</option>
                   <option>CNY</option>
                   <option>CZK</option>
                   <option>DKK</option>
                   <option>EUR</option>
                   <option>GBP</option>
                   <option>HKD</option>
                   <option>HRK</option>
                   <option>HUF</option>
                   <option>IDR</option>
                   <option>ILS</option>
                   <option>INR</option>
                   <option>ISK</option>
                   <option>JPY</option>
                   <option>KRW</option>
                   <option>MXN</option>
                   <option>MYR</option>
                   <option>NOK</option>
                   <option>NZD</option>
                   <option>PHP</option>
                   <option>PLN</option>
                   <option>RON</option>
                   <option>RUB</option>
                   <option>SEK</option>
                   <option>SGD</option>
                   <option>THB</option>
                   <option>TRY</option>
                   <option selected>USD</option>
                   <option>ZAR</option>
               </select>
           </div>

           <div class="col select-box">
               <label for="currency">2. Para Birimi</label>
               <select class="form-control" id="currency">
                   <option>AUD</option>
                   <option>BGN</option>
                   <option>BRL</option>
                   <option>CAD</option>
                   <option>CHF</option>
                   <option>CNY</option>
                   <option>CZK</option>
                   <option>DKK</option>
                   <option>EUR</option>
                   <option>GBP</option>
                   <option>HKD</option>
                   <option>HRK</option>
                   <option>HUF</option>
                   <option>IDR</option>
                   <option>ILS</option>
                   <option>INR</option>
                   <option>ISK</option>
                   <option>JPY</option>
                   <option>KRW</option>
                   <option>MXN</option>
                   <option>MYR</option>
                   <option>NOK</option>
                   <option>NZD</option>
                   <option>PHP</option>
                   <option>PLN</option>
                   <option>RON</option>
                   <option>RUB</option>
                   <option>SEK</option>
                   <option>SGD</option>
                   <option>THB</option>
                   <option selected>TRY</option>
                   <option>USD</option>
                   <option>ZAR</option>
               </select>
           </div>
       </div>

       <p class="result"></p>

    <div class="exchange-rate-bar">
        <h2>USD / TRY: <span id="usd-rate">-</span></h2>
        <h2>EUR / TRY: <span id="eur-rate">-</span></h2>
        <h2>PLN / TRY: <span id="pln-rate">-</span></h2>
    </div>
</div>
    <script type = "text/javascript">
        $(document).ready(function () {
            convert();
            updateRates()

        });

        var previousUsdRate = null;
        var previousEuroRate = null;
        var previousPlnRate = null;
        function updateRates() {
            $.ajax({
                type: 'GET',
                url: '{{route('instant')}}',
                success: function (data) {
                    var usdRate = data.usd;
                    var eurRate = data.euro;
                    var plnRate = data.pln;

                    updateRate('#usd-rate', usdRate, previousUsdRate);
                    updateRate('#eur-rate', eurRate, previousEuroRate);
                    updateRate('#pln-rate', plnRate, previousPlnRate);

                    previousUsdRate = usdRate;
                    previousEuroRate = eurRate;
                    previousPlnRate = plnRate;
                }
            });
        }

        function updateRate(selector, newRate, previousRate) {
            var rateElement = $(selector);
            rateElement.text(newRate);

            if (previousRate !== null) {
                if (newRate > previousRate) {
                    rateElement.removeClass('down').addClass('up');
                    setTimeout(function() {
                        rateElement.removeClass('up');
                    }, 1000);
                } else if (newRate < previousRate) {
                    rateElement.removeClass('up').addClass('down');
                    setTimeout(function() {
                        rateElement.removeClass('down');
                    }, 1000);
                }
            }
        }

        setInterval(updateRates, 10000);


        $('#amount, #base_currency, #currency').on('input change', function () {
            convert();
        });

        function convert() {
            var base_currency = $('#base_currency').val();
            var currency = $('#currency').val();
            var amount = $('#amount').val();

            $.ajax({
                type: 'GET',
                url: '{{route('currency')}}',
                data: {
                    base_currency: base_currency,
                    currency: currency,
                    amount: amount,
                },
                success: function (data) {
                    if (data === '') {
                        $('.result').html(``);
                    } else {
                        $('.result').html(`${amount} ${base_currency} = ${data} ${currency}`);
                    }
                }
            });
        }
    </script>
@endsection
