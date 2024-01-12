<?php
require_once __DIR__."/client_template.php";
class MarksView {

    public function displayMarksView() {
        ClientTemplate::generateHeader(false);
        ClientTemplate::generateMenu();
        HomeView::generateMarksLogos(4, 240);
        ClientTemplate::generateFooter();
    }
}
?>