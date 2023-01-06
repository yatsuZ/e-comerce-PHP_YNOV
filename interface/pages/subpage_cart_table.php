<script>
    $(document).ready(function(){
        dt = "";
        setInterval(() => {
            $.get("/subpage_cart_table_back", function(data) {
                if(dt != data){
                    dt = data;
                    $("#cart table").html(JSON.parse(dt)['table']);
                    $("#pagar>span").html(JSON.parse(dt)['total']);
                }
            });
        }, 1000);
    });
</script>

<form action="" onsubmit='return false;' method="POST">
<table style="width:100%">
</table>
</form>
<a href="/checkout" style="display:none"><button id="pagar">Payer (<span></span>$)</button></a>

<script>
    var send = function(val){
        $(document).ready(function(){
            $.post("/subpage_cart_table_back", {"op" : val});
        });
    };
</script>
<style>
    #cart{
        text-align:center;
        background-color: rgba(0,0,0,0.4);
        padding: 20px;
        cursor: default;
    }
</style>