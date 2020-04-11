
window.FontAwesomeKitConfig = {"asyncLoading":{"enabled":true},"autoA11y":{"enabled":true},"baseUrl":"https://kit-free.fontawesome.com","license":"free","method":"css","minify":{"enabled":true},"v4shim":{"enabled":false},"version":"latest"};
!function(){!function(){if(!(void 0===window.Element||"classList"in document.documentElement)){var e,t,n,i=Array.prototype,o=i.push,a=i.splice,s=i.join;r.prototype={add:function(e){this.contains(e)||(o.call(this,e),this.el.className=this.toString())},contains:function(e){return-1!=this.el.className.indexOf(e)},item:function(e){return this[e]||null},remove:function(e){if(this.contains(e)){for(var t=0;t<this.length&&this[t]!=e;t++);a.call(this,t,1),this.el.className=this.toString()}},toString:function(){return s.call(this," ")},toggle:function(e){return this.contains(e)?this.remove(e):this.add(e),this.contains(e)}},window.DOMTokenList=r,e=Element.prototype,t="classList",n=function(){return new r(this)},Object.defineProperty?Object.defineProperty(e,t,{get:n}):e.__defineGetter__(t,n)}function r(e){for(var t=(this.el=e).className.replace(/^\s+|\s+$/g,"").split(/\s+/),n=0;n<t.length;n++)o.call(this,t[n])}}();function f(e){var t,n,i,o;prefixesArray=e||["fa"],prefixesSelectorString="."+Array.prototype.join.call(e,",."),t=document.querySelectorAll(prefixesSelectorString),Array.prototype.forEach.call(t,function(e){n=e.getAttribute("title"),e.setAttribute("aria-hidden","true"),i=!e.nextElementSibling||!e.nextElementSibling.classList.contains("sr-only"),n&&i&&((o=document.createElement("span")).innerHTML=n,o.classList.add("sr-only"),e.parentNode.insertBefore(o,e.nextSibling))})}var e,t,u=function(e){var t=document.createElement("link");t.href=e,t.media="all",t.rel="stylesheet",document.getElementsByTagName("head")[0].appendChild(t)},m=function(e){!function(e,t,n){var i,o=window.document,a=o.createElement("link");if(t)i=t;else{var s=(o.body||o.getElementsByTagName("head")[0]).childNodes;i=s[s.length-1]}var r=o.styleSheets;a.rel="stylesheet",a.href=e,a.media="only x",function e(t){if(o.body)return t();setTimeout(function(){e(t)})}(function(){i.parentNode.insertBefore(a,t?i:i.nextSibling)});var l=function(e){for(var t=a.href,n=r.length;n--;)if(r[n].href===t)return e();setTimeout(function(){l(e)})};function c(){a.addEventListener&&a.removeEventListener("load",c),a.media=n||"all"}a.addEventListener&&a.addEventListener("load",c),(a.onloadcssdefined=l)(c)}(e)},n=function(e,t){var n=t&&void 0!==t.autoFetchSvg?t.autoFetchSvg:void 0,i=t&&void 0!==t.async?t.async:void 0,o=t&&void 0!==t.autoA11y?t.autoA11y:void 0,a=document.createElement("script"),s=document.scripts[0];a.src=e,void 0!==o&&a.setAttribute("data-auto-a11y",o?"true":"false"),n&&(a.setAttributeNode(document.createAttribute("data-auto-fetch-svg")),a.setAttribute("data-fetch-svg-from",t.fetchSvgFrom)),i&&a.setAttributeNode(document.createAttribute("defer")),s.parentNode.appendChild(a)};function h(e,t){var n=t&&t.shim?e.license+"-v4-shims":e.license,i=t&&t.minify?".min":"";return e.baseUrl+"/releases/"+("latest"===e.version?"latest":"v".concat(e.version))+"/"+e.method+"/"+n+i+"."+e.method}try{if(window.FontAwesomeKitConfig){var i=window.FontAwesomeKitConfig;"js"===i.method&&(t={async:(e=i).asyncLoading.enabled,autoA11y:e.autoA11y.enabled},"pro"===e.license&&(t.autoFetchSvg=!0,t.fetchSvgFrom=e.baseUrl+"/releases/"+("latest"===e.version?"latest":"v".concat(e.version))+"/svgs"),e.v4shim.enabled&&n(h(e,{shim:!0,minify:e.minify.enabled})),n(h(e,{minify:e.minify.enabled}),t)),"css"===i.method&&function(e){var t,n,i,o,a,s,r,l,c=f.bind(f,["fa","fab","fas","far","fal"]);e.autoA11y.enabled&&(n=c,o=[],a=document,s=a.documentElement.doScroll,r="DOMContentLoaded",(l=(s?/^loaded|^c/:/^loaded|^i|^c/).test(a.readyState))||a.addEventListener(r,i=function(){for(a.removeEventListener(r,i),l=1;i=o.shift();)i()}),l?setTimeout(n,0):o.push(n),t=c,"undefined"!=typeof MutationObserver&&new MutationObserver(t).observe(document,{childList:!0,subtree:!0})),e.v4shim.enabled&&(e.asyncLoading.enabled?m(h(e,{shim:!0,minify:e.minify.enabled})):u(h(e,{shim:!0,minify:e.minify.enabled})));var d=h(e,{minify:e.minify.enabled});e.asyncLoading.enabled?m(d):u(d)}(i)}}catch(e){}}();


$(function () {
    $('#form-data').submit(function (e) {
        var guestId;
        var selObj2 = document.getElementById('cardIsPicked2');
        var txtValueObj2 = document.getElementById('txtValue2');
        var selIndex2 = selObj2.selectedIndex;
        var guestCardID2 = txtValueObj2.value = selObj2.options[selIndex2].value;
        var route = $('#form-data').data('route');
        var form_data = $(this);
        var name = document.getElementById("unexpectedGuest").value;
        $.ajax({
            type: 'post' ,
            url: "/ajaxRequest/" + name,
            data: form_data.serialize(),
            success: function(data) {
                alert("første trin er udført" + data + "" + guestCardID2);
                var route = $('#form-data-Put').data('route');
                var form_data_put = $(this);
                $.ajax({
                    type: 'put' ,
                    url: '/ajaxRequest/' + data +"/" + guestCardID2 +  '/edit',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: form_data_put.serialize(),
                    success: function(data) {
                        alert("Du er checket ind");
                        callBackFunction()
                    }
                });
            },
        });
        e.preventDefault();

    })
});


function  openSearchField(){
        $('.search-button').parent().toggleClass('open');
    }

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}



function callBackFunction() {
    window.location = "guestsRegistration";
}

function quickCheckIn( id, card  )
{
    alert(id + "" + card);
    document.getElementById('executeCheckIn').action = "guests/"+id +"/" + card + "/edit";
}

function showSelected( id )
{
    var selObj = document.getElementById('cardIsPicked');
    var txtValueObj = document.getElementById('txtValue');
    var selIndex = selObj.selectedIndex;
    var guestCardID = txtValueObj.value = selObj.options[selIndex].value;
    document.getElementById('executeCheckIn').action = "guests/"+id +"/" + guestCardID + "/edit";
}

function chosenCard() {
    document.getElementById("showCard").style.display= "block";
    document.getElementById("hideCard").style.display="none";
}

function searchForGuest() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
    if (document.getElementById("checkInOpen").style.display == ""){
        table = document.getElementById("searchIn");
        input = document.getElementById("guestInputCheckIn");
    }else if (document.getElementById("guestInputCheckOut").style.display == "block"){
        table = document.getElementById("searchOut");
        input = document.getElementById("guestInputCheckOut");
    }
    filter = input.value.toUpperCase();
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
                table.style.display="";
                tr[i].style.display = "";

            } else {
                tr[i].style.display = "none";
            }
        }
    }
    checkBox()
}


function checkBox() {
    if (document.getElementById("guestInputCheckIn").value == '' ){
        document.getElementById("searchIn").style.display = "none";
    }if (document.getElementById("guestInputCheckOut").value == ''){
        document.getElementById("searchOut").style.display = "none";

    }
}
function checkIn() {
    document.getElementById("checkInOpen").style.display ="";
    document.getElementById("guestsCheckIn").style.display ="block";
    document.getElementById("inputBoxes").style.display ="";
    document.getElementById("unexpected1").style.display ="";
    setTimeout(openSearchField, 100 );
    document.getElementById("checkButtons").style.display ="none";
    document.getElementById("guestInputCheckOut").style.display ="none";
}
function checkOut() {
    document.getElementById("guestInputCheckOut").style.display ="block";
    document.getElementById("guestsCheckOut").style.display ="block";
    document.getElementById("guestInputCheckIn").style.display ="none";
    document.getElementById("inputBoxes").style.display ="";
    document.getElementById("checkOutOpen").style.display ="";
    setTimeout(openSearchField, 500 );
    document.getElementById("checkInOpen").style.display ="none";
    document.getElementById("checkButtons").style.display ="none";
}

function checkInUnExpectedGuests() {
    document.getElementById('executeCheckIn').style.display = 'none';
    document.getElementById('inputBoxes').style.display = 'none';
    document.getElementById('divForUnregisteredGuests').style.display = '';
}

function goToGuestRegistration() {
    window.location = "registerGuest";
}
function guestOverview() {
    window.location = "guests";
}
function guestPage() {
    window.location = "guestsRegistration";
}



function reBooK(){
    document.getElementById("newGuests").style.display = "none";
    document.getElementById("formerGuests").style.display = "";
    document.getElementById("formerGuestsTable").style.display = "";
}
function setName(guestName, guestId) {
    document.getElementById("nameInput").value = guestName;
    document.getElementById("guestId").value = guestId;
}
function executeBooking(){
    var name = document.getElementById("nameInput").value;
    var id = document.getElementById("guestId").value;
    document.getElementById('formNewBooking').action = "guests/"+ id +"/0000/edit";
}




function findGuest() {
    // Declare variables
    var input, table, filter, tr, td, i, txtValue ;
    table = document.getElementById("searcGuests");
    input = document.getElementById("searchForGuest");
    filter = input.value.toUpperCase();
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
                tr[i].style.display = "";

            } else {
                tr[i].style.display = "none";
            }
        }
    }

}


function arrived() {
    var showArrivedTable = document.getElementById("arrived");
    var showExpectedTable = document.getElementById("expected");
    var showDepartedTable = document.getElementById("departed");

    showExpectedTable.style.display = "none";
   // filterBoxExpected.style.display = "none";

    showDepartedTable.style.display = "none";
    //filterBoxDeparted.style.display = "none";

    showArrivedTable.style.display = "table";
    //filterBoxArrived.style.display = "";
}


function departed() {
    alert("Dette er en test");
    var showArrivedTable = document.getElementById("arrived");
    var showExpectedTable = document.getElementById("expected");
    var showDepartedTable = document.getElementById("departed");

    showArrivedTable.style.display = "none";
    //filterBoxArrived.style.display = "none";

    showExpectedTable.style.display = "none";
    //filterBoxExpected.style.display = "none";

    showDepartedTable.style.display = "table";
    //filterBoxDeparted.style.display = "";
}

function expected() {
    alert("Dette er en test");
    var showArrivedTable = document.getElementById("arrived");
    var showExpectedTable = document.getElementById("expected");
    var showDepartedTable = document.getElementById("departed");
    //   var filterBoxArrived     = document.getElementById("guestInputArrivedDiv");
   // var filterBoxDeparted = document.getElementById("guestInputDepartedDiv");
    showArrivedTable.style.display = "none";
    //filterBoxArrived.style.display = "none";
    showDepartedTable.style.display = "none";
    //filterBoxDeparted.style.display = "none";
    showExpectedTable.style.display = "table";
    //ilterBoxExpected.style.display = "";
}

function findGuests() {
    var table;
    var expected = document.getElementById("expected");
    var arrived = document.getElementById("arrived");
    var departed = document.getElementById("departed");
    // Declare variables
    if (expected.style.display == "none" && arrived.style.display == "none" ){
        table = departed;
    } else if ( arrived.style.display == "none" && departed.style.display == "none" ){
        table = expected;
    } else if (departed.style.display == "none" && expected.style.display == "none"){
        table = arrived;
    }else {
        alert("Noget gik galt ");
        window.location = "guests";
    }
    var input, filter, tr, td, i, txtValue;
    input = document.getElementById("input-box");
    filter = input.value.toUpperCase();
    tr = table.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


/* Dette er tidligere brug af filtre
function findGuestArrived( ) {
    var showArrived = document.getElementById("arrived");
    // Declare variables
    var input, filter, tr, td, i, txtValue;
    input = document.getElementById("input-box");
    filter = input.value.toUpperCase();
    tr = showArrived.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function findGuestDeparted( ) {
    var showDeparted = document.getElementById("input-box");
    // Declare variables
    var input, filter, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    tr = showDeparted.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

*/







