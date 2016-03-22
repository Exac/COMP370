/**
 * Created by Thomas on 3/21/16.
 */
/**
 * Remove the provider_member_validator after the time has gone off.
 *
 * @param pmv_element
 */
function removePMV(pmv_element) {
    if (/invalid/.test(pmv_element.className)) {
        reload();
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
 * Reload the page without $_POST variables.
 */
function reload() {
    window.location = window.location.href;
}
/**
 * Entry point for error display.
 */
function initProvider() {
    //check if #provider_member_validator exists
    var pmv = document.getElementById("provider_member_validator");
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

