/**
 * Created by Thomas on 3/21/16.
 */
/**
 * Remove the validator after the time has gone off.
 *
 * @param pmv_element
 */
function removePMV(pmv_element) {
    if (/invalid/.test(pmv_element.className)) {
        emergency_reload();
        setTimeout(function () {
            alert("failed, reloading.");
            reload();
        }, 1640);
    } else {
        pmv_element.remove();
    }
}

/**
 * Update the loading bar's progress along the screen
 *
 * @param initialTime float Time page loaded
 * @param n float time pmv_element will be displayed
 * @param loading Element The loading bar element.
 */
function updateLoading(initialTime, n, loading) {
    var c = new Date();
    var percent = 10 + ((c.getTime() - initialTime) / n * 100);
    loading.style.width = percent + "%";
    //cool bottom-up wipe
    if (percent >= 100) {
        loading.style.backgroundImage = "linear-gradient(to bottom, rgba(255,255,255,0.95), rgba(255,255,255,0.100));";
        loading.style.transitionDelay = "200ms";
        loading.style.width = "1000%";
        loading.style.height = "125%";
    }
}
/**
 * If we can reload to same page we will.
 */
function emergency_reload() {
    var ptp = document.getElementById("provider_theProvider");
    if (ptp) {
        ptp.id = "provider_password";
        ptp.name = "provider_password";

        var pin = document.getElementById("provider_invalid");

        pin.submit();
    } else {
        console.log(ptp);
        console.log("failed to select ptp or pmv");
    }
}
/**
 * Entry point for error display.
 */
function initProvider() {
    //check if #validator exists
    var pmv = document.getElementById("validator");
    if (pmv === null) {
        //Does not exist
    } else {
        //create .loading bar
        var loading = document.createElement("div");
        loading.className = "loading";
        pmv.appendChild(loading);

        //remove pmv after n milliseconds
        var n = 3500;
        setTimeout(function () {
            removePMV(pmv);
        }, n);

        //update loading bar every frame
        var startTime = new Date().getTime();
        setInterval(function () {
            updateLoading(startTime, n, loading);
        }, 100);
    }
}

initProvider();

/**
 * Unsafe to use for math! Numbers longer than 9 digits will be truncated!
 *
 * @param nu number
 * @param width Number of chars to pad until.
 * @param z char to pad with (default 0)
 * @returns {string}
 */
function pad(nu, width, z) {
    console.log(nu);
    if (nu.toString().length <= width) {
        z = z || '0';
        nu = nu + '';
        return nu.length >= width ? nu : new Array(width - nu.length + 1).join(z) + nu;
    } else {
        //if the input is longer than the width, try again without leading-zeros,
        //then cut the number down.
        console.log("nu internal else");
        return pad(parseInt(nu, 10).toString().substr(0, width), width, z);
    }
}
function personEnter(key) {
    if (key.keyCode == 13) {
        console.log("personEnter(" + key + ") -> pad()");
        key.target.value = pad(key.target.value, 9, 0);
    }
}
function personBlurred(blur) {
    console.log("personEnter(" + blur + ") -> pad()");
    blur.target.value = pad(blur.target.value, 9, 0);
}
function personPadNumbers(element, index, array) {
    if (element) {
        element.addEventListener("blur", personBlurred);
        element.form.addEventListener("submit", personBlurred);
        element.addEventListener("keydown", personEnter);
    }
}

[
    document.getElementById("provider_password"),
    document.getElementById("provider_verify_member")
].forEach(personPadNumbers);
