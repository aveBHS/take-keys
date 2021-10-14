function setCatalogView(mode){
    $.post(
        "/api/settings/catalog_view_mode",
        {"param": mode},
        () => (window.location.reload())
    );
}