// Throttle
(function () {
    document.addEventListener("DOMContentLoaded", function() {
        window.throttle = function(func, wait, leading, trailing, context) {
            let ctx, args, result;
            let timeout = null;
            let previous = 0;
            let later = function() {
                previous = new Date;
                timeout = null;
                result = func.apply(ctx, args);
            };
            return function() {
                let now = new Date;
                if (!previous && !leading) previous = now;
                let remaining = wait - (now - previous);
                ctx = context || this;
                args = arguments;
                if (remaining <= 0) {
                    clearTimeout(timeout);
                    timeout = null;
                    previous = now;
                    result = func.apply(ctx, args);
                } else if (!timeout && trailing) {
                    timeout = setTimeout(later, remaining);
                }
                return result;
            };
        }
    });
})();