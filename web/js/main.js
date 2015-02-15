(function ($, window, document, undefined) {
    var timer = null;

    $('#num-digits').on('input', function () {
        if (timer !== null)
            clearTimeout(timer);

        var $this = $(this);

        timer = setTimeout(function () {
            getAllAvailable($this.val());
        }, 500);
    });

    function echoError(error) {
        $("#error").text(error);
    }

    function echoNumbers(numbers) {

    }

    function getAllAvailable(numberOfDigits) {
        $.getJSON('/api/luckynumbers/' + numberOfDigits, function (result) {
            if (typeof result.error !== "undefined")
                echoError(result.error);
            else
                echoNumbers(result.numbers);
        });
    }
})(jQuery, window, document);