(function($) {
    $(document).on('click', '#cb_est_calculate', function(e) {
        e.preventDefault();

        var volume = Number($("#cb_est_volume").val());
        var trades = Number($("#cb_est_trades").val());
        var rate = Number($("#cb_est_rate").val());
        var base = volume * trades * rate;

        $("#cs_est_monthly_earnings").html((base * 210).toFixed(2));
        $("#cs_est_yearly_earnings").html((base * 2520).toFixed(2));
    });

    $(document).on('click', '.faq-list h3.sublabel', function(e) {
    	e.preventDefault();
    	$(this).next().slideToggle();
    });
})(jQuery);
