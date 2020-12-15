$(document).ready(function() {
    function sensorsRefrash() {
        if($("div").is($(".sensor-control"))) {
            let $this = $(".sensor-control[data-sensor-topic]");
            let sensors = [];

            $this.map(function (key, value) {
                sensors.push($(value).data('sensor-topic'));
            });

            $.get("/api/mqtt?topics="+sensors, function (data) {
                $.each(data, function( index, value ) {
                    $("span[data-sensor-value='"+index+"']").text(value);
                });
            });

            setTimeout(sensorsRefrash, 10000);
        }
    }

    sensorsRefrash();
});
