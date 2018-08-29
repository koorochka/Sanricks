BX.ready(function () {
    /**
     *
     */
    setTimeout(function () {
        sanricksUserRegion.show();
    }, 4000);

});
/**
 * Development tools
 * @param value
 */
function d(value) {
    console.info(value);
}

/**
 * @param url
 */
function link(url) {
    window.location.href = url;
}

/**
 * Sort catalog function
 * @param url
 * @returns {boolean}
 */
function sectionSort() {
    BX("section-sort-component").submit();
    return true;
}

/**
 * @param to
 * @param type
 * @param fn
 */
function addEvent(to, type, fn){
    if(document.addEventListener){
        to.addEventListener(type, fn, false);
    } else if(document.attachEvent){
        to.attachEvent('on'+type, fn);
    } else {
        to['on'+type] = fn;
    }
}

/**
 * quantity counter
 * @param t
 * @param vector
 * @returns {boolean}
 */
function quantityCounter(t, vector) {
    var input = BX.findChild(t,{tagName: 'input'}, true),
        value = input.value;

    BX.focus(input);

    if(vector){
        // plus
        value++;
    }else{
        // minus
        if(value > 1){
            value--;
        }
    }

    input.value = value;
    return value;
}

/**
 * Can fill input solo integer data
 * @param t
 */
function inputIntValidator(t)
{
    var value = parseInt(t.value);
    if(isNaN(value) == true)
    {
        t.value = 1;
    }else{
        t.value = value;
    }
}

/**
 * Can fill input just email data
 * @param t
 * @returns {boolean}
 */
function inputEmailValidator(t)
{
    var value = t.value,
        result = false;
        re = /\S+@\S+\.\S+/;

    // email.indexOf("@") > 0
    if(re.test(value))
    {
        result = true;
    }

    return result;
}

/**
 * Modifie input value by phone pattern
 * @param t
 * @param e
 * @returns {boolean}
 */
function inputPhoneModificator(t, e) {

    // if event is backspace button return
    if(e.keyCode == 8){
        return false;
    }

    // else all buttons is modifire
    var value = t.value,
        length = value.length;
    t.value = result;

    if(length > 15){
        value = value.slice(0, 15);
    }

    var last = value.toString().slice(-1),
        result = value.slice(0, -1);

    last = parseInt(last);

    if(isNaN(last) == true){
        last = 0;
    }

    switch (length){
        case 0:
        case 1:
            result = "(" + last;
            break;
        case 5:
            result += ") " + last;
            break;
        case 10:
        case 13:
            result += "-"+last;
            break;
        default:
            result += last;

    }


    t.value = result;

}