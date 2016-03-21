/**
 * Created by Thomas on 3/12/16.
 */

var inputs = document.getElementsByTagName("input");
/*var checkboxes = [];
 var radios = [];*/
for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === "checkbox" || inputs[i].type === "radio") {
        inputs[i].addEventListener('mousedown', function () {
            console.log(this);
        });
    }
}

