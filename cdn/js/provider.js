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
        var n = 1500;
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

/**
 * Display Preview while 6-digits
 */
var x;//xhttp request.
function updateHiddenVars() {
    document.getElementById("preview_provider_number").value = document.getElementById("provider_theProvider").value;
    document.getElementById("preview_member_number").value = document.getElementById("provider_theMember").value;
    document.getElementById("preview_service_code").value = document.getElementById("provider_service_code").value;
    document.getElementById("preview_service_comments").value = document.getElementById("provider_service_comments").value;
}
function showPreview() {
    if (x.readyState === XMLHttpRequest.DONE) {
        if (x.status === 200) {
            var preview = document.getElementById("preview");
            preview.parentElement.style.maxWidth = "none";
            preview.srcdoc = x.responseText;
        }
    }
}
function preview() {
    x = new XMLHttpRequest();
    x.onreadystatechange = showPreview; //what to do when data received.
    x.open('POST', '', true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var post = "ajax=true";
    post += "&preview_provider_number=" + document.getElementById("provider_theProvider").value;
    post += "&preview_member_number=" + document.getElementById("provider_theMember").value;
    post += "&preview_service_code=" + document.getElementById("provider_service_code").value;
    post += "&preview_service_comments=" + document.getElementById("provider_service_comments").value;
    x.setRequestHeader("Content-length", post.length);
    x.send(post);
    updateHiddenVars();
}
document.addEventListener('keyup', function () {
    console.log(document.getElementById("provider_service_code").value);
    preview();
});

/**
 * Pad numbers for 6-digit service #
 */
function claimEnter(key) {
    if (key.keyCode == 13) {
        console.log("personEnter(" + key + ") -> pad()");
        key.target.value = pad(key.target.value, 6, 0);
    }
}
function claimBlurred(blur) {
    console.log("claimEnter(" + blur + ") -> pad()");
    blur.target.value = pad(blur.target.value, 6, 0);
}
function claimPadNumbers(element, index, array) {
    if (element) {
        element.addEventListener("blur", claimBlurred);
        element.form.addEventListener("submit", claimBlurred);
        element.addEventListener("keydown", claimEnter);
    }
}
[document.getElementById("provider_service_code")].forEach(claimPadNumbers);

/**
 * Provider Directory button toggles the provider directory.
 */
var provider_report = document.getElementById("provider_report");
var lookup_provider_report = document.getElementById("lookup_provider_directory");
lookup_provider_report.addEventListener("click", function () {
    provider_report.style.display = provider_report.style.display === "block" ? "none" : "block";
});
/**
 * Formats money in the provider directory (C -> $C-(C%100).(C%100)).
 */
var fees = document.getElementsByClassName("fee");
[].forEach.call(document.getElementsByClassName("fee"), function (v, i, a) {
    var cents = v.innerHTML;
    var dollars = (cents / 100).toFixed(2).toString();
    v.innerHTML = "$" + dollars;
});

