        </div>
    </div>
</div>
<?php
    global $auth;
    echo(view("layout.popup.purchase", [
        'name'     => $auth()->name,
        'is_done' => $auth()->request->purchased == 1
    ]));
    if($auth()->request->purchased != 1){
        echo(view("layout.popup.select_date"));
    }
?>