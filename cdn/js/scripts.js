/**
 * Created by Thomas on 3/12/16.
 */

/**
 * Reload the page without $_POST variables.
 */
function reload() {
    window.location = window.location.href;
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
    if (percent >= 110) {
        reload();
    }
}

function messageAndReload() {
    var message = document.getElementById("message");

    //create .loading bar
    var loading = document.createElement("div");
    loading.className = "loading";
    message.appendChild(loading);

    //remove message after n milliseconds
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


if (document.getElementById("message")) {
    messageAndReload();
}
