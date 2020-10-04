$(document).ready(function() {

    function sensorsRefrash() {
        if($("div").is($(".sensor-control"))) {
            let $this = $(".sensor-control[data-sensor-topic]");
            $this.map(function (key, value) {
                let topic = $(value).data('sensor-topic');
                $.get("/api/mqtt?topic="+topic, function (data) {
                    $("span[data-sensor-value='"+topic+"']").text(data['payload']);
                });
            });

            setTimeout(sensorsRefrash, 10000);
        }
    }

    sensorsRefrash();
    // $.get("/api/mqtt?topic=margulis/temperature", function (data) {
    //     console.log(data);
    // });

});
