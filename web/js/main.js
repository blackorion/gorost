(function ($, window, document, undefined) {
    $(function () {
        var timer = null;
        var startNumber = 0;
        var $btn = $('#show');
        var $input = $('#num-digits');
        var $panel = $('#possible-values');
        var messenger = new Messenger;
        var validator = new Validator;

        $input.on('input', function () {
            clearInformationPanelAndHide();

            if (timer !== null)
                clearTimeout(timer);

            timer = setTimeout(getAmountOfLuckyNumbers, 500);
        });

        function getAmountOfLuckyNumbers() {
            var numberOfDigits = $input.val();

            if (validator.isValid(numberOfDigits))
                fetchAmountOfLuckyNumbersFor(numberOfDigits)
                    .done(dealAmountOfLuckyNumbersResult);
            else
                messenger.echoError(validator.lastError);
        }

        function fetchAmountOfLuckyNumbersFor(numberOfDigits) {
            return $.getJSON('/api/luckynumbers/' + numberOfDigits + '/amount');
        }

        function isResultHasError(result) {
            return typeof result.error !== "undefined";
        }

        function dealAmountOfLuckyNumbersResult(result) {
            if (isResultHasError(result)) {
                $btn.prop({disabled: true}).data({amount: 0});
                messenger.echoError(result.error);
            }
            else {
                $btn.prop({disabled: false}).data({amount: result.count});
                messenger.echoMessage(result.count);
            }
        }

        $btn.on('click', function () {
            var value = $input.val();
            startNumber = 0;
            clearInformationPanelAndHide();

            if ($btn.data('amount') > 100)
                startScrollListener();

            fetchLuckyNumbersListFor(value)
                .done(dealLuckyNumbersListResult);
        });

        function fetchLuckyNumbersListFor(numberOfDigits) {
            return $.getJSON('/api/luckynumbers/' + numberOfDigits + '/list/' + startNumber);
        }

        function dealLuckyNumbersListResult(result) {
            if (isResultHasError(result))
                messenger.echoError(result.error);
            else {
                startNumber = result.list[result.list.length - 1];
                echoList(result.list);

                if (startNumber == Math.pow(10, $input.val()) - 1)
                    $(window).off('scroll');
            }
        }

        function startScrollListener() {
            $(window).scroll(function () {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                    fetchLuckyNumbersListFor($input.val())
                        .done(dealLuckyNumbersListResult);
                }
            });
        }

        function echoList(list) {
            $panel.removeClass('hidden');
            var $pBody = $panel.find('.panel-body');
            var html = "";

            $.each(list, function (ix, item) {
                html += '<div class="col-sm-3">' + item + '</div>';
            });

            $pBody.append(html);
        }

        function Messenger() {
            this.$el = $('#message');
            this.$formGroup = this.$el.closest('.form-group');
        }

        Messenger.prototype.echoError = function (msg) {
            this.$el.text(msg);
            this.$formGroup.addClass('has-error');
        };

        Messenger.prototype.echoMessage = function (msg) {
            this.$el.text(msg);
            this.$formGroup.removeClass('has-error');
        };

        function Validator() {
            this.lastError = "Колличество разрядов указано не верно";
        }

        Validator.prototype.isValid = function (number) {
            return !(typeof number === "undefined" || number === "");
        };

        function clearInformationPanelAndHide() {
            $panel.addClass('hidden').find('.panel-body').html("");
        }
    });
})(jQuery, window, document);