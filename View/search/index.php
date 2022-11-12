<div id="over-loading"></div>

<aside id="aside-menu" class="offcanvas offcanvas-start bg-main" tabindex="-1" aria-labelledby="offcanvasExampleLabel">

</aside>

<aside id="aside-album-list" class="offcanvas offcanvas-bottom bg-main" tabindex="-1" aria-labelledby="offcanvasBottomLabel">

</aside>

<div class="album">
    <div class="container py-5">
        <div id="search-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-evenly align-items-center">

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $("#search-form").submit(function(e) {
        e.preventDefault();
    });
</script>
<script type="module" src="/js/search-main.js"></script>
