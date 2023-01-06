<div class="search">
    <h2>Recherche / Filtres</h2>
    <div>
        <span><b>Recherche : </b></span>
        <input type="text" name="search" id="search" onkeyup="search(this.value);" placeholder="Catégorie, couleur, nom">
    </div>
    <div>
        <span><b>Fourchette de prix : </b></span>
        <section class="range-slider">
            <input value="0" min="0" max="500" step="20" type="range">
            <input value="500" min="0" max="500" step="20" type="range">
        </section>
        <span class="rangeValues"></span>
    </div>
    <div>
        <span><input type="checkbox" id="pntrChk" onchange="document.querySelector('#pntr').style.display = (this.checked) ? '' : 'none'; searchPntr(document.querySelector('#pntrChk').checked, 0); if(!document.querySelector('#pntrChk').checked){document.querySelector('#pntrVal').innerHTML = ''} "><b>Pointure dispo : </b></span>
        <section>
            <input id="pntr" value="40" min="30" max="50" step="0.5" type="range" style="display:none;" oninput="searchPntr(document.querySelector('#pntrChk').checked, this.value); document.querySelector('#pntrVal').innerHTML = (this.value);">
        </section>
        <span id="pntrVal"></span>
    </div>
</div>

<form action="" onsubmit='return false;' method="POST">
<div id="grid" class="grid">
<?php array_map($card, $prdcts); ?>
</div>
</form>


<script>
    var grid = Array.from(document.querySelectorAll("#grid [card]"));
    var $cards = [];
    for (const card of grid) {
        var key = grid.indexOf(card);
        $cards[key] = [true, true, true];
    }

    function search(searchStr) {
    // Declare variables
    var filter, table, tr, td, i, txtValue;
    filter = searchStr.toUpperCase();
    table = document.getElementById("grid");
    cards = table.querySelectorAll("[card]");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
        fltr = false;
        for (const name of ["title","color", "cat"]) {
            const value = cards[i].getAttribute(name);
            if (value.toUpperCase().indexOf(filter) > -1) {
                fltr = true;
            }
        }
        if (fltr) {
            $cards[i][0] = true;
        } else {
            $cards[i][0] = false;
        }
    }

    updateGrid();
    }

    function searchPrice(price1,price2) {
    // Declare variables
    table = document.getElementById("grid");
    cards = table.querySelectorAll("[card]");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
        fltr = false;
        for (const name of ["price"]) {
            const value = cards[i].getAttribute(name);
            if (value >= price1 && value <= price2) {
                fltr = true;
            }
        }
        if (fltr) {
            $cards[i][1] = true;
        } else {
            $cards[i][1] = false;
        }
    }

    updateGrid();
    }

    function searchPntr(checked,pntr) {
    // Declare variables
    table = document.getElementById("grid");
    cards = table.querySelectorAll("[card]");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
        fltr = false;
        if(checked == true) {
            for (const name of ["pntr"]) {
                const value = cards[i].getAttribute(name);

                if ((value.split('|')).includes(pntr)) {
                    fltr = true;
                }
            }
        }else{
            fltr = true;
        }
        if (fltr) {
            $cards[i][2] = true;
        } else {
            $cards[i][2] = false;
        }
    }

    updateGrid();
    }

    function updateGrid(){
        for (i = 0; i < document.querySelectorAll("#grid [card]").length; i++) {
            if (JSON.stringify($cards[i]) == JSON.stringify([true, true, true])){
                document.querySelectorAll("#grid [card]")[i].style.display = "";
            }else{
                document.querySelectorAll("#grid [card]")[i].style.display = "none";
            }
        }
    }
</script>
<script>
    function getVals(){
    // Get slider values
    var parent = this.parentNode;
    var slides = parent.getElementsByTagName("input");
        var slide1 = parseFloat( slides[0].value );
        var slide2 = parseFloat( slides[1].value );
    // Neither slider will clip the other, so make sure we determine which is larger
    if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
    
    var displayElement = document.getElementsByClassName("rangeValues")[0];
        displayElement.innerHTML = slide1 + "$ - " + slide2 + "$";
        searchPrice(slide1, slide2);
    }

    window.onload = function(){
    // Initialize Sliders
    var sliderSections = document.getElementsByClassName("range-slider");
        for( var x = 0; x < sliderSections.length; x++ ){
            var sliders = sliderSections[x].getElementsByTagName("input");
            for( var y = 0; y < sliders.length; y++ ){
            if( sliders[y].type ==="range" ){
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
            }
            }
        }
    }
</script>